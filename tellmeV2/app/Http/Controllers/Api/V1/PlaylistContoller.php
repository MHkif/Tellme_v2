<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\PlayListCollection;
use App\Http\Resources\V1\PodcastCollection;
use App\Models\PlayList;

class PlaylistContoller extends Controller
{
    public function index()
    {
        return new PlayListCollection(PlayList::all());
        // return response()->json('From Poscasts');
    }
    public function show()
    {
    }
    public function store()
    {
    }

    public function update()
    {
    }

    public function delete()
    {
    }
}
