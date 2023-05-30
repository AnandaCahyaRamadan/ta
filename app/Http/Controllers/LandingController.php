<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Models\Product;
use Illuminate\Http\Request;


class LandingController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $sliders = Slider::all();
        return view('landing', [
            'products' => $products,
            'sliders' => $sliders
        ]);
    }
    
    // public function search(Request $request)
    // {
    //     $sliders = Slider::all();
    //     $keyword = $request->search;
    //     $products = Product::where('nama_product', 'like', "%" . $keyword . "%")->orWhere('deskripsi', 'like', "%" . $keyword . "%")->get();
    //     if ($products->isEmpty()) {
    //     return redirect()->back()->with('error', 'Tidak ada produk yang ditemukan.');
    //     }
    //     return view('landing', compact('products','sliders'))->with('i', (request()->input('page', 1) - 1) * 5);
    // }
    
    public function search(Request $request)
    {
        $keyword = $request->search;
        $minPrice = $request->min_price;
        $maxPrice = $request->max_price;
    
        $query = Product::query();
    
        if (!empty($keyword)) {
            $query->where(function ($q) use ($keyword) {
                $q->where('nama_product', 'like', "%" . $keyword . "%")
                    ->orWhere('deskripsi', 'like', "%" . $keyword . "%")
                    ->orWhereHas('categories', function ($q) use ($keyword) {
                        $q->where('category_name', 'like', "%" . $keyword . "%");
                    });
            });
        }
    
        if (!empty($minPrice)) {
            $query->where('harga', '>=', $minPrice);
        }
    
        if (!empty($maxPrice)) {
            $query->where('harga', '<=', $maxPrice);
        }
    
        $products = $query->get();
    
        $sliders = Slider::all();
        
        if ($products->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ada produk yang ditemukan.');
        }
        return view('landing', compact('products', 'sliders'));
    }
    
    
    
}
