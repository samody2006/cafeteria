<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create Recipe</h2>
                <p class="text-sm text-gray-500">Add a new culinary masterpiece to your collection</p>
            </div>
            <a href="{{ route('admin.recipes.index') }}" class="text-amber-600 hover:text-amber-800 text-sm font-medium">
                &larr; Back to Recipes
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8 text-gray-900">
                    <form action="{{ route('admin.recipes.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Left Column -->
                            <div class="space-y-6">
                                <!-- Title -->
                                <div>
                                    <x-input-label for="title" value="Recipe Title" />
                                    <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title')" required placeholder="e.g. Slow-Braised Lamb Shoulder" />
                                    <x-input-error class="mt-2" :messages="$errors->get('title')" />
                                </div>

                                <!-- Description -->
                                <div>
                                    <x-input-label for="description" value="Short Description" />
                                    <textarea id="description" name="description" rows="3" class="mt-1 block w-full border-gray-300 focus:border-amber-500 focus:ring-amber-500 rounded-md shadow-sm" placeholder="A brief introduction...">{{ old('description') }}</textarea>
                                    <x-input-error class="mt-2" :messages="$errors->get('description')" />
                                </div>

                                <!-- Ingredients -->
                                <div>
                                    <x-input-label for="ingredients" value="Ingredients" />
                                    <textarea id="ingredients" name="ingredients" rows="10" class="mt-1 block w-full border-gray-300 focus:border-amber-500 focus:ring-amber-500 rounded-md shadow-sm" required placeholder="One ingredient per line...">{{ old('ingredients') }}</textarea>
                                    <p class="mt-1 text-xs text-gray-500 font-jost">One ingredient per line.</p>
                                    <x-input-error class="mt-2" :messages="$errors->get('ingredients')" />
                                </div>
                            </div>

                            <!-- Right Column -->
                            <div class="space-y-6">
                                <!-- Instructions -->
                                <div>
                                    <x-input-label for="instructions" value="Instructions" />
                                    <textarea id="instructions" name="instructions" rows="10" class="mt-1 block w-full border-gray-300 focus:border-amber-500 focus:ring-amber-500 rounded-md shadow-sm" required placeholder="Step-by-step guide...">{{ old('instructions') }}</textarea>
                                    <p class="mt-1 text-xs text-gray-500 font-jost">Each line will be treated as a step.</p>
                                    <x-input-error class="mt-2" :messages="$errors->get('instructions')" />
                                </div>

                                <!-- Main Image -->
                                <div>
                                    <x-input-label for="image" value="Feature Image" />
                                    <div class="mt-1 flex items-center space-x-4">
                                        <div id="image-preview-container" class="hidden shrink-0">
                                            <img id="image-preview" src="#" alt="Preview" class="h-24 w-32 object-cover rounded-md border border-gray-200 shadow-sm">
                                        </div>
                                        <label class="block w-full">
                                            <span class="sr-only">Choose feature image</span>
                                            <input type="file" name="image" id="image" accept="image/*" onchange="previewFile(this, 'image-preview', 'image-preview-container')"
                                                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-amber-50 file:text-amber-700 hover:file:bg-amber-100 transition-colors cursor-pointer" />
                                        </label>
                                    </div>
                                    <x-input-error class="mt-2" :messages="$errors->get('image')" />
                                </div>

                                <!-- Gallery Images -->
                                <div>
                                    <x-input-label for="images" value="Gallery Images (Optional)" />
                                    <input type="file" name="images[]" id="images" multiple accept="image/*"
                                        class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gray-50 file:text-gray-700 hover:file:bg-gray-100 transition-colors cursor-pointer" />
                                    <p class="mt-1 text-xs text-gray-500 font-jost">You can select multiple images.</p>
                                    <x-input-error class="mt-2" :messages="$errors->get('images.*')" />
                                </div>

                                <!-- Publication Status -->
                                <div class="bg-amber-50 p-4 rounded-lg border border-amber-100">
                                    <label class="flex items-center cursor-pointer">
                                        <input type="checkbox" name="is_published" value="1" {{ old('is_published') ? 'checked' : '' }} class="form-checkbox h-5 w-5 text-amber-600 border-gray-300 rounded focus:ring-amber-500">
                                        <div class="ml-3">
                                            <span class="block text-sm font-bold text-amber-900 uppercase tracking-wider">Publish Recipe</span>
                                            <span class="block text-xs text-amber-700 font-jost">Make this recipe visible on the website immediately.</span>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="flex items-center justify-end space-x-4 border-t border-gray-100 pt-6">
                            <a href="{{ route('admin.recipes.index') }}" class="text-sm text-gray-600 hover:text-gray-900 font-medium px-4 py-2">
                                Cancel
                            </a>
                            <x-primary-button class="bg-amber-600 hover:bg-amber-700 focus:bg-amber-700 active:bg-amber-800">
                                Save Recipe
                            </x-primary-button>
                        </div>
                    </form>
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
