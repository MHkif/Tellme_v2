<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PlayList extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'user_id', 'podcast_id'];

    protected $table = 'playlists';
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function podcasts(): BelongsToMany
    {
        return $this->belongsToMany(Podcast::class, 'playlist_podcasts', 'podcast_id', 'playlist_id');
    }
}
