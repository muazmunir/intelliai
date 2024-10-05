<?php

namespace App\Repositories;

use App\Interfaces\RoleInterface;
use App\Models\User;
use Spatie\Permission\Models\Role;

class RoleRepository implements RoleInterface
{
    private $role;

    private $user;

    public function __construct()
    {
        $this->role = new Role();
        $this->user = new User();
    }

    public function getRoles()
    {
        return $this->role->all();
    }

    public function getUserRoles($user_id)
    {
        $user = $this->user->with('roles')->findOrFail($user_id);

        return $user->roles;
    }
}
