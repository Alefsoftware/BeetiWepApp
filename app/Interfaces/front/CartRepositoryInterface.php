<?php

namespace App\Interfaces\front;
use Request;

interface CartRepositoryInterface
{
    public function index(Request $request);
    public function store(Request $request);
    public function update(Request $request);
    public function delete($id);
    public function clear($user_id);
}
