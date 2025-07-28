<?php

namespace OGame\Http\Controllers;

use Illuminate\Support\Facades\File;

class WelcomeController extends Controller
{
    public function index()
    {
        $images = config('slideshow.images');

        return view('welcome', compact('images'));
    }
}



