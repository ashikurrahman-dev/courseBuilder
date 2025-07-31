@extends('layouts.app')

@section('content')
    <main class="p-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-white p-4 rounded shadow">
                <h2 class="text-lg font-semibold">Total Categories</h2>
                <p class="text-2xl mt-2">{{ $category }}</p>
            </div>
            <div class="bg-white p-4 rounded shadow">
                <h2 class="text-lg font-semibold">Total Courses</h2>
                <p class="text-2xl mt-2">{{ $course }}</p>
            </div>
            <div class="bg-white p-4 rounded shadow">
                <h2 class="text-lg font-semibold">Contents</h2>
                <p class="text-2xl mt-2">{{ $content }}</p>
            </div>
        </div>
    </main>
@endsection
