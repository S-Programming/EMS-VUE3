<?php


namespace App\Http\Services;


use App\Http\Services\BaseService\BaseService;
use App\Models\RequestStatus;
use App\Models\User;
use App\Models\Expense;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ExpenseService extends BaseService
{
    public function confirmClaimExpense(Request $request)
    {

     //  dd($request->all());
        if (!isset($request) && empty($request)) { // what will be condition
            return $this->errorResponse('Claim Submittion Failed');
        }
        if (isset($request) && !empty($request)) {
            $user_id = $this->getAuthUserId();
            $expense = new Expense;
            $expense->user_id = $user_id;
            $expense->reason = $request->reason;
            $expense->description = $request->description;
            $expense->amount = $request->amount;
            $expense->request_status_id = 1; // for pending by default
            $expense->save();
            $expense = Expense::where('user_id', $user_id)->get();
        }
        $html = view('pages.expense._partial._expense_list_table_html', compact('expense', $expense))->render();
        return $this->successResponse('Leave has Successfully Requested', ['html' => $html, 'html_section_id' => 'expense-section']);
    }

    public function approveExpenseModal(Request $request)
    {
        $requestedExpenseId = $request->id;
        $containerId = $request->input('containerId', 'common_popup_modal');
        $request_status = RequestStatus::all();
        $status_dropdown = view('utils.status', ['request_status' => $request_status])->render();
        $html = view('pages.admin.approvals._partial._approve_expense_modal', ['id' => $containerId, 'requestedExpenseId' => $requestedExpenseId, 'data' => null, 'status_dropdown' => $status_dropdown])->render();
        return $this->successResponse('success', ['html' => $html]);
    }

    public function confirmApproveExpense(Request $request)
    {
        if (isset($request) && !empty($request)) {
            $expense_id = $request->id;
            $expense_data = Expense::where('id', $expense_id)->first();
            $expense_data->comments = $request->comments;
            $expense_data->request_status_id = $request->status;
            $expense_data->save();

            $approve_expense = Expense::with('user')->where('request_status_id', '!=', '2')->get();

            $html = view('pages.admin.approvals._partial._approve_expense_list_table_html')->with('approve_expense', $approve_expense)->render();
            if ($expense_data->request_status_id == 2){
                return $this->successResponse('Approve Successfully', ['html' => $html, 'html_section_id' => 'approval-section']);
            }
            else{
                return $this->successResponse('Not Approved',['success' => ['Not Approved'], 'html' => $html, 'html_section_id' => 'approval-section']);
            }

        }
        else
        {
            return $this->errorResponse('Error in Approval',['error'=>['Error in Approval'], 'html' => $html, 'html_section_id' => 'approval-section']);
        }
    }
}
