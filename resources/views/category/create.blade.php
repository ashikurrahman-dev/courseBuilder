@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mt-10 px-4">
        <div class="bg-white shadow-md rounded-lg p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-semibold text-gray-800">➕ Add New Category</h2>
                <a href="{{ route('categories.index') }}"
                    class="inline-block bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded transition">
                    ← Back to List
                </a>
            </div>

            <form id="category-form" action="{{ route('categories.store') }}" method="POST">
                @csrf

                <div class="mb-5">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                        Category Name <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Enter category name"
                        class="w-full px-4 py-2 border @error('name') border-red-500 @else border-gray-300 @enderror rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    >
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end">
                    <button type="submit" id="submit-btn"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md transition disabled:opacity-50">
                        <span id="submit-text">Save Category</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
