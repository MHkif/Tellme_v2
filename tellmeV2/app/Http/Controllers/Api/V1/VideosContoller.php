<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\ShortVideo;
use Illuminate\Http\Request;
use App\Http\Requests\VideoRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ShortVideoResource;
use App\Http\Resources\V1\ShortVideoCollection;

class VideosContoller extends Controller
{
    public function index()
    {
        return new ShortVideoCollection(ShortVideo::all());
    }

    public function show(ShortVideo $video)
    {
        return new ShortVideoResource($video);
    }

    public function store(VideoRequest $request)
    {
        ShortVideo::create($request->validated());
        return response()->json(["created" => true, "message" => "ShortVideo Created Successfully"]);
    }
    public function update(VideoRequest $request, ShortVideo $video)
    {
        $video->update($request->validated());
        return response()->json(["updated" => true, "message" => "ShortVideo Updated Successfully"]);
    }
}
