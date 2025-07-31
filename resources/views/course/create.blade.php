@extends('layouts.app')

@section('content')
    <div class="mt-10 px-4">
        <div class="bg-white shadow-md rounded-lg p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-gray-800">➕ Create a Course</h2>
                <a href="{{ route('courses.index') }}"
                    class="text-sm bg-gray-600 hover:bg-gray-700 text-white p-2 rounded transition">← Back to Course Page</a>
            </div>

            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            <form id="courseForm" class="space-y-4" enctype="multipart/form-data" method="POST"
                action="{{ route('courses.store') }}">
                @csrf
                <!-- Title -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Course Title <span
                            class="text-red-500">*</span></label>
                    <input type="text" id="title" name="title" placeholder="Enter course title"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white text-gray-800 @error('title') border-red-500 @enderror"
                        value="{{ old('title') }}" required>
                    @error('title')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Category -->
                <div class="mb-4">
                    <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Select Category</label>
                    <select name="category_id" id="category_id" required
                        class="w-full bg-gray-100 text-gray-700 border border-gray-600 rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('category_id') border-red-500 @enderror">
                        <option value="" disabled selected>-- Choose Category --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Batch -->
                <div>
                    <label for="batch" class="block text-sm font-medium text-gray-700 mb-1">Batch <span
                            class="text-red-500">*</span></label>
                    <input type="text" id="batch" name="batch" placeholder="Batch number"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white text-gray-800 @error('batch') border-red-500 @enderror"
                        value="{{ old('batch') }}" required>
                    @error('batch')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Price -->
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Price <span
                            class="text-red-500">*</span></label>
                    <input type="number" id="price" name="price" placeholder="Course price"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white text-gray-800 @error('price') border-red-500 @enderror"
                        value="{{ old('price') }}" required>
                    @error('price')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea id="description" name="description" placeholder="Course description"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white text-gray-800 @error('description') border-red-500 @enderror"
                        rows="4" required>{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Image -->
                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Image</label>
                    <input type="file" id="image" name="image"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white text-gray-800 @error('image') border-red-500 @enderror">
                    @error('image')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Add Module -->
                <div>
                    <button type="button" id="addModule"
                        class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded transition">➕ Add Module</button>
                </div>

                <!-- Module Fields -->
                <div id="modules" class="space-y-4"></div>

                <!-- Submit/Cancel -->
                <div class="flex gap-4 pt-4">
                    <button type="submit"
                        class="bg-green-500 hover:bg-green-700 text-white px-6 py-2 rounded transition">💾 Save</button>
                    <button type="button" id="cancel"
                        class="bg-red-500 hover:bg-red-700 text-white px-6 py-2 rounded transition">✖ Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const modulesContainer = document.getElementById('modules');
        let moduleCount = 0;

        document.getElementById('addModule').addEventListener('click', () => {
            moduleCount++;
            const moduleDiv = document.createElement('div');
            moduleDiv.className = 'bg-white p-4 rounded-md border border-gray-300 space-y-4 shadow-sm';
            moduleDiv.innerHTML = `
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Module Title</label>
                    <input type="text" name="modules[${moduleCount - 1}][title]" placeholder="Module Title"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white text-gray-800" required>
                </div>
                <button type="button" class="add-content bg-green-600 hover:bg-green-700 text-white text-sm px-4 py-2 rounded-md mt-3">➕ Add Content</button>
                <div class="content-items space-y-4 mt-4"></div>
                <button type="button" class="remove-module bg-red-600 hover:bg-red-700 text-white text-sm px-4 py-2 rounded-md mt-2">🗑 Remove Module</button>
            `;
            modulesContainer.appendChild(moduleDiv);

            let contentCount = 0;

            moduleDiv.querySelector('.add-content').addEventListener('click', () => {
                const contentIndex = contentCount++;
                const contentDiv = document.createElement('div');
                contentDiv.className = 'space-y-4 p-4 bg-gray-50 border border-gray-200 rounded-md';
                contentDiv.innerHTML = `
        <h5>Content data</h5>
        <div>
            <label class="block text-xs font-medium text-gray-600 mb-1">Text</label>
            <input type="text" name="modules[${moduleCount - 1}][contents][${contentIndex}][text]" placeholder="Content Text"
                class="block w-full px-3 py-2 border border-gray-300 rounded-md">
        </div>
        <div>
            <label class="block text-xs font-medium text-gray-600 mb-1">Image</label>
            <input type="file" name="modules[${moduleCount - 1}][contents][${contentIndex}][image]"
                class="block w-full px-3 py-2 border border-gray-300 rounded-md">
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Video URL</label>
                <input type="text" name="modules[${moduleCount - 1}][contents][${contentIndex}][video]" placeholder="Video URL"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Link</label>
                <input type="text" name="modules[${moduleCount - 1}][contents][${contentIndex}][link]" placeholder="Link"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md">
            </div>
        </div>
        <div class="text-right pt-2">
            <button type="button" class="remove-content bg-red-600 hover:bg-red-700 text-white text-xs px-3 py-1 rounded-md">🗑 Remove Content</button>
        </div>
    `;
                moduleDiv.querySelector('.content-items').appendChild(contentDiv);
            });

            moduleDiv.querySelector('.remove-module').addEventListener('click', () => {
                moduleDiv.remove();
            });

            moduleDiv.querySelector('.content-items').addEventListener('click', (e) => {
                if (e.target.classList.contains('remove-content')) {
                    e.target.closest('.space-y-4').remove();
                }
            });
        });

        document.getElementById('cancel').addEventListener('click', () => {
            if (confirm('Are you sure you want to cancel?')) {
                modulesContainer.innerHTML = '';
                moduleCount = 0;
                document.getElementById('courseForm').reset();
            }
        });
    </script>
@endsection
