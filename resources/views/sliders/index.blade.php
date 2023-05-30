@extends('layouts.main')
@section('content')

                    <div class="card mb-4 mt-3">
                        <div class="card-header">
                            <a href="{{ route('sliders.create') }}" class="btn btn-success">Tambah</a>
                        </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Aksi</th>
                                            <th>Caption</th>
                                            <th>Deskripsi</th>
                                            <th>Gambar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($sliders as $key => $slider)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>
                                                <a href="{{ route('sliders.edit', $slider) }}" class="btn btn-warning btn-xs">
                                                    Edit
                                                </a>
                                                <form class='d-inline' action="{{ route('sliders.destroy', $slider) }}" method="post">
                                                    @method('delete')
                                                    @csrf
                                                    <button class="btn btn-danger btn-xs" onclick="return confirm('Are you sure?')">Delete</button>
                                                </form>
                                            </td>
                                            <td>{{ $slider->caption }}</td>
                                            <td>{{ $slider->deskripsi }}</td>
                                            <td><img src="{{ asset('storage/' . $slider->gambar )}}" alt="" width="200em"></td>
                                        </tr> 
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
@endsection