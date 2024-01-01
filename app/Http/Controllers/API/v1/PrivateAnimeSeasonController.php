<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Response\CustomResponse;
use App\Models\PrivateAnime;
use App\Models\User;
use Illuminate\Http\Request;

class PrivateAnimeSeasonController extends Controller
{
    protected CustomResponse $customResponse;

    public function __construct( CustomResponse $customResponse)
    {
        $this->customResponse = $customResponse;
    }

    public function index(User $user, PrivateAnime $anime)
    {
        //
    }
}
