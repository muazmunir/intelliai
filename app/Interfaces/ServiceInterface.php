<?php

namespace App\Interfaces;

interface ServiceInterface
{
    public function getDataTable();

    public function getService($id);

    public function saveService($request);

    public function updateService($request, int $id);

    public function deleteService(int $id);
}
