<?php

namespace App\Interfaces;

interface FeautreInterface
{
    public function getDataTable();

    public function saveFeature($request);

    public function getFeature($id);

    public function updateFeature($request, $id);
}
