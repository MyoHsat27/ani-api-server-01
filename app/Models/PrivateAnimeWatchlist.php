<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
