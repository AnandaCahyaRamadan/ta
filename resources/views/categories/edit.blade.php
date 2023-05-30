@extends('layouts.main')
@section('content')
<div class="container mt-3">
    <form action="{{route('categories.update', $category)}}" method="post" enctype="multipart/form-data">
        @method('PUT')
        @csrf
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h2>Edit</h2>
                    <div class="form-group mb-2">
                        <label for="category_name">category</label>
                        <input type="text" class="form-control @error('category_name') is-invalid @enderror" id="category_name"  name="category_name" value="{{ $category->category_name ?? old('category_name') }}">
                        @error('category_name') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                <div class="card-footer mb-2">
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</div>
@stop