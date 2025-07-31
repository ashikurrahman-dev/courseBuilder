@extends('layouts.app')

@section('content')
    <div class="max-w-7xl px-4 mt-10">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">📚 Course List</h2>
        <a href="{{ route('courses.create') }}"
            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            Add Course
        </a>

        <div class="grid grid-cols-1 mt-6 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @forelse ($courses as $course)
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    @if ($course->image)
                        <img src="{{ asset('storage/' . $course->image) }}" alt="{{ $course->title }}"
                            class="w-full h-40 object-cover">
                    @else
                        <div class="w-full h-40 bg-gray-200 flex items-center justify-center text-gray-500 text-sm">
                            No Image
                        </div>
                    @endif

                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-800">{{ $course->title }}</h3>
                        <div class="flex justify-between">
                            <p class="text-sm text-gray-600 mt-1">🎓 Batch: {{ $course->batch }}</p>
                            <p class="text-sm text-gray-600 mt-1">💰 Price: ৳{{ number_format($course->price) }}</p>
                        </div>

                        <div class="mt-4">
                            <a href="#"
                                class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 text-sm">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center text-gray-500">
                    No courses found.
                </div>
            @endforelse
        </div>
    </div>
@endsection
