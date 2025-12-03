@extends('frontend.master')

@section('content')
<div class="max-w-4xl mx-auto py-12">
    <h1 class="text-2xl font-bold mb-6">Edit Course: {{ $course->title }}</h1>

    @if(session('success'))
    <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('admin.courses.update', $course->id) }}">
        @csrf
        @method('PUT')
        <div class="space-y-4">
            <input name="title" value="{{ $course->title }}" placeholder="Title" class="w-full p-3 border rounded" />
            <textarea name="description" placeholder="Short description" class="w-full p-3 border rounded">{{ $course->description }}</textarea>
            <textarea name="long_description" placeholder="Long description" class="w-full p-3 border rounded">{{ $course->long_description }}</textarea>
            <input name="instructor" value="{{ $course->instructor }}" placeholder="Instructor" class="w-full p-3 border rounded" />
            <div class="flex gap-3">
                <input name="level" value="{{ $course->level }}" placeholder="Level" class="flex-1 p-3 border rounded" />
                <input name="duration_hours" value="{{ $course->duration_hours }}" placeholder="Duration (hours)" class="w-40 p-3 border rounded" />
            </div>
            <button class="bg-[var(--cedar)] text-white px-4 py-2 rounded">Save</button>
        </div>
    </form>

    <hr class="my-8">

    <h2 class="text-xl font-semibold mb-4">Lessons & Content</h2>
    <div class="space-y-4">
        @foreach($course->lessons as $lesson)
        <div class="bg-white rounded shadow p-4">
            <div class="flex items-start justify-between">
                <div>
                    <h3 class="font-semibold">{{ $lesson->order }}. {{ $lesson->title }}</h3>
                    <p class="text-sm text-gray-600">{{ $lesson->description }}</p>
                </div>
                <div class="space-x-2">
                    <!-- Note: editing lesson not implemented yet -->
                </div>
            </div>

            <div class="mt-4 space-y-2">
                @foreach($lesson->contents as $content)
                <div class="p-3 border rounded flex items-center justify-between">
                    <div>
                        <p class="font-semibold">{{ $content->title }} <span class="text-xs text-gray-500">({{ $content->type }})</span></p>
                        <p class="text-xs text-gray-600">{{ Str::limit($content->content, 120) }}</p>
                    </div>
                    <div class="space-x-2">
                        <!-- Quick delete not implemented -->
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endforeach
    </div>

    <hr class="my-8">

    <h3 class="text-lg font-semibold mb-4">Add Content</h3>
    <form method="POST" action="{{ route('admin.courses.content.add', $course->id) }}">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <select name="lesson_id" class="p-3 border rounded">
                @foreach($course->lessons as $lesson)
                <option value="{{ $lesson->id }}">{{ $lesson->order }}. {{ $lesson->title }}</option>
                @endforeach
            </select>

            <select name="type" class="p-3 border rounded">
                <option value="video">Video</option>
                <option value="presentation">Presentation</option>
                <option value="written">Written</option>
                <option value="quiz">Quiz</option>
            </select>

            <input name="title" placeholder="Content title" class="p-3 border rounded" />
            <input name="url" placeholder="URL (YouTube embed or file link)" class="p-3 border rounded" />
            <input name="file_path" placeholder="file_path (optional)" class="p-3 border rounded" />
            <input name="order" placeholder="order" class="p-3 border rounded" />
            <textarea name="content" placeholder="Written content / description" class="p-3 border rounded md:col-span-2"></textarea>
        </div>
        <div class="mt-4">
            <button class="bg-[var(--cedar)] text-white px-4 py-2 rounded">Add Content</button>
        </div>
    </form>

</div>
@endsection
