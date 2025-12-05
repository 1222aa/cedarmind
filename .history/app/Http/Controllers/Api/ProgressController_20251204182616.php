<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserProgress;
use App\Models\LessonContent;
use App\Models\Course;

class ProgressController extends Controller
{
    // Mark/unmark a lesson content as completed for current user
    public function complete(Request $request)
    {
        $data = $request->validate([
            'lesson_content_id' => 'required|exists:lesson_contents,id',
            'completed' => 'nullable|boolean',
        ]);

        $user = $request->user();
        $contentId = $data['lesson_content_id'];
        $completed = $data['completed'] ?? true;

        if ($completed) {
            $progress = UserProgress::firstOrCreate(
                ['user_id' => $user->id, 'lesson_content_id' => $contentId],
                ['completed_at' => now()]
            );
            return response()->json(['message' => 'Marked complete', 'progress_id' => $progress->id]);
        } else {
            $deleted = UserProgress::where('user_id', $user->id)->where('lesson_content_id', $contentId)->delete();
            return response()->json(['message' => 'Marked incomplete', 'deleted' => (bool) $deleted]);
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
}
