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
        $products = Product::get();
        return view('products.index', compact('products'));
        // return view('products.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'name' => 'required',
        //     'description' => 'required',
        //     'price' => 'required',
        //     'category_id' => 'required',
        // ]);
        // Product::create(
        //     [
        //         'name' => $request->name,
        //         'description' => $request->description,
        //         'price' => $request->price,
        //         'tags' => $request->tags,
        //         'image_path' => $request->image_path,
        //         'category_id' => $request->category_id,
        //     ]
        // );
        // dd($request->all());
        if ($request->hasFile('image_path')) {
            $image = $request->file('image_path');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            $requestData = $request->all();
            $requestData['image_path'] = $name;
            Product::create($requestData);
            return redirect()->back();
        } else {
            Product::create($request->all());
            return redirect()->back();
        }
        // Product::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // $product = Product::findorfail($id);
        // return view('products.edit', compact('product'));
        $product = Product::findorfail($id);
        // dd($product);
        return view('products.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // $product= Product::findorfail($id);
        // $product->update($request->all());
        // return redirect()->back();
        // $product = Product::findorfail($id);
        // $product->update($request->all());
        if ($request->hasFile('image_path')) {
            $image = $request->file('image_path');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            $requestData = $request->all();
            $requestData['image_path'] = $name;
            $product = Product::findorfail($id);
            $product->update($requestData);
            return redirect()->back();
        } else {
            $product = Product::findorfail($id);
            $product->update($request->all());
            return redirect()->back();
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findorfail($id);
        $product->delete();
        return redirect()->back();
    }
}
