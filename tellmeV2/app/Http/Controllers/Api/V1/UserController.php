<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use App\Models\Podcast;
use App\Models\PlayList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\V1\PodcastCollection;
use App\Http\Resources\V1\PlayListCollection;

class UserController extends Controller
{
    public function search(Request $request)
    {
        // return request('users');
        $users =  DB::table('users')->where('first_name', 'like', '%' . request('users') . '%')
            ->orWhere('last_name', 'like', '%' . request('users') . '%')
            ->orWhere('email', 'like', '%' . request('users') . '%')->get();

        return response()->json($users);
    }

    public function mypodcasts(Request $request)
    {
        $count = Podcast::where('user_id', $request->user_id)->count();
        return new PodcastCollection(Podcast::where('user_id', $request->user_id)->get());
    }
    public function playlists(Request $request)
    {
        $user = User::find($request->user_id);
        // dd($user);
        return new PlayListCollection($user->playLists);
    }
}
