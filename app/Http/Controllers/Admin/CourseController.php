<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\LessonContent;

class CourseController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index()
    {
        $courses = Course::withCount('lessons')->orderBy('created_at', 'desc')->get();
        return view('admin.courses.index', compact('courses'));
    }

    public function create()
    {
        return view('admin.courses.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'long_description' => 'nullable|string',
            'instructor' => 'nullable|string|max:255',
            'level' => 'nullable|string|max:50',
            'duration_hours' => 'nullable|integer',
        ]);

        $course = Course::create($data);

        return redirect()->route('admin.courses.index')->with('success', 'Course created');
    }

    public function edit($id)
    {
        $course = Course::with('lessons.contents')->findOrFail($id);
        return view('admin.courses.edit', compact('course'));
    }

    public function update(Request $request, $id)
    {
        $course = Course::findOrFail($id);
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'long_description' => 'nullable|string',
            'instructor' => 'nullable|string|max:255',
            'level' => 'nullable|string|max:50',
            'duration_hours' => 'nullable|integer',
        ]);

        $course->update($data);

        return redirect()->route('admin.courses.edit', $course->id)->with('success', 'Course updated');
    }

    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();
        return redirect()->route('admin.courses.index')->with('success', 'Course deleted');
    }

    // Quick endpoint to add lesson content from admin edit view
    public function addContent(Request $request, $courseId)
    {
        $data = $request->validate([
            'lesson_id' => 'required|exists:lessons,id',
            'type' => 'required|in:video,presentation,written,quiz',
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'url' => 'nullable|url',
            'file_path' => 'nullable|string',
            'order' => 'nullable|integer',
        ]);

        LessonContent::create($data);

        return back()->with('success', 'Content added');
    }
}
