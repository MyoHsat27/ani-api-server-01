<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Scout\Searchable;

class PrivateAnime extends Model
{
    use HasFactory, Searchable;

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
        'resource_url',
        'image_url',
        'release_status_id',
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

    /**
     * Get the indexable data array for the model.
     *
     * @return array<string, mixed>
     */
    public function toSearchableArray(): array
    {
        return [
            'name'        => $this->name,
            'description' => $this->description,
            'alt_name' => $this->alt_name,
        ];
    }

    public function releaseStatus():BelongsTo
    {
        return $this->belongsTo(ReleaseStatus::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function privateAnimeWatchStatuses():HasMany
    {
        return $this->hasMany(PrivateAnimeWatchStatus::class);
    }

    public function privateAnimeSeasons(): HasMany
    {
        return $this->hasMany(PrivateAnimeSeason::class);
    }

    public function privateAnimeMovies(): HasMany
    {
        return $this->hasMany(PrivateAnimeMovie::class);
    }

    public function privateGenres(): BelongsToMany
    {
        return $this->belongsToMany(PrivateGenre::class, 'private_anime_genres');
    }

    public function privateAnimeWatchlist():BelongsToMany
    {
        return $this->belongsToMany(Watchlist::class,'private_anime_watchlists');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

}
