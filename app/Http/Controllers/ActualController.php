<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ActualController extends Controller
{
    public function index() 
    {
        return view('pages.actual.index');
    }

    public function create() 
    {
        return view('pages.actual.create');
    }

    public function edit($id) 
    {
        return view('pages.actual.edit');
    }
}
