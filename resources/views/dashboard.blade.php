<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid gap-6 md:grid-cols-2">
                        <div>
                            <p class="text-lg font-semibold text-gray-800">You're logged in!</p>
                            <p class="text-sm text-gray-500 mt-1">Quick admin shortcuts</p>
                        </div>
                        <div class="flex flex-wrap gap-2">
                            <a href="{{ route('admin.contact.edit') }}" class="px-3 py-2 text-sm text-white bg-amber-600 rounded hover:bg-amber-700">Edit contact</a>
                            <a href="{{ route('admin.recipes.index') }}" class="px-3 py-2 text-sm text-amber-700 bg-amber-100 rounded hover:bg-amber-200">Manage recipes</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
