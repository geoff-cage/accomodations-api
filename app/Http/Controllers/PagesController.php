<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
    {
        return view('pages.index');
    }

    public function registering()
    {
        return view('pages.register');
    }

    public function loginin()
    {
        return view('pages.login');
    }
}
