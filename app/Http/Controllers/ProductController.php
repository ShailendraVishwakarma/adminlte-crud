<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // public function index()
    // {
    //     $products = Product::all();
    //     return view('products.index', compact('products'));
    // }

    public function index(Request $request)
    {
        $query = Product::query();

        // Name filter
        if ($request->name) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        // Min price filter
        if ($request->min_price) {
            $query->where('price', '>=', $request->min_price);
        }

        // Max price filter
        if ($request->max_price) {
            $query->where('price', '<=', $request->max_price);
        }

        $products = $query->orderBy('id', 'desc')
                      ->paginate(5)
                      ->withQueryString(); // filter + pagination together

    return view('products.index', compact('products'));
    }


    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
        ]);

        Product::create($request->all());
        return redirect()->route('products.index')->with('success', 'Product Added Successfully');
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $product->update($request->all());
        return redirect()->route('products.index')->with('success', 'Product Updated Successfully');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product Deleted Successfully');
    }
}
