<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Recipe</h2>
                <p class="text-sm text-gray-500">Updating: {{ $recipe->title }}</p>
            </div>
            <div class="flex items-center space-x-4">
                <a href="{{ route('recipes.show', $recipe->slug) }}" target="_blank" class="text-amber-600 hover:text-amber-800 text-sm font-medium">
                    View Live &rarr;
                </a>
                <a href="{{ route('admin.recipes.index') }}" class="text-gray-600 hover:text-gray-800 text-sm font-medium">
                    &larr; Back to Recipes
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8 text-gray-900">
                    <form action="{{ route('admin.recipes.update', $recipe) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Left Column -->
                            <div class="space-y-6">
                                <!-- Title -->
                                <div>
                                    <x-input-label for="title" value="Recipe Title" />
                                    <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $recipe->title)" required />
                                    <x-input-error class="mt-2" :messages="$errors->get('title')" />
                                </div>

                                <!-- Description -->
                                <div>
                                    <x-input-label for="description" value="Short Description" />
                                    <textarea id="description" name="description" rows="3" class="mt-1 block w-full border-gray-300 focus:border-amber-500 focus:ring-amber-500 rounded-md shadow-sm">{{ old('description', $recipe->description) }}</textarea>
                                    <x-input-error class="mt-2" :messages="$errors->get('description')" />
                                </div>

                                <!-- Ingredients -->
                                <div>
                                    <x-input-label for="ingredients" value="Ingredients" />
                                    <textarea id="ingredients" name="ingredients" rows="10" class="mt-1 block w-full border-gray-300 focus:border-amber-500 focus:ring-amber-500 rounded-md shadow-sm" required>{{ old('ingredients', $recipe->ingredients) }}</textarea>
                                    <p class="mt-1 text-xs text-gray-500 font-jost">One ingredient per line.</p>
                                    <x-input-error class="mt-2" :messages="$errors->get('ingredients')" />
                                </div>
                            </div>

                            <!-- Right Column -->
                            <div class="space-y-6">
                                <!-- Instructions -->
                                <div>
                                    <x-input-label for="instructions" value="Instructions" />
                                    <textarea id="instructions" name="instructions" rows="10" class="mt-1 block w-full border-gray-300 focus:border-amber-500 focus:ring-amber-500 rounded-md shadow-sm" required>{{ old('instructions', $recipe->instructions) }}</textarea>
                                    <p class="mt-1 text-xs text-gray-500 font-jost">Each line will be treated as a step.</p>
                                    <x-input-error class="mt-2" :messages="$errors->get('instructions')" />
                                </div>

                                <!-- Main Image -->
                                <div>
                                    <x-input-label for="image" value="Feature Image" />
                                    
                                    <div class="mt-2 flex flex-wrap gap-4 items-end">
                                        @if($recipe->image)
                                            <div class="shrink-0">
                                                <p class="text-xs text-gray-500 mb-1">Current:</p>
                                                <img src="{{ asset('storage/' . $recipe->image) }}" alt="Current" class="h-24 w-32 object-cover rounded-md border border-gray-200">
                                            </div>
                                        @endif
                                        
                                        <div id="image-preview-container" class="hidden shrink-0">
                                            <p class="text-xs text-amber-600 mb-1 font-semibold">New Preview:</p>
                                            <img id="image-preview" src="#" alt="Preview" class="h-24 w-32 object-cover rounded-md border-2 border-amber-400">
                                        </div>

                                        <div class="flex-1 min-w-[200px]">
                                            <label class="block w-full">
                                                <span class="sr-only">Choose new feature image</span>
                                                <input type="file" name="image" id="image" accept="image/*" onchange="previewFile(this, 'image-preview', 'image-preview-container')"
                                                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-amber-50 file:text-amber-700 hover:file:bg-amber-100 transition-colors cursor-pointer" />
                                            </label>
                                            <p class="mt-1 text-xs text-gray-500">Leave empty to keep current image.</p>
                                        </div>
                                    </div>
                                    <x-input-error class="mt-2" :messages="$errors->get('image')" />
                                </div>

                                <!-- Gallery Images -->
                                <div>
                                    <x-input-label for="images" value="Add More Gallery Images" />
                                    <input type="file" name="images[]" id="images" multiple accept="image/*"
                                        class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gray-50 file:text-gray-700 hover:file:bg-gray-100 transition-colors cursor-pointer" />
                                    <p class="mt-1 text-xs text-gray-500">Existing gallery images remain unchanged.</p>
                                    <x-input-error class="mt-2" :messages="$errors->get('images.*')" />
                                </div>

                                <!-- Publication Status -->
                                <div class="bg-amber-50 p-4 rounded-lg border border-amber-100">
                                    <label class="flex items-center cursor-pointer">
                                        <input type="checkbox" name="is_published" value="1" {{ old('is_published', $recipe->is_published) ? 'checked' : '' }} class="form-checkbox h-5 w-5 text-amber-600 border-gray-300 rounded focus:ring-amber-500">
                                        <div class="ml-3">
                                            <span class="block text-sm font-bold text-amber-900 uppercase tracking-wider">Published</span>
                                            <span class="block text-xs text-amber-700 font-jost">Control visibility of this recipe on the site.</span>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="flex items-center justify-between border-t border-gray-100 pt-6">
                            <div class="text-xs text-gray-400">
                                Last updated: {{ $recipe->updated_at->format('d M Y, H:i') }}
                            </div>
                            <div class="flex items-center space-x-4">
                                <a href="{{ route('admin.recipes.index') }}" class="text-sm text-gray-600 hover:text-gray-900 font-medium px-4 py-2">
                                    Cancel
                                </a>
                                <x-primary-button class="bg-amber-600 hover:bg-amber-700 focus:bg-amber-700 active:bg-amber-800">
                                    Update Recipe
                                </x-primary-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Danger Zone -->
            <div class="mt-12 bg-red-50 overflow-hidden shadow-sm sm:rounded-lg border border-red-100">
                <div class="p-6">
                    <h3 class="text-lg font-bold text-red-800 uppercase tracking-tight">Danger Zone</h3>
                    <p class="mt-1 text-sm text-red-600 font-jost">Once deleted, this recipe and all its media are gone forever.</p>
                    <div class="mt-4">
                        <form action="{{ route('admin.recipes.destroy', $recipe) }}" method="POST" onsubmit="return confirm('Permanently delete this recipe? This cannot be undone.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Delete Recipe
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function previewFile(input, previewId, containerId) {
            const preview = document.getElementById(previewId);
            const container = document.getElementById(containerId);
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    container.classList.remove('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    @endpush
</x-admin-layout>
