<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Message from {{ $message->name }}</h2>
                <p class="text-sm text-gray-500">Received {{ $message->created_at->format('d M Y, H:i') }}</p>
            </div>
            <div class="flex gap-2">
                <a href="mailto:{{ $message->email }}" class="px-3 py-2 text-sm bg-amber-700 text-white rounded hover:bg-amber-800">Reply</a>
                <form action="{{ route('admin.contact.messages.destroy', $message) }}" method="POST" onsubmit="return confirm('Delete this message?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-3 py-2 text-sm bg-red-100 text-red-700 rounded hover:bg-red-200">Delete</button>
                </form>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-800 space-y-4">
                    <div class="grid gap-4 md:grid-cols-2 text-sm">
                        <div>
                            <p class="text-gray-500">Email</p>
                            <p class="font-medium"><a href="mailto:{{ $message->email }}" class="text-amber-700">{{ $message->email }}</a></p>
                        </div>
                        <div>
                            <p class="text-gray-500">Phone</p>
                            <p class="font-medium">{{ $message->phone ?: '—' }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500">Service</p>
                            <p class="font-medium">{{ $message->service ?: '—' }}</p>
                        </div>
                    </div>

                    <div>
                        <p class="text-gray-500 mb-2">Message</p>
                        <div class="p-4 border rounded bg-gray-50 whitespace-pre-wrap text-sm">{{ $message->message }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
