<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalculateController extends Controller
{
    public function index()
    {
        return view('pages.calculate.index');
    }

    public function result(Request $request)
    {
        return view('pages.calculate.result');
    }
}
