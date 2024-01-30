<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PrivateMangaReadStatus extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'chapter',
        'favourite_level_id',
        'watch_status_id',
        'private_manga_id',
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

    public function privateManga(): BelongsTo
    {
        return $this->belongsTo(PrivateManga::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function favouriteLevel(): BelongsTo
    {
        return $this->belongsTo(FavouriteLevel::class);
    }

    public function watchStatus(): BelongsTo
    {
        return $this->belongsTo(WatchStatus::class);
    }
}
