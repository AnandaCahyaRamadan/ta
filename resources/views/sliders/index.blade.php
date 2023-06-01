@extends('layouts.main')
@section('content')

                    <div class="card mb-4 mt-3">
                        <div class="card-header">
                            <a href="{{ route('sliders.create') }}" class="btn btn-success">Tambah</a>
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
                                            <th>Title</th>
                                            <th>Gambar</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($sliders as $key => $slider)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            @if (Auth::user()->roles->role_name == 'admin')
                                            <td>
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
                                            </td>
                                            @endif
                                            <td>{{ $slider->title }}</td>
                                            <td><img src="{{ asset('storage/' . $slider->gambar )}}" alt="" width="200em"></td>
                                            <td>
                                                {{ $slider->status }}
                                            </td>
                                        </tr> 
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
@endsection