<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('products.index', [
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validasi = $request->validate([
            'nama_product' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'image|file|max:4000',
            'harga' => 'integer|required',
            'category_id' => 'required',
            'rating' => 'required'
        ]);
        if ($request->file('gambar')){
            $validasi['gambar'] = $request->file('gambar')->store('product-image');
        }
        if (Auth::check() && Auth::user()->roles->role_name == 'admin') {
            $validasi['status'] = 'approved';
        }
        else {
            $validasi['status'] = 'pending';
        }
        Product::create($validasi);
        return redirect()->route('products.index')->withInput()->with('success','Berhasil menambah data product');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $categories = Category::all();
        return view('products.show', [
            "product" => $product
        ], compact('categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
            $categories = Category::all();
            return view('products.edit', [
                "product" => $product
            ], compact('categories'));

            // if (! Gate::allows('admin', $product)) {
            //     abort(403);
            // }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $validasi = $request->validate([
            'nama_product' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'image|file|max:4000',
            'harga' => 'integer|required',
            'category_id' => 'required',
            'rating' => 'required',
            'status' => 'required'
        ]);
        if ($request->hasFile('gambar')){
            if ($request->oldImage){
                Storage::delete($request->oldImage);
            }
            $validasi['gambar'] = $request->file('gambar')->store('product-image');
        }
        if ($validasi['status'] != 'approved' && $validasi['status'] != 'pending') {
            return redirect()->route('sliders.index')->withInput()->with('error', 'Pastikan status approved atau pending');
        }
        $product->update($validasi);
        return redirect()->route('products.index')->withInput()->with('success','Berhasil mengubah data product');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if ($product->gambar){
            Storage::delete($product->gambar);
        }
        if ($product) $product->delete();
        return redirect()->route('products.index')->with('success','Berhasil menghapus data product');
    }
}
