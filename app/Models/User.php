<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'slug',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
    ];

    public function readlists(): HasMany
    {
        return $this->hasMany(Readlist::class);
    }

    public function watchlists(): HasMany
    {
        return $this->hasMany(Watchlist::class);
    }

    public function privateMangas(): HasMany
    {
        return $this->hasMany(PrivateManga::class);
    }

    public function privateAnimes(): HasMany
    {
        return $this->hasMany(PrivateAnime::class);
    }

    public function privateGenres(): HasMany
    {
        return $this->hasMany(PrivateGenre::class);
    }

    public function privateMangaReadStatuses(): HasMany
    {
        return $this->hasMany(PrivateMangaReadStatus::class);
    }
}
