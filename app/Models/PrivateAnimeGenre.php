<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PrivateAnimeGenre extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'private_genre_id',
        'private_anime_id',
    ];

    public function privateGenre(): BelongsTo
    {
        return $this->belongsTo(PrivateGenre::class);
    }
    public function privateAnime(): BelongsTo
    {
        return $this->belongsTo(PrivateAnime::class);
    }
}
