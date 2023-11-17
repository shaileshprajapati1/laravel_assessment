<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $res = Product::all();
        return  $res;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Product $product)
    {
        $product->name = $request->name;
        $product->price = $request->price;
        $product->category = $request->category;
        $product->description = $request->description;
        $product->gallery = $request->image;
        $product->save();
        return true;
    }


    public function uploadimage(Request $request, Product $product)
    {
        $uploadimage = time() . '.' . $request->gallery->getClientOriginalExtension();
        $request->gallery->move(public_path('/uploads'), $uploadimage);

        return json_encode($uploadimage);
    }
    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $res = Product::find($id);
        return $res;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
