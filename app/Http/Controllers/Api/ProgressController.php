<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserProgress;
use App\Models\Lesson;
use App\Models\Course;
use App\Models\Certificate;
use Barryvdh\DomPDF\Facade\Pdf;

class ProgressController extends Controller
{
    // Mark/unmark a lesson content as completed for current user
    public function complete(Request $request)
    {
        try {
            $data = $request->validate([
                'lesson_content_id' => 'required|exists:lesson_contents,id',
                'completed' => 'nullable|boolean',
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 422);
        }

        $user = $request->user();
        if (!$user) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }

        $contentId = $data['lesson_content_id'];
        $completed = $data['completed'] ?? true;

        if ($completed) {
            $progress = UserProgress::firstOrCreate(
                ['user_id' => $user->id, 'lesson_content_id' => $contentId],
                ['completed_at' => now()]
            );
            return response()->json(['message' => 'Marked complete', 'progress_id' => $progress->id], 201);
        } else {
            $deleted = UserProgress::where('user_id', $user->id)->where('lesson_content_id', $contentId)->delete();
            return response()->json(['message' => 'Marked incomplete', 'deleted' => (bool) $deleted], 200);
        }
    }

    // Return progress summary for a course for current user
    public function courseProgress(Request $request, $courseId)
    {
        $user = $request->user();
        $course = Course::with('lessons.contents')->find($courseId);
        if (!$course) {
            return response()->json(['message' => 'Course not found'], 404);
        }

        $allContentIds = [];
        foreach ($course->lessons as $lesson) {
            foreach ($lesson->contents as $content) {
                $allContentIds[] = $content->id;
            }
        }

        $total = count($allContentIds);
        $completedCount = 0;
        if ($total > 0) {
            $completedCount = UserProgress::where('user_id', $user->id)
                ->whereIn('lesson_content_id', $allContentIds)
                ->count();
        }

        $percent = $total > 0 ? round(($completedCount / $total) * 100) : 0;

        // Also return list of completed IDs for UI
        $completedIds = UserProgress::where('user_id', $user->id)->whereIn('lesson_content_id', $allContentIds)->pluck('lesson_content_id')->toArray();

        return response()->json([
            'course_id' => $course->id,
            'total_items' => $total,
            'completed_count' => $completedCount,
            'percent' => $percent,
            'completed_ids' => $completedIds,
        ]);
    }

    public function getProgress(Request $request, $courseId)
    {
        $user = $request->user();

        $lessons = Lesson::where('course_id', $courseId)->get();
        $completedLessons = UserProgress::where('user_id', $user->id)
            ->whereIn('lesson_id', $lessons->pluck('id'))
            ->where('completed', true)
            ->count();

        return response()->json([
            'total_lessons' => $lessons->count(),
            'completed_lessons' => $completedLessons,
        ]);
    }

    public function markComplete(Request $request)
    {
        $data = $request->validate([
            'lesson_id' => 'required|exists:lessons,id',
        ]);

        $user = $request->user();
        $lesson = Lesson::find($data['lesson_id']);

        $progress = UserProgress::updateOrCreate(
            ['user_id' => $user->id, 'lesson_id' => $data['lesson_id']],
            ['completed' => true]
        );

        // Check if all lessons in the course are completed
        $courseId = $lesson->course_id;
        $course = Course::find($courseId);
        $totalLessons = Lesson::where('course_id', $courseId)->count();
        $completedLessons = UserProgress::where('user_id', $user->id)
            ->whereIn('lesson_id', $course->lessons->pluck('id'))
            ->where('completed', true)
            ->count();

        $certificateData = [
            'course_complete' => false,
            'certificate_number' => null,
        ];

        // If all lessons completed, generate certificate
        if ($totalLessons > 0 && $completedLessons === $totalLessons) {
            $certificate = Certificate::firstOrCreate(
                ['user_id' => $user->id, 'course_id' => $courseId],
                [
                    'earned_at' => now(),
                    'certificate_number' => $this->generateCertificateNumber($user->id, $courseId),
                ]
            );

            $certificateData = [
                'course_complete' => true,
                'certificate_number' => $certificate->certificate_number,
                'earned_at' => $certificate->earned_at,
            ];
        }

        return response()->json([
            'message' => 'Lesson marked as complete',
            'certificate' => $certificateData,
        ]);
    }

    /**
     * Generate a unique certificate number
     */
    private function generateCertificateNumber($userId, $courseId)
    {
        $date = now()->format('Ymd');
        return "CERT-{$userId}-{$courseId}-{$date}-" . uniqid();
    }

    /**
     * Generate and download certificate PDF
     */
    public function downloadCertificate(Request $request, $certificateId)
    {
        $user = $request->user();
        $certificate = Certificate::find($certificateId);

        if (!$certificate || $certificate->user_id !== $user->id) {
            return response()->json(['error' => 'Certificate not found or unauthorized'], 404);
        }

        $course = $certificate->course;
        $data = [
            'user_name' => $user->name,
            'course_title' => $course->title,
            'certificate_number' => $certificate->certificate_number,
            'earned_date' => $certificate->earned_at->format('F d, Y'),
        ];

        $pdf = Pdf::loadView('certificates.certificate', $data);
        return $pdf->download("certificate-{$certificate->certificate_number}.pdf");
    }

    /**
     * Get user's certificates
     */
    public function getCertificates(Request $request)
    {
        $user = $request->user();
        $certificates = $user->certificates()->with('course')->get();

        return response()->json([
            'certificates' => $certificates->map(function ($cert) {
                return [
                    'id' => $cert->id,
                    'course_title' => $cert->course->title,
                    'certificate_number' => $cert->certificate_number,
                    'earned_at' => $cert->earned_at->format('F d, Y'),
                ];
            }),
        ]);
    }
}
