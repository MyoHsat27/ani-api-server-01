<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ReleaseStatus extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'type',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function privateAnimes(): HasMany
    {
        return $this->hasMany(PrivateAnime::class);
    }

    public function privateMangas(): HasMany
    {
        return $this->hasMany(PrivateManga::class);
    }

    public function privateAnimeSeasons(): HasMany
    {
        return $this->hasMany(PrivateAnimeSeason::class);
    }

    public function privateAnimeMovies(): HasMany
    {
        return $this->hasMany(PrivateAnimeMovie::class);
    }
}
