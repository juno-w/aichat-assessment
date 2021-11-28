<?php

namespace App\Support;

class Vision
{
    public $vision;

    // construct 3rd party API service.
    public function __construct()
    {
        // The magic with 3rd party API service starts here.
        $this->vision = '3rd Party API';
    }

    public function getInstance()
    {
        return $this->vision;
    }

    public function detect($file = null, $type = null): bool
    {
        // Faking a vision detection.
        return true;
    }
}
