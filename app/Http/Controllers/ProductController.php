<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $products = Product::all();

        return response(view('products.index', ['products' => $products]));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return response(view('products.create'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request): RedirectResponse
    {
        if (Product::create($request->validated())) {
            return redirect(route('products.index'))->with('success', 'Added!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): Response
    {
        dd('show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): Response
    {
        $product = Product::findOrFail($id);

        return response(view('products.edit', ['product' => $product]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, string $id): RedirectResponse
    {
        $product = Product::findOrFail($id);

        if ($product->update($request->validated())) {
            return redirect(route('products.index'))->with('success', 'Updated!'); 
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $product = Product::findOrFail($id);

        if ($product->delete()) {
            return redirect(route('products.index'))->with('success', 'Deleted!');
        }

        return redirect(route('products.index'))->with('error', 'Sorry, unable to delete this!');
    }
}
