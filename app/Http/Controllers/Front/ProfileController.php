<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\front\ProfileRepositoryInterface;

class ProfileController extends Controller
{
    private ProfileRepositoryInterface $profileRepository;
    public function __construct(ProfileRepositoryInterface $profileRepository)
    {
        $this->profileRepository = $profileRepository;
    }

    public function index(Request $request)
    {
        return $this->profileRepository->index($request);
    }
    public function updateProfile(Request $request)
    {
        return $this->profileRepository->updateProfile($request);
    }
}
