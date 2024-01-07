<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserRoleController extends Controller
{
    public function addRole(User $user, $role_id)
    {
        $user->roles()->attach($role_id);
    }

    public function revokeRole(User $user)
    {
        $user->roles()->detach();
    }
}
