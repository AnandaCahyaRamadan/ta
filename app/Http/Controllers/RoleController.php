<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return view('roles.index', [
            'roles' => $roles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validasi = $request->validate([
            'role_name' => 'required'
        ]);
        Role::create($validasi);
        return redirect()->route('roles.index')->withInput()->with('success','Berhasil menambah data roles');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        return view('roles.edit', [
            'role' => $role
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $validasi = $request->validate([
            'role_name' => 'required'
        ]);
        $role->update($validasi);
        return redirect()->route('roles.index')->withInput()->with('success','Berhasil mengubah data roles');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    { 
        try {
            
            if ($role) $role->delete();
            return redirect()->route('roles.index')->with('success','Berhasil menghapus data roles');
            
        } catch (QueryException $e) {
            if ($e->errorInfo[1] === 1451) {
                $errorMessage = "Tidak dapat menghapus data karena terdapat ketergantungan data yang terkait.";
                return redirect()->back()->with('error', $errorMessage);
            }
        }
    }
}
