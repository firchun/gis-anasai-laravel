<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Events\ChatEvent;
use App\Models\Chat;
use App\Models\Lapak;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function lapak()
    {
        $room_user = DB::table('chat_room_users')->where('id_user', Auth::user()->id)->get();
        // dd($room_user);
        $data = [
            'title' => 'Chat Pelanggan',
            'room_user' => $room_user,
        ];
        return view('pages.chat.index', $data);
    }
    public function room($room)
    {
        // Get room
        $room = DB::table('chat_rooms')->where('id', $room)->first();

        // Get users
        $user =  DB::table('chat_room_users')->where('chat_room_id', $room->id);
        $users = $user->get();
        // dd($users->where('id_user', '!=', Auth::user()->id));

        $id_user = $user->where('id_user', '!=', Auth::user()->id)->first()->id_user;

        // dd($id_user);
        $lapak = Lapak::where('id_user', $id_user)->first();

        $title = 'Chat Lapak : ' . $lapak->nama_lapak;

        return view('pages.landing_page.chat', compact('room', 'users', 'title', 'lapak'));
    }

    public function getChat($room)
    {
        // Join with user
        $chats = DB::table('chats')
            ->join('users', 'users.id', '=', 'chats.id_user')
            ->where('chat_room_id', $room)
            ->select('chats.*', 'users.name as user_name')
            ->get();

        return response()->json($chats);
    }

    // Send chat
    public function sendChat(Request $request)
    {
        $chat = DB::table('chats')->insert([
            'chat_room_id' => $request->room,
            'id_user' => auth()->user()->id,
            'message' => $request->message,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Chat::where('chat_room_id', $request->room)
            ->where('id_user', '!=', Auth::user()->id)
            ->update(['is_read' => 1]);

        // Trigger event
        broadcast(new ChatEvent($request->room, $request->message, auth()->user()->id));

        return response()->json($chat);
    }

    public function chat($user)
    {
        $my_id = auth()->user()->id;
        $target_id = $user;

        $my_room = DB::table('chat_room_users');
        $target_room = clone $my_room;

        // Get my room
        $my_room = $my_room->where('id_user', $my_id)->get()->keyBy('chat_room_id')->toArray();
        // Get target room
        $target_room = $target_room->where('id_user', $target_id)->get()->keyBy('chat_room_id')->toArray();

        // Check room
        $room = array_intersect_key($my_room, $target_room);

        // If room exists
        if ($room) return redirect()->route('chat.room', ['room' => array_keys($room)[0]]);

        // If room doesn't exist
        $uuid = Str::orderedUuid();
        $room = DB::table('chat_rooms')->insert([
            'id' => $uuid,
            'name' => 'generate by system',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Add users to room
        DB::table('chat_room_users')->insert([
            [
                'chat_room_id' => $uuid,
                'id_user' => $my_id,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'chat_room_id' => $uuid,
                'id_user' => $target_id,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        return redirect()->route('chat.room', ['room' => $uuid]);
    }
}
