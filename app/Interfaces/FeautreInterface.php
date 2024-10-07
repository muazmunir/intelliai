<?php

namespace App\Interfaces;

interface FeautreInterface
{
    public function getDataTable();

    public function saveFeature($request);
}
