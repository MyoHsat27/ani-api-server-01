<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PrivateAnimeSeason extends Model
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
        'description',
        'episode',
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

    public function privateAnime(): BelongsTo
    {
        return $this->belongsTo(PrivateAnime::class);
    }

    public function releaseStatus(): BelongsTo
    {
        return $this->belongsTo(ReleaseStatus::class);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

}
