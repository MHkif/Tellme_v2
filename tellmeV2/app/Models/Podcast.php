<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Podcast extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'url', 'duration', 'category_id', 'cover', 'user_id'];

    public function playlists(): BelongsToMany
    {
        return $this->belongsToMany(PlayList::class, 'playlist_podcasts', 'podcast_id', 'playlist_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
