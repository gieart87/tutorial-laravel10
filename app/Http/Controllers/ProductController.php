<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Models\Brand;
use App\Models\Category;
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
        $brands = Brand::orderBy('name', 'asc')->get()->pluck('name', 'id');
        $categories = Category::orderBy('name', 'asc')->get()->pluck('name', 'id');

        return response(view('products.create', ['brands' => $brands, 'categories' => $categories]));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request): RedirectResponse
    {
        {
            $params = $request->validated();
            if ($product = Product::create($params)) {
                $product->categories()->sync($params['category_ids']);
    
                return redirect(route('products.index'))->with('success', 'Added!');
            }
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
        $brands = Brand::orderBy('name', 'asc')->get()->pluck('name', 'id');
        $categories = Category::orderBy('name', 'asc')->get()->pluck('name', 'id');


        return response(view('products.edit', ['product' => $product, 'brands' => $brands, 'categories' => $categories]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, string $id): RedirectResponse
    {
        $product = Product::findOrFail($id);
        $params = $request->validated();

        if ($product->update($params)) {
            $product->categories()->sync($params['category_ids']);

            return redirect(route('products.index'))->with('success', 'Updated!'); 
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $product = Product::findOrFail($id);
        $product->categories()->detach();

        if ($product->delete()) {
            return redirect(route('products.index'))->with('success', 'Deleted!');
        }

        return redirect(route('products.index'))->with('error', 'Sorry, unable to delete this!');
    }
}
