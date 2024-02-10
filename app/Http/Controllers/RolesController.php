<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Http\Requests\CreateRoleRequest;
use Date;

class rolesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('roles.index')->with('roles',Role::all());

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('roles.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRoleRequest $request)
    {
        Role::create([
            'name'=> $request->name
           
        ]);

       session()->flash('success','Role Created Successfully');

        return redirect(route('roles.index'));  
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        return view('roles.create')->with('role',$role);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreateRoleRequest $request, Role $role)
    {
        $role->update([
            'name'=> $request->name
            
        ]);

        return redirect(route('roles.index')); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        if(count($role->users)==0){
            
            
            session()->flash('success','Role Deleted Successfully');
            $role->delete();
        }
        else{
            session()->flash('success','Role has Employees');
        }
        return redirect(route('roles.index'));
    }
}
