<nav class="fixed top-0 left-0 right-0 z-50 bg-white border-b border-gray-200 shadow-sm">
                             <div class="px-6 py-4 flex justify-between items-center">
                                 <!-- Logo/Branding -->
                                 <div class="flex items-center gap-3">
                                     <a href="{{ route('dashboard') }}" class="flex items-center gap-2 group">
                                         <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-10 w-auto">
                                         <span class="text-xl font-bold text-gray-800 tracking-tight group-hover:text-amber-600 transition-colors">
                                             Dashboard
                                         </span>
                                     </a>
                                 </div>

                                 <!-- Right Section: Notifications & Profile -->
                                 <div class="flex items-center gap-6">
                                     <!-- Bell Icon with Message Count -->
                                     <div class="relative" x-data="{ open: false }">
                                         <button @click="open = !open" class="relative text-gray-600 hover:text-gray-900 transition-colors">
                                             <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                                             </svg>
                                             @if($unreadMessagesCount > 0)
                                                 <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full">
                                                     {{ $unreadMessagesCount }}
                                                 </span>
                                             @endif
                                         </button>

                                         <!-- Dropdown Menu -->
                                         <div @click.away="open = false"
                                              x-show="open"
                                              class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-xl border border-gray-200 overflow-hidden"
                                              style="display: none;">
                                             <div class="p-4 border-b border-gray-200">
                                                 <h3 class="text-sm font-semibold text-gray-900">Recent Messages</h3>
                                             </div>
                                             <div class="max-h-96 overflow-y-auto">
                                                 @forelse($recentMessages as $message)
                                                     <a href="{{ route('admin.contact.messages.show', $message) }}"
                                                        class="block px-4 py-3 hover:bg-gray-50 border-b border-gray-100 transition-colors {{ is_null($message->read_at) ? 'bg-blue-50' : '' }}">
                                                         <div class="flex items-start justify-between">
                                                             <div class="flex-1">
                                                                 <p class="text-sm font-medium text-gray-900">{{ $message->name }}</p>
                                                                 <p class="text-xs text-gray-500 truncate">{{ $message->message }}</p>
                                                             </div>
                                                             @if(is_null($message->read_at))
                                                                 <span class="inline-block w-2 h-2 bg-blue-500 rounded-full ml-2 flex-shrink-0"></span>
                                                             @endif
                                                         </div>
                                                         <p class="text-xs text-gray-400 mt-1">{{ $message->created_at->diffForHumans() }}</p>
                                                     </a>
                                                 @empty
                                                     <div class="px-4 py-6 text-center">
                                                         <p class="text-sm text-gray-500">No messages</p>
                                                     </div>
                                                 @endforelse
                                             </div>
                                             @if($unreadMessagesCount > 0)
                                                 <div class="p-2 border-t border-gray-200 bg-gray-50">
                                                     <a href="{{ route('admin.contact.messages.index') }}"
                                                        class="block text-center text-sm text-amber-600 hover:text-amber-700 font-medium py-2">
                                                         View all messages
                                                     </a>
                                                 </div>
                                             @endif
                                         </div>
                                     </div>

                                     <!-- Profile Dropdown -->
                                     <div x-data="{ open: false }" class="relative">
                                         <button @click="open = !open"
                                                 class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100 transition-colors">
                                             <!-- Avatar -->
                                             <div class="w-8 h-8 rounded-full bg-amber-100 text-amber-700 flex items-center justify-center font-semibold text-sm">
                                                 @if(Auth::user()->profile_image)
                                                     <img src="{{ Auth::user()->getProfileImageUrl() }}"
                                                          alt="{{ Auth::user()->name }}"
                                                          class="w-full h-full rounded-full object-cover">
                                                 @else
                                                     {{ Auth::user()->getInitials() }}
                                                 @endif
                                             </div>

                                             <!-- Name & Dropdown Arrow -->
                                             <div class="flex items-center gap-2">
                                                 <span class="text-sm font-medium text-gray-800">{{ Auth::user()->name }}</span>
                                                 <svg :class="{ 'rotate-180': open }"
                                                      class="w-4 h-4 text-gray-600 transition-transform"
                                                      fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                                                 </svg>
                                             </div>
                                         </button>

                                         <!-- Dropdown Content -->
                                         <div @click.away="open = false"
                                              x-show="open"
                                              class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl border border-gray-200 overflow-hidden"
                                              style="display: none;">
                                             <div class="px-4 py-3 border-b border-gray-200">
                                                 <p class="text-sm font-semibold text-gray-900">{{ Auth::user()->name }}</p>
                                                 <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                                             </div>
                                             <a href="{{ route('profile.edit') }}"
                                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                                 Edit Profile
                                             </a>
                                             <form method="POST" action="{{ route('logout') }}" class="border-t border-gray-200">
                                                 @csrf
                                                 <button type="submit"
                                                         class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                                     Logout
                                                 </button>
                                             </form>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </nav>
