<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\ExpenseService;
use App\Models\Expense;


class ExpenseController extends Controller
{
    //
    protected $expenseService;

    public function __construct(ExpenseService $expenseService)
    {
        $this->middleware('auth');
        $this->expenseService = $expenseService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = $this->getAuthUserId();
        $expense = Expense::where('user_id', $user_id)->get();
        return view('pages.expense.expense_list',['expense'=>$expense]);
    }
    /**
     * It will return a HTML for the Modal container
     *
     * @return Body
     */
    public function claimExpenseModal(Request $request)
    {
        $containerId = $request->input('containerId', 'common_popup_modal');
        $html = view('pages.expense._partial._claim_expense_modal', ['id' => $containerId, 'data' => null])->render();
        return $this->success('success', ['html' => $html]);
    }
    /**
     * Method for the Claim Expense
     *
     * @return Body
     */
    public function confirmClaimExpense(Request $request)
    {
        return $this->sendJsonResponse($this->expenseService->confirmClaimExpense($request));
    }
    /**
     * Display a listing of the resource of approval of expense.
     *
     * @return \Illuminate\Http\Response
     */
    public function approveExpense(Request $request)
    {
    	$approve_expense = Expense::with('user')->where('request_status_id', '!=', '2')->get();
        return view('pages.approve.approval_list')->with('approve_expense', $approve_expense);
    }
    /**
     * It will return a HTML for the Modal container for expense approval
     *
     * @return Body
     */
    public function approveExpenseModal(Request $request)
    {
    	return $this->sendJsonResponse($this->expenseService->approveExpenseModal($request));
    }
    /**
     * Method for the confirm approval of Expense
     *
     * @return Body
     */
	public function confirmApproveExpense(Request $request)
	{
        return $this->sendJsonResponse($this->expenseService->confirmApproveExpense($request));
	}
}
