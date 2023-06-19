@extends('layouts.main')
@section('content')
<div class="container mt-3">
    <form action="{{route('sliders.store')}}" method="post" enctype="multipart/form-data">
        @csrf
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h2>Tambah</h2>
                    <div class="form-group mb-2">
                        <label for="title">Title</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Title" name="title">
                        @error('title') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea type="text" class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" placeholder="Deskripsi" name="deskripsi"></textarea>
                        @error('deskripsi') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label for="gambar" class="form-label">Pilih Slider</label>
                        <img class="img-preview img-fluid mb-3 col-sm-5">
                        <input class="form-control @error('gambar') is-invalid @enderror"  type="file" id="gambar" name="gambar"
                        onchange="previewImage()">
                        @error('gambar')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                        @enderror
                    </div>
                    
                    <div class="card-footer mb-2">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <a href="{{ route('sliders.index') }}" class="btn">Batal</a>
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