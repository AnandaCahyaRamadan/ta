@extends('layouts.main')
@section('content')

                    <div class="card mb-4 mt-3">
                            <div class="card-header">
                                <a href="{{ route('products.create') }}" class="btn btn-success">Tambah</a>
                            </div>
                            @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show mt-3 me-1 ms-1" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif
                            @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show mt-3 me-1 ms-1" role="alert">
                                <strong>Error:</strong>  {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            @if (Auth::user()->roles->role_name == 'admin')
                                            <th>Aksi</th>
                                            @endif
                                            <th>Gambar</th>
                                            <th>Nama Produk</th>
                                            @if (Auth::user()->roles->role_name != 'admin')
                                            <th>Deskripsi</th>
                                            @endif
                                            <th>Harga</th>
                                            <th>Kategori</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($products as $key => $product)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            @if (Auth::user()->roles->role_name == 'admin')
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
                                            @endif
                                            <td><img src="{{ asset('storage/' . $product->gambar )}}" class="img-fluid rounded-circle" width="100px"></td>
                                            <td>{{ $product->nama_product }}</td>
                                            @if (Auth::user()->roles->role_name != 'admin')
                                            <td>{{ $product->deskripsi }}</td>
                                            @endif
                                            <td>{{ $product->harga }}</td>
                                            <td>{{ $product->categories->category_name }}</td>
                                            <td>{{ $product->status}}</td>
                                        </tr>
                                        
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
@endsection