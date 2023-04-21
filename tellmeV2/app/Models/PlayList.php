<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PlayList extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'user_id', 'podcast_id'];

    protected $table = 'playlists';
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
