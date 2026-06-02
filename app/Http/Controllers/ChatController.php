<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Group;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\MessageSent;

class ChatController extends Controller
{
    public function index(Request $request)
    {
        // ambil semua user selain user login
        $users = User::where('id', '!=', Auth::id())->get();

        // ambil semua group
        $groups = Group::all();

        // ambil private message saja
        $messages = Message::where(function ($query) use ($request) {

            $query->where('sender_id', auth()->id())
                  ->where('receiver_id', $request->user_id);

        })->orWhere(function ($query) use ($request) {

            $query->where('sender_id', $request->user_id)
                  ->where('receiver_id', auth()->id());

        })->whereNull('group_id')->get();

        return view('chat.index', compact(
            'users',
            'messages',
            'groups'
        ));
    }

    public function send(Request $request)
    {
        $message = Message::create([

            'sender_id' => auth()->id(),

            'receiver_id' => $request->receiver_id,

            'message' => $request->message,

        ]);

        // realtime event
        event(new MessageSent($message));

        return back();
    }
}