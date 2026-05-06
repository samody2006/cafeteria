<x-admin-layout :unreadMessagesCount="$unreadMessagesCount" :recentMessages="$recentMessages">
                                           <x-slot name="header">
                                               <h2 class="font-semibold text-2xl text-gray-800">
                                                   {{ __('Dashboard') }}
                                               </h2>
                                           </x-slot>

                                           <div class="grid gap-6 md:grid-cols-3 mb-8">
                                               <!-- Recipes Card -->
                                               <div class="bg-white rounded-lg shadow p-6">
                                                   <div class="flex items-center justify-between">
                                                       <div>
                                                           <p class="text-gray-500 text-sm">Total Recipes</p>
                                                           <p class="text-3xl font-bold text-gray-900">{{ \App\Models\Recipe::count() }}</p>
                                                       </div>
                                                       <svg class="w-12 h-12 text-amber-600 opacity-20" fill="currentColor" viewBox="0 0 24 24">
                                                           <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z"></path>
                                                       </svg>
                                                   </div>
                                               </div>

                                               <!-- Merged Messages Card -->
                                               <div class="bg-white rounded-lg shadow p-6">
                                                   <div class="flex items-center justify-between mb-4">
                                                       <div>
                                                           <p class="text-gray-500 text-sm">Contact Messages</p>
                                                           <p class="text-3xl font-bold text-gray-900">{{ \App\Models\ContactMessage::count() }}</p>
                                                       </div>
                                                       <svg class="w-12 h-12 text-blue-600 opacity-20" fill="currentColor" viewBox="0 0 24 24">
                                                           <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z"></path>
                                                       </svg>
                                                   </div>
                                                   <div class="border-t pt-4">
                                                       <div class="flex items-center justify-between">
                                                           <p class="text-gray-600 text-sm font-medium">Unread</p>
                                                           <span class="inline-flex items-center justify-center px-3 py-1 text-sm font-bold text-white bg-red-600 rounded-full">
                                                               {{ $unreadMessagesCount }}
                                                           </span>
                                                       </div>
                                                   </div>
                                               </div>

                                               <!-- Users Card -->
                                               <div class="bg-white rounded-lg shadow p-6">
                                                   <div class="flex items-center justify-between">
                                                       <div>
                                                           <p class="text-gray-500 text-sm">Total Users</p>
                                                           <p class="text-3xl font-bold text-gray-900">{{ \App\Models\User::count() }}</p>
                                                       </div>
                                                       <svg class="w-12 h-12 text-green-600 opacity-20" fill="currentColor" viewBox="0 0 24 24">
                                                           <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z"></path>
                                                       </svg>
                                                   </div>
                                               </div>
                                           </div>

                                           <!-- Quick Actions -->
                                           <div class="bg-white rounded-lg shadow p-6">
                                               <h3 class="text-lg font-semibold text-gray-900 mb-6">Quick Actions</h3>
                                               <div class="grid gap-4 md:grid-cols-3">
                                                   <a href="{{ route('admin.recipes.index') }}"
                                                      class="px-6 py-4 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition-colors text-center font-medium">
                                                       Manage Recipes
                                                   </a>
                                                   <a href="{{ route('admin.contact.edit') }}"
                                                      class="px-6 py-4 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors text-center font-medium">
                                                       Edit Contact Info
                                                   </a>
                                                   <a href="{{ route('admin.contact.messages.index') }}"
                                                      class="px-6 py-4 bg-slate-800 text-white rounded-lg hover:bg-slate-900 transition-colors text-center font-medium">
                                                       View Messages
                                                   </a>
                                               </div>
                                           </div>
                                       </x-admin-layout>
