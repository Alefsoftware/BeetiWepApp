<?php

namespace App\Interfaces\front;
use Request;

interface VendorRepositoryInterface
{
    public function index(Request $request);
}
