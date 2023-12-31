<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrivateMangaGenre extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'private_genre_id',
        'private_manga_id',
    ];

}
