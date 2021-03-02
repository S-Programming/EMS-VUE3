<?php

namespace Route\Http;

use App\Http\Controllers\ExpenseController;
use \Illuminate\Support\Facades\Route;

class Expense
{
    static function register()
    {
    	Route::group(['middleware' => ['auth:sanctum']], function () {

    		Route::get('/expense', [ExpenseController::class, 'index'])->name('expense.list');
            Route::post('/claim/expense/modal', [ExpenseController::class, 'claimExpenseModal'])->name('expense.claim.modal');
            Route::post('/confirm/claim/expense', [ExpenseController::class, 'confirmClaimExpense'])->name('expense.confirm.claim');






    		/* Approval Routes */
    		Route::get('/approve/expense/list', [ExpenseController::class, 'approveExpense'])->name('approve.expense.list');
            Route::post('/approve/expense/modal', [ExpenseController::class, 'approveExpenseModal'])->name('expense.approve.modal');
            Route::post('/confirm/approve/expense', [ExpenseController::class, 'confirmApproveExpense'])->name('expense.confirm.approve');
    	});
    }
}
