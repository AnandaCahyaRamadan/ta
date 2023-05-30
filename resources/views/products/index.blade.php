@extends('layouts.main')
@section('content')

                    <div class="card mb-4 mt-3">
                            <div class="card-header">
                                <a href="{{ route('products.create') }}" class="btn btn-success">Tambah</a>
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Aksi</th>
                                            <th>Gambar</th>
                                            <th>Nama Produk</th>
                                            <th>Harga</th>
                                            <th>Kategori</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($products as $key => $product)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>
                                                <a href="{{ route ('products.show', $product) }}" class="btn btn-success btn-xs">
                                                    Detail
                                                </a>
                                                <a href="{{ route('products.edit', $product) }}" class="btn btn-warning btn-xs">
                                                    Edit
                                                </a>
                                                <form class='d-inline' action="{{ route('products.destroy', $product) }}" method="post">
                                                    @method('delete')
                                                    @csrf
                                                    <button class="btn btn-danger btn-xs" onclick="return confirm('Are you sure?')">Delete</button>
                                                </form>
                                            </td>
                                            <td><img src="{{ asset('storage/' . $product->gambar )}}" class="img-fluid rounded-circle" width="100px"></td>
                                            <td>{{ $product->nama_product }}</td>
                                            <td>{{ $product->harga }}</td>
                                            <td>{{ $product->categories->category_name }}</td>
                                        </tr>
                                        
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
@endsection