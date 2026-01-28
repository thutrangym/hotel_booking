<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return view('pages.home');
    }

    public function live()
    {
        return view('pages.live');
    }

    public function rooms()
    {
        return view('pages.rooms');
    }

    public function facilities()
    {
        return view('pages.facilities');
    }

    public function offers()
    {
        return view('pages.offers');
    }

    public function gallery()
    {
        return view('pages.gallery');
    }

    public function contact()
    {
        return view('pages.contact');
    }
}
