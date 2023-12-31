<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
