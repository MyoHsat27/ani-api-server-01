<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PrivateManga extends Model
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
        'description',
        'alt_name',
        'chapter',
        'resource_url',
        'image_url',
        'release_status_id',
        'manga_type_id',
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
            'alt_name'    => $this->alt_name,
            'description' => $this->description,
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function releaseStatus(): BelongsTo
    {
        return $this->belongsTo(ReleaseStatus::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function mangaType(): BelongsTo
    {
        return $this->belongsTo(MangaType::class);
    }

    public function privateMangaGenres(): BelongsToMany
    {
        return $this->belongsToMany(PrivateMangaGenre::class, 'private_manga_genres');
    }

    public function privateMangaReadlists(): BelongsToMany
    {
        return $this->belongsToMany(PrivateMangaReadlist::class, 'private_manga_readlists');
    }

    public function privateMangaReadStatus(): HasMany
    {
        return $this->hasMany(PrivateMangaReadStatus::class, 'private_manga_read_statuses');
    }

}
