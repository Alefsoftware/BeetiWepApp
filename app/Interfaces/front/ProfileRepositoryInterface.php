<?php

namespace App\Interfaces\front;
use Illuminate\Http\Request;

interface ProfileRepositoryInterface
{
    public function index(Request $request);
    public function updateProfile(Request $request);
}
