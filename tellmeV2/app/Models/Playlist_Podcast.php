<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Playlist_Podcast extends Model
{
    use HasFactory;
    protected $fillable = ['podcast_id', 'playlist_id'];
}
