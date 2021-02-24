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
     * Display Technology Stack List.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $technology_stacks = TechnologyStack::all();
        return view('pages.technologyStack.technologyStacks')->with('technology_stacks', $technology_stacks);
    }
    /**
     * Display Technology Stack Popup To Add Technology Stack.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function technologyStackModal(Request $request)
    {
        return $this->sendJsonResponse($this->technologyStackService->technologyStackModal($request));
    }

    /**
     * Click Add button to add Technology Stack
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function confirmAddTechnologyStack(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'technology_stack' => 'required|min:3|max:30'
        ]);
        if ($validator->fails()) {
            return $this->error('Validation Failed', ['errors' => $validator->errors()]);
        }
        return $this->sendJsonResponse($this->technologyStackService->confirmAddTechnologyStack($request));
    }
    /**
     * Display Edit Technology Stack Popup To Edit Technology Stack.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editTechnologyStackModal(Request $request)
    {
        return $this->sendJsonResponse($this->technologyStackService->editTechnologyStackModal($request));
    }
    /**
     * Click Edit button to Edit Technology stack information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function confirmEditTechnologyStack(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'technology_stack' => 'required|min:3|max:30',
        ]);
        if ($validator->fails()) {
            return $this->error('Validation Failed', ['errors' => $validator->errors()]);
        }
        return $this->sendJsonResponse($this->technologyStackService->confirmEditTechnologyStack($request));
    }
    /**
     * Display delete popup modal to delete Technology Stack.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteTechnologyStackModal(Request $request)
    {
        return $this->sendJsonResponse($this->technologyStackService->deleteTechnologyStackModal($request));
    }
    /**
     * click delete button to delete Technology Stack.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function confirmDeleteTechnologyStack(Request $request)
    {
        return $this->sendJsonResponse($this->technologyStackService->confirmDeleteTechnologyStack($request));
    }
}
