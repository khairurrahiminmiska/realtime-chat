<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Message;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $group = Group::create([
            'name' => $request->name
        ]);

        // tambah member
        if ($request->users) {

            $group->users()->attach($request->users);

        }

        // tambah creator
        $group->users()->attach(auth()->id());

        return back();
    }

    public function show($id)
    {
        $group = Group::findOrFail($id);

        $messages = Message::where('group_id', $id)->get();

        return view('group.chat', compact(
            'group',
            'messages'
        ));
    }

    public function send(Request $request)
    {
        Message::create([
            'sender_id' => auth()->id(),
            'group_id' => $request->group_id,
            'message' => $request->message,
        ]);

        return back();
    }
}