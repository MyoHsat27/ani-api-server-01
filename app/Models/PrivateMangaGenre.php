<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function private_genre(): BelongsTo
    {
        return $this->belongsTo(PrivateGenre::class);
    }

    public function private_manga(): BelongsTo
    {
        return $this->belongsTo(PrivateManga::class);
    }

}
