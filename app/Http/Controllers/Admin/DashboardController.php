<?php

            namespace App\Http\Controllers\Admin;

            use App\Models\ContactMessage;
            use Illuminate\Routing\Controller;

            class DashboardController extends Controller
            {
                public function __invoke()
                {
                    $unreadMessagesCount = ContactMessage::whereNull('read_at')->count();
                    $recentMessages = ContactMessage::latest()->take(5)->get();

                    return view('dashboard', [
                        'unreadMessagesCount' => $unreadMessagesCount,
                        'recentMessages' => $recentMessages,
                    ]);
                }
            }
