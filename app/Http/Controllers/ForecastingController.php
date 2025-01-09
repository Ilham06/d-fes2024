<?php

namespace App\Http\Controllers;

use App\Models\Forecasting;
use Illuminate\Http\Request;

class ForecastingController extends Controller
{
    public function index() 
    {
        $records = Forecasting::with('product')->whereIsSaved(true)->orderBy('created_at','desc')->get();
        return view('pages.calculate.saved', compact('records'));
    }

    public function destroy($id)
    {
        Forecasting::destroy($id);

        return redirect()->route('forecasting.index')->with('success', 'Sukses menghapus data peramalan');
    }
}
