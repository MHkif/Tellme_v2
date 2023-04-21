<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Playlist_Podcast;

class PlaylistPodcastController extends Controller
{
    public function index()
    {
        return  Playlist_Podcast::all();
    }
}
