<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreSliderRequest;
use App\Http\Requests\UpdateSliderRequest;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::all();
        return view('sliders.index',[
            'sliders' => $sliders
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sliders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSliderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Slider $slider)
    {
        $validasi = $request->validate([
            'title' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'image|file|max:3000'
        ]);
        
        if ($request->file('gambar')){
            $validasi['gambar'] = $request->file('gambar')->store('sliders');
        };

        if (Auth::check() && Auth::user()->roles->role_name == 'admin') {
            $validasi['status'] = 'approved';
        }
        else {
            $validasi['status'] = 'pending';
        }
        $slider->create($validasi);
        return redirect()->route('sliders.index')->withInput()->with('success', 'Berhasil menambah data slider');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        return view('sliders.show',[
            'slider' => $slider
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $slider)
    {
        return view('sliders.edit',[
            'slider' => $slider
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSliderRequest  $request
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slider $slider)
    {
        $validasi = $request->validate([
            'gambar' => 'image|file|max:3000',
            'title' => 'required',
            'deskripsi' => 'required',
            'status' => 'required'
        ]);
        
        if ($request->file('gambar')){
            if ($slider->gambar) {
                Storage::delete($slider->gambar);
            }
            $validasi['gambar'] = $request->file('gambar')->store('sliders');
        };
        if ($validasi['status'] != 'approved' && $validasi['status'] != 'pending') {
            return redirect()->route('sliders.index')->withInput()->with('error', 'Pastikan status approved atau pending');
        }
        $slider->update($validasi);
        return redirect()->route('sliders.index')->withInput()->with('success', 'Berhasil mengubah data slider');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        if ($slider->gambar){
            Storage::delete($slider->gambar);
        };
        $slider->delete();
        return redirect()->route('sliders.index')->with('success', 'Berhasil menghapus data slider');
    }
}
