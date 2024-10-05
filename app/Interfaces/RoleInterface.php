<?php

namespace App\Interfaces;

interface RoleInterface
{
    public function getRoles();

    public function getUserRoles($user_id);
}
