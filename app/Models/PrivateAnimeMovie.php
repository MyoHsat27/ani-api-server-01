<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PrivateAnimeMovie extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
        'alt_name',
        'description',
        'release_status_id',
        'private_anime_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function privateAnime(): BelongsTo
    {
        return $this->belongsTo(PrivateAnime::class);
    }

    public function releaseStatus(): BelongsTo
    {
        return $this->belongsTo(ReleaseStatus::class);
    }

}
