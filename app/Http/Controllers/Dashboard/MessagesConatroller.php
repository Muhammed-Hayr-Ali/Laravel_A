<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class MessagesConatroller extends Controller
{
    public function unreadMessages()
    {
        $unreadMessages = Message::where('user_id', Auth::id())
            ->where('status', 'Unread')
            ->latest()
            ->limit(5)
            ->get();

        return view('dashboard.components.messages', compact('unreadMessages'));
    }

    public function readedMessages()
    {
        $unreadMessages = Message::where('user_id', Auth::id())
            ->where('status', 'Unread')
            ->get();

        if ($unreadMessages->isNotEmpty()) {
            $unreadMessages->each(function ($message) {
                $message->status = 'Read';
                $message->save();
            });
        }

        return view('dashboard.components.messages', compact('unreadMessages'));
    }
}
