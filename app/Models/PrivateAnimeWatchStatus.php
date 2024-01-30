<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PrivateAnimeWatchStatus extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'season',
        'episode',
        'watch_status_id',
        'favourite_level_id',
        'private_anime_id',
        'user_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
    ];
    public function getRouteKeyName() : string
    {
       return 'id';
    }


   public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function privateAnime(): BelongsTo
    {
        return $this->belongsTo(PrivateAnime::class);
    }

    public function watchStatus(): BelongsTo
    {
        return $this->belongsTo(WatchStatus::class);
    }

    public function favouriteLevel(): BelongsTo
    {
        return $this->belongsTo(FavouriteLevel::class);
    }
}
