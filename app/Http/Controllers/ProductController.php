<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $products = [
            [
                'id' => 1,
                'sku' => '#AB12312',
                'name' => 'Product A',
                'price' => 15000
            ],
            [
                'id' => 2,
                'sku' => '#CD12312',
                'name' => 'Product B',
                'price' => 20000
            ]
        ];

        return response(view('products.index', ['products' => $products]));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        dd('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        dd('store');
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
        dd('edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        dd('update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        dd('store');
    }
}
