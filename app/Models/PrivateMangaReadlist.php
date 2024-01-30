<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PrivateMangaReadlist extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'readlist_id',
        'private_manga_id',
    ];

    public function privateManga(): BelongsTo
    {
        return $this->belongsTo(PrivateManga::class);
    }

    public function readlist(): BelongsTo
    {
        return $this->belongsTo(Readlist::class);
    }

}
