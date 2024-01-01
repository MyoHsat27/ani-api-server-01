<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WatchStatus extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function privateAnimeWatchStatuses(): HasMany
    {
        return $this->hasMany(PrivateAnimeWatchStatus::class, 'private_anime_watch_statuses');
    }

    public function privateMangaReadStatuses(): HasMany
    {
        return $this->hasMany(PrivateMangaReadStatus::class, 'private_manga_read_statuses');
    }
}
