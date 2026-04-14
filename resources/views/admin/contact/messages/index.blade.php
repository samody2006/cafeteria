<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Contact Messages</h2>
                <p class="text-sm text-gray-500">Latest inquiries from the contact page</p>
            </div>
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
                                    <th class="py-3 pr-4">Name</th>
                                    <th class="py-3 pr-4">Email</th>
                                    <th class="py-3 pr-4">Phone</th>
                                    <th class="py-3 pr-4">Service</th>
                                    <th class="py-3 pr-4">Received</th>
                                    <th class="py-3 text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse($messages as $message)
                                    <tr>
                                        <td class="py-3 pr-4 font-medium text-gray-900">{{ $message->name }}</td>
                                        <td class="py-3 pr-4"><a class="text-amber-700" href="mailto:{{ $message->email }}">{{ $message->email }}</a></td>
                                        <td class="py-3 pr-4">{{ $message->phone ?: '—' }}</td>
                                        <td class="py-3 pr-4">{{ $message->service ?: '—' }}</td>
                                        <td class="py-3 pr-4 text-gray-500">{{ $message->created_at->format('d M, H:i') }}</td>
                                        <td class="py-3 text-right space-x-2">
                                            <a href="{{ route('admin.contact.messages.show', $message) }}" class="text-amber-700 hover:underline">View</a>
                                            <form action="{{ route('admin.contact.messages.destroy', $message) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Delete this message?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td class="py-4 text-gray-500" colspan="6">No messages yet.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">{{ $messages->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
