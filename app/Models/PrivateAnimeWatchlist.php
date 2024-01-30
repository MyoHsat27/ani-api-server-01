<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PrivateAnimeWatchlist extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'watchlist_id',
        'private_anime_id',
    ];

    public function watchlist(): BelongsTo
    {
        return $this->belongsTo(Watchlist::class);
    }

    public function privateAnime(): BelongsTo
    {
        return $this->belongsTo(PrivateAnime::class);
    }

}
