<?php

namespace App\Http\Controllers;

use App\Exports\ActualExport;
use App\Http\Requests\ActualCreateRequest;
use App\Http\Requests\ActualUpdateRequest;
use App\Imports\ActualImport;
use App\Models\Actual;
use App\Models\Product;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ActualController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::all();

        $actuals = Actual::with('product')
            ->when($request->product_id, function ($query, $productId) {
                return $query->where('product_id', $productId);
            })
            ->get();

        return view('pages.actual.index', compact('actuals', 'products'));
    }

    public function create()
    {
        $products = Product::all();

        return view('pages.actual.create', compact('products'));
    }

    public function edit($id)
    {
        $products = Product::all();
        $actual = Actual::with('product')->findOrFail($id);

        return view('pages.actual.edit', compact('actual', 'products'));
    }

    public function store(ActualCreateRequest $request)
    {
        Actual::create($request->all());

        return redirect()->route('actual.index')->with('success', 'Sukses menambahkan data aktual');
    }

    public function update(ActualUpdateRequest $request, $id)
    {
        $actual = Actual::findOrFail($id);
        $actual->update($request->all());

        return redirect()->route('actual.index')->with('success', 'Sukses mengubah data aktual');
    }

    public function destroy($id)
    {
        Actual::destroy($id);

        return redirect()->route('actual.index')->with('success', 'Sukses menghapus data aktual');
    }

    public function import(Request $request)
    {
        $request->validate([
            'dataset' => 'required|mimes:csv,xls,xlsx'
        ]);

        Excel::import(new ActualImport, $request->file('dataset'));

        return redirect()->route('actual.index')->with('success', 'sukses import data');
    }

    public function export()
    {
        return Excel::download(new ActualExport(), 'data-aktual.xlsx');
    }
}
