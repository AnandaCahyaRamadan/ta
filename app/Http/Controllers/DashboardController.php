<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $users_count = User::count();
        $categories = Category::count();
        $products= Product::count();
        $roles = Role::count();
        $users = User::all();
        return view('layouts.index', [
            'users' =>  $users,
            'categories' =>  $categories,
            'users_count' =>  $users_count,
            'roles' =>  $roles,
            'products' =>  $products
        ]);
}
}