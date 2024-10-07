<?php

namespace App\Interfaces;

interface UserInterface
{
    public function getDataTable();

    public function saveUser($request);

    public function getUser($user_id);

    public function updateUser($request, $id);
}
