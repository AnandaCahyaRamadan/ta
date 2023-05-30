@extends('layouts.main')
@section('content')
<div class="container mt-3">
    <form action="{{route('products.store')}}" method="post" enctype="multipart/form-data">
        @csrf
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h2>Tambah</h2>
                    <div class="form-group mb-2">
                        <label for="nama_product">Nama Produk</label>
                        <input type="text" class="form-control @error('nama_product') is-invalid @enderror" id="nama_product" placeholder="Nama produk" name="nama_product">
                        @error('nama_product') <span class="text-danger">{{$message}}</span> @enderror
                    </div>

                    <div class="form-group mb-2">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea type="text" class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" placeholder="Deskripsi" name="deskripsi"></textarea>
                        @error('deskripsi') <span class="text-danger">{{$message}}</span> @enderror
                    </div>

                    <div class="form-group mb-2">
                        <label for="harga">Harga</label>
                        <input type="number" class="form-control @error('harga') is-invalid @enderror" id="harga" placeholder="Masukkan Harga" name="harga">
                        @error('harga') <span class="text-danger">{{$message}}</span> @enderror
                    </div>

                    <div class="form-group mb-2">
                        <label for="rating">Rating</label>
                        <input type="number" class="form-control @error('rating') is-invalid @enderror" id="rating" placeholder="Masukkan rating" name="rating">
                        @error('rating') <span class="text-danger">{{$message}}</span> @enderror
                    </div>

                    <div class="form-group mb-2">
                        <label for="role">Category</label>
                        <select name="category_id" id="category_id">
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                        @error('category') <span class="text-danger">{{$message}}</span> @enderror
                    </div>

                    <div class="form-group mb-2">
                        <label for="gambar" class="form-label">Pilih Gambar</label>
                        <img class="img-preview img-fluid mb-3 col-sm-5">
                        <input class="form-control @error('gambar') is-invalid @enderror"  type="file" id="gambar" name="gambar"
                        onchange="previewImage()">
                        @error('gambar')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                </div>

                <div class="card-footer mb-2">
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</div>
   
    <script>
        function previewImage(){
            const image = document.querySelector('#gambar');
            const imgPreview = document.querySelector('.img-preview');
            imgPreview.style.display = 'block';
            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);
            oFReader.onload = function(oFREvent){
            imgPreview.src = oFREvent.target.result;
      }
       
    }
    </script>
@stop