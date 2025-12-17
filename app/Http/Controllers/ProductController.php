<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::where('user_id', Auth::id());

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
                          ->withQueryString();

        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
             'name'  => 'required|min:3',
             'price' => 'required|numeric|min:1',
        ]);

        Product::create([
            'name'        => $request->name,
            'price'       => $request->price,
            'description' => $request->description,
            'user_id'     => Auth::id(), // ✅ logged-in user
        ]);

        return redirect()
            ->route('products.index')
            ->with('success', 'Product Added Successfully');
    }

    public function edit(Product $product)
    {
        // ❌ security check (extra safety)
        abort_if($product->user_id !== Auth::id(), 403);

        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        abort_if($product->user_id !== Auth::id(), 403);

        $product->update($request->only(['name', 'price', 'description']));

        return redirect()
            ->route('products.index')
            ->with('success', 'Product Updated Successfully');
    }

    public function destroy(Product $product)
    {
        abort_if($product->user_id !== Auth::id(), 403);

        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('success', 'Product Deleted Successfully');
    }
}
