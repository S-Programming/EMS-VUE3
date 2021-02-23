<?php

namespace App\Http\Controllers;

use App\Models\TechnologyStack;
use Illuminate\Http\Request;
use App\Http\Services\TechnologyStackService;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class TechnologyStackController extends Controller
{
    protected $technologyStackService;

    public function __construct(TechnologyStackService $technologyStackService)
    {
        $this->middleware('auth');
        $this->technologyStackService = $technologyStackService;
    }
    /**
     * Display a listing of Technology Stack.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $technologyStacks = TechnologyStack::all();
        return view('pages.technologyStack.technologyStacks')->with('technologyStacks', $technologyStacks);
    }
    /**
     * It will return a HTML for the of Technology Stack Modal container
     *
     * @return Body
     */
    public function technologyStackModal(Request $request)
    {
        return $this->sendJsonResponse($this->technologyStackService->technologyStackModal($request));
    }

    /**
     * Method for the Adding Users
     *
     * @return Body
     */
    public function confirmAddRole(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'role' => 'required|min:3|max:30'
        ]);
        if ($validator->fails()) {
            return $this->error('Validation Failed', ['errors' => $validator->errors()]);
        }
        return $this->sendJsonResponse($this->technologyStackService->confirmAddRole($request));
    }


    /**
     * It will return a HTML for the Modal container for confirmation of deletion
     *
     * @return Body
     */
    public function roleDeleteModal(Request $request)
    {
        return $this->sendJsonResponse($this->technologyStackService->roleDeleteModal($request));
    }
    /**
     * Method for the Deleting Users
     *
     * @return Body
     */
    public function confirmDeleteRole(Request $request)
    {
        return $this->sendJsonResponse($this->technologyStackService->confirmDeleteRole($request));
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
