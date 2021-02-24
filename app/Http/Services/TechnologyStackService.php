<?php


namespace App\Http\Services;


use App\Http\Services\BaseService\BaseService;
use App\Models\User;
use App\Models\TechnologyStack;
use App\Models\RoleUser;
use Illuminate\Http\Request;

class TechnologyStackService extends BaseService
{
    /**
     * Display Technology Stack Popup To Add Technology Stack.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function technologyStackModal(Request $request)
    {
        $containerId = $request->input('containerId', 'common_popup_modal');
        $html = view('pages.technologyStack._partial._add_technology_stack_modal', ['id' => $containerId, 'data' => null])->render();

        return $this->successResponse('success', ['html' => $html]);
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
        if (!isset($request) && empty($request)) { // what will be condition
            return $this->errorResponse('Technology Stack Submittion Failed');
        }
        if (isset($request) && !empty($request)) {

            $technology_stack = new TechnologyStack;
            $technology_stack->name = $request->technology_stack;
            $technology_stack->save();
            $technology_stacks = TechnologyStack::all();
        }
        $html = view('pages.technologyStack._partial._technology_stacks_list_table_html', compact('technology_stacks', $technology_stacks))->render();
        return $this->successResponse('Technology Stack has Successfully Added', ['html' => $html, 'html_section_id' => 'technology-stack-list-section']);
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
        $technology_stack_id = $request->id;
        $technology_stack_data = TechnologyStack::find($technology_stack_id);
        $containerId = $request->input('containerId', 'common_popup_modal');
        $html = view('pages.technologyStack._partial._edit_technology_stack_modal', ['id' => $containerId, 'data' => null, 'technology_stack_data' => $technology_stack_data])->render();

        return $this->successResponse('success', ['html' => $html]);
    }

    /**
     * Click Edit button to Edit Technology Stack information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function confirmEditTechnologyStack(Request $request)
    {
        $technology_stack = TechnologyStack::find($request->id);
        $technology_stack->name = $request->technology_stack;
        $technology_stack->save();
        $technology_stacks = TechnologyStack::all();
        $html = view('pages.technologyStack._partial._technology_stacks_list_table_html', compact('technology_stacks', $technology_stacks))->render();
        return $this->successResponse('Technology Stack has Successfully Updated', ['html' => $html, 'html_section_id' => 'technology-stack-list-section']);
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
        $technology_stack_id = $request->id;
        $containerId = $request->input('containerId', 'common_popup_modal');
        $html = view('pages.technologyStack._partial._delete_technology_stack_modal', ['id' => $containerId, 'technology_stack_id' => $technology_stack_id])->render();
        return $this->successResponse('success', ['html' => $html]);
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
        $technology_stack_id = $request->technology_stack_id;
        $technology_stack = TechnologyStack::find($technology_stack_id);
        $technology_stack->delete();
        $technology_stacks = TechnologyStack::all();
        $html = view('pages.technologyStack._partial._technology_stacks_list_table_html', compact('technology_stacks', $technology_stacks))->render();
        return $this->successResponse('Technology Stack has Successfully Deleted', ['html' => $html, 'html_section_id' => 'technology-stack-list-section']);
    }
}
