<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() 
    {
        $products = Product::all();

        return view('pages.product.index', compact('products'));
    }

    public function create() 
    {
        return view('pages.product.create');
    }

    public function store(CreateProductRequest $request)
    {
        Product::create($request->all());

        return redirect()->route('product.index')->with('success', 'Sukses menambahkan data produk');
    }

    public function edit($id) 
    {
        $product = Product::findOrFail($id);

        return view('pages.product.edit', compact('product'));
    }

    public function update(UpdateProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->update($request->all());

        return redirect()->route('product.index')->with('success', 'Sukses mengubah data produk');
    }

    public function destroy($id)
    {
        Product::destroy($id);

        return redirect()->route('product.index')->with('success', 'Sukses menghapus data produk');
    }

}
