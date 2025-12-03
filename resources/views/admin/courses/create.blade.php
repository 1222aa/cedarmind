@extends('frontend.master')

@section('content')
<div class="max-w-3xl mx-auto py-12">
    <h1 class="text-2xl font-bold mb-6">Create Course</h1>

    @if($errors->any())
    <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('admin.courses.store') }}">
        @csrf
        <div class="space-y-4">
            <input name="title" placeholder="Title" class="w-full p-3 border rounded" />
            <textarea name="description" placeholder="Short description" class="w-full p-3 border rounded"></textarea>
            <textarea name="long_description" placeholder="Long description" class="w-full p-3 border rounded"></textarea>
            <input name="instructor" placeholder="Instructor" class="w-full p-3 border rounded" />
            <div class="flex gap-3">
                <input name="level" placeholder="Level" class="flex-1 p-3 border rounded" />
                <input name="duration_hours" placeholder="Duration (hours)" class="w-40 p-3 border rounded" />
            </div>
            <button class="bg-[var(--cedar)] text-white px-4 py-2 rounded">Create</button>
        </div>
    </form>
</div>
@endsection
