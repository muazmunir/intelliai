<?php

namespace App\Interfaces;

interface ServiceCategoryInterface
{
    public function getDataTable();

    public function saveServiceCategory($request);

    public function getServiceCategoryById(int $id);

    public function updateServiceCategory($request, int $id);

    public function deleteServiceCategory(int $id);
}
