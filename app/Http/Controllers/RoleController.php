<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Services\RoleService;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    protected $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->middleware('auth');
        $this->roleService = $roleService;
    }
    /**
     * Display all roles list.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return view('pages.role.roles')->with(['roles'=> $roles]);
    }
    /**
     * Display a popup to Add New role.
     *
     * @return \Illuminate\Http\Response
     */
    public function addRoleModal(Request $request)
    {
        return $this->sendJsonResponse($this->roleService->addRoleModal($request));
    }

    /**
     * Add New role Confirmly.
     *
     * @return \Illuminate\Http\Response
     */
    public function confirmAddRole(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'role' => 'required|min:3|max:30'
        ]);
        if ($validator->fails()) {
            return $this->error('Validation Failed', ['errors' => $validator->errors()]);
        }
        return $this->sendJsonResponse($this->roleService->confirmAddRole($request));
    }


    /**
     * Display a popup to delete Role.
     *
     * @return \Illuminate\Http\Response
     */
    public function roleDeleteModal(Request $request)
    {
        return $this->sendJsonResponse($this->roleService->roleDeleteModal($request));
    }
    /**
     * Click Yes to confirmly delete the Role.
     *
     * @return \Illuminate\Http\Response
     */
    public function confirmDeleteRole(Request $request)
    {
        return $this->sendJsonResponse($this->roleService->confirmDeleteRole($request));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
