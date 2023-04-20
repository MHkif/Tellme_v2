<?php

namespace App\Http\Controllers\Api\V1;

use App\Events\NewCall;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RoomController extends Controller
{
    public function callUser(Request $request)
    {
        $sender = User::find($request->sender);
        $receiver =  User::find($request->receiver);
        $room = new Room;
        $room->user_id = $sender->id;
        $room->save();
        $roomId = $room->id;
        $username = $sender->last_name;

        // if ($receiver->id != $sender->id) {
        // $receiver->notify(new CallingNotification($sender, $receiver, $room));
        broadcast(new NewCall($sender, $receiver, $room));
        // }

        return response()->json(['success']);
    }
}
