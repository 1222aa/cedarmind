@extends('frontend.master')

@section('content')
<div class="max-w-6xl mx-auto py-12">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold">Courses</h1>
        <a href="{{ route('admin.courses.create') }}" class="bg-[var(--cedar)] text-white px-4 py-2 rounded">Create Course</a>
    </div>

    @if(session('success'))
    <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
    @endif

    <div class="space-y-4">
        @foreach($courses as $course)
        <div class="bg-white rounded shadow p-4 flex items-center justify-between">
            <div>
                <h3 class="font-semibold">{{ $course->title }}</h3>
                <p class="text-sm text-gray-600">{{ $course->description }}</p>
            </div>
            <div class="space-x-2">
                <a href="{{ route('admin.courses.edit', $course->id) }}" class="text-blue-600">Edit</a>
                <form method="POST" action="{{ route('admin.courses.destroy', $course->id) }}" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 ml-2">Delete</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
