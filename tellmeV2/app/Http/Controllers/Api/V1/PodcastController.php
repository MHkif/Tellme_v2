<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePodcastRequest;
use App\Http\Resources\V1\PodcastCollection;
use App\Http\Resources\V1\PodcastResource;
use App\Models\Podcast;
use Illuminate\Http\Request;

class PodcastController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth:api');
    // }

    public function index()
    {
        return new PodcastCollection(Podcast::all());
        // return response()->json('From Poscasts');
    }

    public function show(Podcast $podcast)
    {
        return new PodcastResource($podcast);
    }
    public function store(StorePodcastRequest $request)
    {
        Podcast::create($request->validated());
        return response()->json(["created" => true, "message" => "Podcast Created Successfully"]);
    }

    public function update(StorePodcastRequest $request, Podcast $podcast){
        $podcast->update($request->validated());
        return response()->json(["updated" => true, "message" => "Podcast Updated Successfully"]);

    }
}
