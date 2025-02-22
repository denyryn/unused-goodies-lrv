<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Application\UserApplication;

class HomePage extends Controller
{
    public function __construct(UserApplication $userApplication)
    {
        $this->userApplication = $userApplication;
    }

    public function index()
    {
        $data = [];
        $data['userFirstName'] = $this->userApplication->getUserFirstName(auth()->user()->id);
        return view('landing', $data);
    }
}
