<?php

namespace App\Interfaces\front;
use Request;

interface ProfileRepositoryInterface
{
    public function index(Request $request);
    public function updateProfile(Request $request);
}
