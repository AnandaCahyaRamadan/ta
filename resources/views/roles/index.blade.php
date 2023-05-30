@extends('layouts.main')
@section('content')

                    <div class="card mb-4 mt-3">
                        <div class="card-header">
                            <a href="{{ route('roles.create') }}" class="btn btn-success">Tambah</a>
                        </div>
                        @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show mt-3 me-1 ms-1" role="alert">
                            <strong>Error:</strong> {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Aksi</th>
                                            <th>Role</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($roles as $key => $role)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>
                                                <a href="{{ route('roles.edit', $role) }}" class="btn btn-warning btn-xs">
                                                    Edit
                                                </a>
                                                <form class='d-inline' action="{{ route('roles.destroy', $role) }}" method="post">
                                                    @method('delete')
                                                    @csrf
                                                    <button class="btn btn-danger btn-xs" onclick="return confirm('Are you sure?')">Delete</button>
                                                </form>
                                            </td>
                                            <td>{{$role->role_name}}</td>
                                        </tr> 
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
@endsection