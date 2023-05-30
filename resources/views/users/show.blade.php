@extends('layouts.main')
@section('content')
<div class="container mt-3">
    <form method="post" action="{{route('users.show', $user)}}"  enctype="multipart/form-data">
        @method('put')
        @csrf
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h2>Detail</h2>
                    <div class="form-group mb-2">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Nama lengkap" name="name" value="{{$user->name ?? old('name')}}" disabled>
                        @error('name') <span class="text-danger">{{$message}}</span> @enderror
                    </div>

                    <div class="form-group mb-2">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Masukkan Email" name="email" value="{{$user->email ?? old('email')}}" disabled>
                        @error('email') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" placeholder="Telepon" name="phone" value="{{$user->phone ?? old('phone')}}" disabled>
                        @error('phone') <span class="text-danger">{{$message}}</span> @enderror
                    </div>

                    <div class="form-group mb-2">
                        <label for="address">Alamat</label>
                        <input type="address" class="form-control @error('address') is-invalid @enderror" id="address" placeholder="Masukkan alamat" name="address" value="{{$user->address ?? old('address')}}" disabled>
                        @error('address') <span class="text-danger">{{$message}}</span> @enderror
                    </div>

                    <div class="form-group mb-2">
                        <label for="role">Role</label>
                        <select name="role_id" id="role_id" disabled>
                            @foreach ($roles as $role)
                            <option value="{{$role->id }}">{{ $role->role_name }}</option>
                            @endforeach
                        </select>
                        @error('role') <span class="text-danger">{{$message}}</span> @enderror
                    </div>

                    <div class="form-group mb-2">
                        <label for="password">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password" name="password" value="{{$user->password ?? old('password')}}" disabled>
                        @error('password') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label for="password">Konfirmasi Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Konfirmasi Password" name="password_confirmation" value="{{$user->password ?? old('password')}}" disabled>
                    </div>

                </div>

                <div class="card-footer mb-2">
                    <a href="{{route('users.show', $user)}}" class="btn btn-success btn-xs">
                        Detail
                    </a>
                    <a href="{{route('users.edit', $user)}}" class="btn btn-warning btn-xs">
                        Edit
                    </a>
                    <form class='d-inline' action="{{route('users.destroy', $user)}}" method="post">
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