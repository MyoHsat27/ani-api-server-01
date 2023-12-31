<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
