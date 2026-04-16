<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Contact Details
            </h2>
            <p class="text-sm text-gray-500">Shown on About & Contact pages</p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-800">
                    <form method="POST" action="{{ route('admin.contact.update') }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="grid gap-6 md:grid-cols-2">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" name="email" value="{{ old('email', $contact->email ?? '') }}"
                                       class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500"
                                       required>
                                @error('email') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Address</label>
                                <input type="text" name="address" value="{{ old('address', $contact->address ?? '') }}"
                                       class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500"
                                       placeholder="Optional">
                                @error('address') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div class="grid gap-6 md:grid-cols-2">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Phone (Primary)</label>
                                <input type="text" name="phone_primary"
                                       value="{{ old('phone_primary', $contact->phone_primary ?? '') }}"
                                       class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500"
                                       required>
                                @error('phone_primary') <p
                                    class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Phone (Secondary)</label>
                                <input type="text" name="phone_secondary"
                                       value="{{ old('phone_secondary', $contact->phone_secondary ?? '') }}"
                                       class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500"
                                       placeholder="Optional">
                                @error('phone_secondary') <p
                                    class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div class="grid gap-6 md:grid-cols-3">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Instagram URL</label>
                                <input type="url" name="instagram_url"
                                       value="{{ old('instagram_url', $contact->instagram_url ?? '') }}"
                                       class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500"
                                       placeholder="https://instagram.com/username">
                                @error('instagram_url') <p
                                    class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Facebook URL</label>
                                <input type="url" name="facebook_url"
                                       value="{{ old('facebook_url', $contact->facebook_url ?? '') }}"
                                       class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500"
                                       placeholder="https://facebook.com/page">
                                @error('facebook_url') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Twitter / X URL</label>
                                <input type="url" name="twitter_url"
                                       value="{{ old('twitter_url', $contact->twitter_url ?? '') }}"
                                       class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500"
                                       placeholder="https://x.com/username">
                                @error('twitter_url') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>
                        <div class="grid gap-6 md:grid-cols-3">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">TikTok URL</label>
                                <input type="url" name="tiktok_url"
                                       value="{{ old('tiktok_url', $contact->tiktok_url ?? '') }}"
                                       class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500"
                                       placeholder="https://tiktok.com/username">
                                @error('tiktok_url') <p
                                    class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div class="flex justify-end">
                            <x-primary-button>
                                Save Contact
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
