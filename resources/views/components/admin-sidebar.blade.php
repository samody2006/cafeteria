@props(['active' => false])

    <div x-data="{ open: true }" class="flex h-screen bg-gray-900">
        <!-- Sidebar -->
        <div :class="{ 'w-64': open, 'w-20': !open }" class="bg-gray-900 text-white transition-all duration-300 fixed h-full left-0 top-0 overflow-y-auto pt-20">
            <!-- Sidebar Content -->
            <nav class="px-4 py-8">
                <!-- Dashboard -->
                <a href="{{ route('dashboard') }}"
                   class="flex items-center gap-4 px-4 py-3 rounded-lg mb-2 transition-colors {{ request()->routeIs('dashboard') ? 'bg-amber-600 text-white' : 'text-gray-400 hover:bg-gray-800' }}">
                    <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-3m0 0l7-4 7 4M5 9v10a1 1 0 001 1h12a1 1 0 001-1V9m-9 11v-5m0 0v-5m9 5v-5"></path>
                    </svg>
                    <span :class="{ 'hidden': !open }" class="text-sm font-medium">Dashboard</span>
                </a>

                <!-- Recipes -->
                <a href="{{ route('admin.recipes.index') }}"
                   class="flex items-center gap-4 px-4 py-3 rounded-lg mb-2 transition-colors {{ request()->routeIs('admin.recipes.*') ? 'bg-amber-600 text-white' : 'text-gray-400 hover:bg-gray-800' }}">
                    <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
                    </svg>
                    <span :class="{ 'hidden': !open }" class="text-sm font-medium">Recipes</span>
                </a>

                <!-- Contact Info -->
                <a href="{{ route('admin.contact.edit') }}"
                   class="flex items-center gap-4 px-4 py-3 rounded-lg mb-2 transition-colors {{ request()->routeIs('admin.contact.edit') ? 'bg-amber-600 text-white' : 'text-gray-400 hover:bg-gray-800' }}">
                    <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span :class="{ 'hidden': !open }" class="text-sm font-medium">Contact Info</span>
                </a>

                <!-- Messages -->
                <a href="{{ route('admin.contact.messages.index') }}"
                   class="flex items-center gap-4 px-4 py-3 rounded-lg mb-2 transition-colors relative {{ request()->routeIs('admin.contact.messages.*') ? 'bg-amber-600 text-white' : 'text-gray-400 hover:bg-gray-800' }}">
                    <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    <span :class="{ 'hidden': !open }" class="text-sm font-medium">Messages</span>
                </a>

                <!-- Profile -->
                <a href="{{ route('profile.edit') }}"
                   class="flex items-center gap-4 px-4 py-3 rounded-lg mb-2 transition-colors {{ request()->routeIs('profile.edit') ? 'bg-amber-600 text-white' : 'text-gray-400 hover:bg-gray-800' }}">
                    <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    <span :class="{ 'hidden': !open }" class="text-sm font-medium">Profile</span>
                </a>
            </nav>
        </div>

        <!-- Toggle Button -->
        <button @click="open = !open" class="fixed left-0 bottom-8 z-40 bg-amber-600 hover:bg-amber-700 text-white p-2 rounded-r-lg transition-all duration-300">
            <svg class="w-5 h-5" :class="{ 'rotate-180': !open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </button>

        <!-- Main Content Area -->
        <div :class="{ 'ml-64': open, 'ml-20': !open }" class="flex-1 transition-all duration-300">
            {{ $slot }}
        </div>
    </div>
