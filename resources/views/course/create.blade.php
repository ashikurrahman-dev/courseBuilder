@extends('layouts.app')

@section('content')
    <div class="mt-10 px-4 max-w-full ">
        <div class="bg-white shadow-lg rounded-lg p-8">
            <!-- Header -->
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-2xl font-semibold text-gray-800">Create New Course</h2>
                <a href="{{ route('courses.index') }}"
                    class="text-sm bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition duration-200">
                    ← Back to Courses
                </a>
            </div>

            <!-- Session Messages -->
            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Form -->
            <form id="courseForm" class="space-y-6" enctype="multipart/form-data" method="POST"
                action="{{ route('courses.store') }}">
                @csrf

                <!-- Course Title -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                        Course Title <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('title') border-red-500 @else border-gray-300 @enderror">
                    @error('title')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Category -->
                <div>
                    <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">
                        Category <span class="text-red-500">*</span>
                    </label>
                    <select name="category_id" id="category_id"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('category_id') border-red-500 @else border-gray-300 @enderror">
                        <option value="" disabled selected>Select a Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Batch -->
                <div>
                    <label for="batch" class="block text-sm font-medium text-gray-700 mb-2">
                        Batch No <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="batch" name="batch" value="{{ old('batch') }}"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('batch') border-red-500 @else border-gray-300 @enderror">
                    @error('batch')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Price -->
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700 mb-2">
                        Price <span class="text-red-500">*</span>
                    </label>
                    <input type="number" id="price" name="price" value="{{ old('price') }}" 
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('price') border-red-500 @else border-gray-300 @enderror">
                    @error('price')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                        Description <span class="text-red-500">*</span>
                    </label>
                    <textarea name="description" id="description"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('description') border-red-500 @else border-gray-300 @enderror"
                        rows="5">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Image -->
                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Course Image</label>
                    <input type="file" id="image" name="image" accept="image/*"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('image') border-red-500 @else border-gray-300 @enderror">
                    @error('image')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Modules Section -->
                <div class="pt-4">
                    <h3 class="text-lg font-medium text-gray-800 mb-4">Course Modules</h3>
                    <button type="button" id="addModule"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition duration-200">
                        Add Module
                    </button>
                </div>

                <div id="modules" class="space-y-6 mt-4">
                    @php $oldModules = old('modules', [[]]); @endphp
                    @foreach ($oldModules as $mIndex => $module)
                        <div class="module-item bg-gray-100 border border-gray-300 rounded-lg p-6 space-y-4"
                            data-index="{{ $mIndex }}">
                            <!-- Module Title -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Module Title <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="modules[{{ $mIndex }}][title]"
                                    value="{{ old("modules.$mIndex.title") }}"
                                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error("modules.$mIndex.title") border-red-500 @else border-gray-300 @enderror"
                                    placeholder="Enter module title">
                                @error("modules.$mIndex.title")
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Module Contents -->
                            <div class="content-items space-y-4">
                                @php $contents = old("modules.$mIndex.contents", $module['contents'] ?? [[]]) @endphp
                                @foreach ($contents as $cIndex => $content)
                                    <div class="content-item bg-white p-4 border rounded-lg space-y-3">
                                        <h5 class="font-medium text-sm text-gray-700">Content Item</h5>
                                        <!-- Content Text -->
                                        <div>
                                            <label for="modules[{{ $mIndex }}][contents][{{ $cIndex }}][text]"
                                                class="block text-sm font-medium text-gray-700 mb-2">Content Text</label>
                                            <input type="text"
                                                id="modules[{{ $mIndex }}][contents][{{ $cIndex }}][text]"
                                                name="modules[{{ $mIndex }}][contents][{{ $cIndex }}][text]"
                                                value="{{ old("modules.$mIndex.contents.$cIndex.text") }}"
                                                placeholder="Enter content text"
                                                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error("modules.$mIndex.contents.$cIndex.text") border-red-500 @else border-gray-300 @enderror">
                                            @error("modules.$mIndex.contents.$cIndex.text")
                                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Content Image -->
                                        <div>
                                            <label
                                                for="modules[{{ $mIndex }}][contents][{{ $cIndex }}][image]"
                                                class="block text-sm font-medium text-gray-700 mb-2">Content Image</label>
                                            <input type="file"
                                                id="modules[{{ $mIndex }}][contents][{{ $cIndex }}][image]"
                                                name="modules[{{ $mIndex }}][contents][{{ $cIndex }}][image]"
                                                accept="image/*"
                                                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error("modules.$mIndex.contents.$cIndex.image") border-red-500 @else border-gray-300 @enderror">
                                            @error("modules.$mIndex.contents.$cIndex.image")
                                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Video URL -->
                                        <div>
                                            <label
                                                for="modules[{{ $mIndex }}][contents][{{ $cIndex }}][video]"
                                                class="block text-sm font-medium text-gray-700 mb-2">Video URL</label>
                                            <input type="url"
                                                id="modules[{{ $mIndex }}][contents][{{ $cIndex }}][video]"
                                                name="modules[{{ $mIndex }}][contents][{{ $cIndex }}][video]"
                                                value="{{ old("modules.$mIndex.contents.$cIndex.video") }}"
                                                placeholder="Enter video URL (e.g., https://youtube.com/...)"
                                                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error("modules.$mIndex.contents.$cIndex.video") border-red-500 @else border-gray-300 @enderror">
                                            @error("modules.$mIndex.contents.$cIndex.video")
                                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Resource Link -->
                                        <div>
                                            <label
                                                for="modules[{{ $mIndex }}][contents][{{ $cIndex }}][link]"
                                                class="block text-sm font-medium text-gray-700 mb-2">Resource Link</label>
                                            <input type="url"
                                                id="modules[{{ $mIndex }}][contents][{{ $cIndex }}][link]"
                                                name="modules[{{ $mIndex }}][contents][{{ $cIndex }}][link]"
                                                value="{{ old("modules.$mIndex.contents.$cIndex.link") }}"
                                                placeholder="Enter resource link (e.g., https://example.com/...)"
                                                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error("modules.$mIndex.contents.$cIndex.link") border-red-500 @else border-gray-300 @enderror">
                                            @error("modules.$mIndex.contents.$cIndex.link")
                                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="text-right">
                                            <button type="button"
                                                class="remove-content bg-red-600 hover:bg-red-700 text-white px-3 py-1 text-sm rounded-lg transition duration-200">
                                                Remove Content
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Module Actions -->
                            <div class="flex gap-3 pt-3">
                                <button type="button"
                                    class="add-content bg-green-600 hover:bg-green-700 text-white px-4 py-2 text-sm rounded-lg transition duration-200">
                                    Add Content
                                </button>
                                <button type="button"
                                    class="remove-module bg-red-600 hover:bg-red-700 text-white px-4 py-2 text-sm rounded-lg transition duration-200">
                                    Remove Module
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Form Actions -->
                <div class="flex gap-4 pt-6">
                    <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg transition duration-200">
                        Save Course
                    </button>
                    <button type="button" id="cancel"
                        class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg transition duration-200">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            let moduleCount = {{ count(old('modules', [[]])) }};

            // Add Module
            document.getElementById('addModule').addEventListener('click', () => {
                const modulesContainer = document.getElementById('modules');
                const mIndex = moduleCount++;
                const moduleDiv = document.createElement('div');
                moduleDiv.className =
                    'module-item bg-gray-100 border border-gray-300 rounded-lg p-6 space-y-4';
                moduleDiv.dataset.index = mIndex;

                moduleDiv.innerHTML = `
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Module Title <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="modules[${mIndex}][title]"
                               class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 border-gray-300"
                               placeholder="Enter module title">
                    </div>
                    <div class="content-items space-y-4">
                        <div class="content-item bg-white p-4 border rounded-lg space-y-3">
                            <h5 class="font-medium text-sm text-gray-700">Content Item</h5>
                            <div>
                                <label for="modules[${mIndex}][contents][0][text]"
                                       class="block text-sm font-medium text-gray-700 mb-2">Content Text</label>
                                <input type="text" id="modules[${mIndex}][contents][0][text]"
                                       name="modules[${mIndex}][contents][0][text]"
                                       placeholder="Enter content text"
                                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 border-gray-300">
                            </div>
                            <div>
                                <label for="modules[${mIndex}][contents][0][image]"
                                       class="block text-sm font-medium text-gray-700 mb-2">Content Image</label>
                                <input type="file" id="modules[${mIndex}][contents][0][image]"
                                       name="modules[${mIndex}][contents][0][image]"
                                       accept="image/*"
                                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 border-gray-300">
                            </div>
                            <div>
                                <label for="modules[${mIndex}][contents][0][video]"
                                       class="block text-sm font-medium text-gray-700 mb-2">Video URL</label>
                                <input type="url" id="modules[${mIndex}][contents][0][video]"
                                       name="modules[${mIndex}][contents][0][video]"
                                       placeholder="Enter video URL (e.g., https://youtube.com/...)"
                                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 border-gray-300">
                            </div>
                            <div>
                                <label for="modules[${mIndex}][contents][0][link]"
                                       class="block text-sm font-medium text-gray-700 mb-2">Resource Link</label>
                                <input type="url" id="modules[${mIndex}][contents][0][link]"
                                       name="modules[${mIndex}][contents][0][link]"
                                       placeholder="Enter resource link (e.g., https://example.com/...)"
                                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 border-gray-300">
                            </div>
                            <div class="text-right">
                                <button type="button"
                                        class="remove-content bg-red-600 hover:bg-red-700 text-white px-3 py-1 text-sm rounded-lg transition duration-200">
                                    Remove Content
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="flex gap-3 pt-3">
                        <button type="button"
                                class="add-content bg-green-600 hover:bg-green-700 text-white px-4 py-2 text-sm rounded-lg transition duration-200">
                            Add Content
                        </button>
                        <button type="button"
                                class="remove-module bg-red-600 hover:bg-red-700 text-white px-4 py-2 text-sm rounded-lg transition duration-200">
                            Remove Module
                        </button>
                    </div>
                `;

                modulesContainer.appendChild(moduleDiv);
            });

            // Event Delegation for Dynamic Elements
            document.getElementById('modules').addEventListener('click', (e) => {
                const target = e.target;

                // Add Content
                if (target.classList.contains('add-content')) {
                    const moduleDiv = target.closest('.module-item');
                    const mIndex = moduleDiv.dataset.index;
                    const contentItems = moduleDiv.querySelector('.content-items');
                    const cIndex = contentItems.children.length;

                    const contentDiv = document.createElement('div');
                    contentDiv.className = 'content-item bg-white p-4 border rounded-lg space-y-3';
                    contentDiv.innerHTML = `
                        <h5 class="font-medium text-sm text-gray-700">Content Item</h5>
                        <div>
                            <label for="modules[${mIndex}][contents][${cIndex}][text]"
                                   class="block text-sm font-medium text-gray-700 mb-2">Content Text</label>
                            <input type="text" id="modules[${mIndex}][contents][${cIndex}][text]"
                                   name="modules[${mIndex}][contents][${cIndex}][text]"
                                   placeholder="Enter content text"
                                   class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 border-gray-300">
                        </div>
                        <div>
                            <label for="modules[${mIndex}][contents][${cIndex}][image]"
                                   class="block text-sm font-medium text-gray-700 mb-2">Content Image</label>
                            <input type="file" id="modules[${mIndex}][contents][${cIndex}][image]"
                                   name="modules[${mIndex}][contents][${cIndex}][image]"
                                   accept="image/*"
                                   class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 border-gray-300">
                        </div>
                        <div>
                            <label for="modules[${mIndex}][contents][${cIndex}][video]"
                                   class="block text-sm font-medium text-gray-700 mb-2">Video URL</label>
                            <input type="url" id="modules[${mIndex}][contents][${cIndex}][video]"
                                   name="modules[${mIndex}][contents][${cIndex}][video]"
                                   placeholder="Enter video URL (e.g., https://youtube.com/...)"
                                   class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 border-gray-300">
                        </div>
                        <div>
                            <label for="modules[${mIndex}][contents][${cIndex}][link]"
                                   class="block text-sm font-medium text-gray-700 mb-2">Resource Link</label>
                            <input type="url" id="modules[${mIndex}][contents][${cIndex}][link]"
                                   name="modules[${mIndex}][contents][${cIndex}][link]"
                                   placeholder="Enter resource link (e.g., https://example.com/...)"
                                   class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 border-gray-300">
                        </div>
                        <div class="text-right">
                            <button type="button"
                                    class="remove-content bg-red-600 hover:bg-red-700 text-white px-3 py-1 text-sm rounded-lg transition duration-200">
                                Remove Content
                            </button>
                        </div>
                    `;

                    contentItems.appendChild(contentDiv);
                }

                // Remove Module
                if (target.classList.contains('remove-module')) {
                    target.closest('.module-item').remove();
                }

                // Remove Content
                if (target.classList.contains('remove-content')) {
                    target.closest('.content-item').remove();
                }
            });

            // Cancel Form
            document.getElementById('cancel').addEventListener('click', () => {
                if (confirm('Are you sure you want to cancel? All unsaved changes will be lost.')) {
                    // Use a JavaScript variable to store the route
                    const coursesIndexUrl = @json(route('courses.index'));
                    window.location.href = coursesIndexUrl;
                }
            });
        });
    </script>
@endsection
