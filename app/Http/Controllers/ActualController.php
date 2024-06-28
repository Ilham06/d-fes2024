<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActualCreateRequest;
use App\Http\Requests\ActualUpdateRequest;
use App\Models\Actual;
use Illuminate\Http\Request;

class ActualController extends Controller
{
    public function index() 
    {
        $actuals = Actual::all();

        return view('pages.actual.index', compact('actuals'));
    }

    public function create() 
    {
        return view('pages.actual.create');
    }

    public function edit($id) 
    {
        $actual = Actual::findOrFail($id);

        return view('pages.actual.edit', compact('actual'));
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
}
