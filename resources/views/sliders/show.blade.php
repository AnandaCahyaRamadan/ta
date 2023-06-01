@extends('layouts.main')
@section('content')
<div class="container mt-3">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h2>Detail</h2>
                    <div class="form-group mb-2">
                        <label for="title">Title</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="title" name="title" value="{{ $slider->title }}" disabled>
                        @error('title') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea type="text" class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" placeholder="Deskripsi" name="deskripsi" disabled>{{ $slider->deskripsi }}</textarea>
                        @error('deskripsi') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label for="status">Status</label>
                        <input type="text" class="form-control @error('status') is-invalid @enderror" id="status" placeholder="status" name="status" value="{{ $slider->status }}" disabled>
                        @error('status') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group mb-2">
                    <img src="{{ asset('storage/' . $slider->gambar) }}" class=" img-fluid mb-3 col-sm-5 d-block">
                    <div class="card-footer mb-2">
                        <a href="{{ route('sliders.show', $slider) }}" class="btn btn-success btn-xs">
                            Detail
                        </a>
                        <a href="{{ route('sliders.edit', $slider) }}" class="btn btn-warning btn-xs">
                            Edit
                        </a>
                        <form class='d-inline' action="{{ route('sliders.destroy', $slider) }}" method="post">
                            @method('delete')
                            @csrf
                            <button class="btn btn-danger btn-xs" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop