<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Recipes</h2>
                <p class="text-sm text-gray-500">Manage your culinary creations</p>
            </div>
            <a href="{{ route('admin.recipes.create') }}" class="inline-flex items-center px-4 py-2 bg-amber-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-amber-700 active:bg-amber-900 focus:outline-none focus:border-amber-900 focus:ring ring-amber-300 disabled:opacity-25 transition ease-in-out duration-150">
                + New Recipe
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-800">
                    @if(session('success'))
                        <div class="mb-4 text-sm text-green-700 bg-green-50 border border-green-200 px-3 py-2 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm text-left">
                            <thead>
                                <tr class="text-gray-500 uppercase text-xs">
                                    <th class="py-3 pr-4">Image</th>
                                    <th class="py-3 pr-4">Title</th>
                                    <th class="py-3 pr-4">Status</th>
                                    <th class="py-3 pr-4">Created</th>
                                    <th class="py-3 text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse($recipes as $recipe)
                                    <tr>
                                        <td class="py-3 pr-4">
                                            @if($recipe->image)
                                                <img src="{{ asset('storage/' . $recipe->image) }}" alt="{{ $recipe->title }}" class="w-16 h-12 object-cover rounded shadow-sm">
                                            @else
                                                <div class="w-16 h-12 bg-gray-100 flex items-center justify-center rounded text-gray-400">
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                    </svg>
                                                </div>
                                            @endif
                                        </td>
                                        <td class="py-3 pr-4 font-medium text-gray-900">{{ $recipe->title }}</td>
                                        <td class="py-3 pr-4">
                                            @if($recipe->is_published)
                                                <span class="px-2 py-1 text-xs font-semibold leading-tight text-green-700 bg-green-100 rounded-full">Published</span>
                                            @else
                                                <span class="px-2 py-1 text-xs font-semibold leading-tight text-gray-700 bg-gray-100 rounded-full">Draft</span>
                                            @endif
                                        </td>
                                        <td class="py-3 pr-4 text-gray-500">{{ $recipe->created_at->format('d M Y') }}</td>
                                        <td class="py-3 text-right">
                                            <div class="flex justify-end space-x-3 items-center">
                                                <a href="{{ route('recipes.show', $recipe->slug) }}" target="_blank" class="text-amber-700 hover:text-amber-900">View</a>
                                                <a href="{{ route('admin.recipes.edit', $recipe) }}" class="text-blue-600 hover:text-blue-900">Edit</a>
                                                
                                                <form action="{{ route('admin.recipes.toggle-publish', $recipe) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="{{ $recipe->is_published ? 'text-orange-600 hover:text-orange-900' : 'text-green-600 hover:text-green-900' }}">
                                                        {{ $recipe->is_published ? 'Unpublish' : 'Publish' }}
                                                    </button>
                                                </form>

                                                <form action="{{ route('admin.recipes.destroy', $recipe) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Permanently delete this recipe?')">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="py-8 text-center text-gray-500" colspan="5">
                                            <div class="flex flex-col items-center">
                                                <svg class="w-12 h-12 text-gray-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                                </svg>
                                                <p>No recipes found.</p>
                                                <a href="{{ route('admin.recipes.create') }}" class="mt-2 text-amber-600 hover:underline">Create your first recipe →</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6">
                        {{ $recipes->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
