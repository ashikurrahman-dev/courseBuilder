@extends('layouts.app')

@section('content')
    <main class="p-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-white p-4 rounded shadow">
                <h2 class="text-lg font-semibold">Total Categories</h2>
                <p class="text-2xl mt-2">12</p>
            </div>
            <div class="bg-white p-4 rounded shadow">
                <h2 class="text-lg font-semibold">Total Courses</h2>
                <p class="text-2xl mt-2">8</p>
            </div>
            <div class="bg-white p-4 rounded shadow">
                <h2 class="text-lg font-semibold">Contents</h2>
                <p class="text-2xl mt-2">150</p>
            </div>
        </div>
    </main>
@endsection
