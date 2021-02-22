<?php
namespace Route\Http;

use App\Http\Controllers\FeedbackController;
use \Illuminate\Support\Facades\Route;

class Feedback
{
    static function register()
    {
        Route::group(['middleware' => ['auth:sanctum']], function () {
//            Route::get('/feedback', [FeedbackController::class, 'index'])->name('feedback.index');
            Route::get('feedback', [FeedbackController::class,'addFeedback'])->name('feedback');
            Route::post('add_feedback_modal', [FeedbackController::class,'addFeedbackModal'])->name('feedback.add.modal');
            Route::post('confirm_add_feedback', [FeedbackController::class,'confirmAddFeedbackModal'])->name('feedback.add.confirm');

            //For All users
            Route::get('/comments', [FeedbackController::class,'viewCommentsFeedback'])->name('feedback.comments');
            //Admin Feedback Routes
            //Admin Feedback Routes
            //Admin Feedback Routes

            Route::get('/feedbacks', [FeedbackController::class,'viewAdminFeedback'])->name('feedback.view');
            Route::post('/comment_on_feedback_modal', [FeedbackController::class,'addCommentModal'])->name('comment.modal');
            Route::post('/comment_add_confirm', [FeedbackController::class,'confirmAddComment'])->name('comment.add.confirm');
            Route::post('/delete_feedback_modal', [FeedbackController::class,'deleteFeedbackModal'])->name('feedback.delete.modal');
            Route::post('/confirm_delete_feedback', [FeedbackController::class,'confirmDeleteFeedback'])->name('feedback.confirm.delete');
            /* Route::get('/dashboard1', function(){
                 dd(2);
             })->name('dashboard1');*/
            /*Route::post('/checkin_modal', [DashboardController::class, 'checkinModal'])->name('checkin.modal');
            Route::post('/confirm_checkin', [DashboardController::class, 'confirmCheckin'])->name('confirm.checkin');*/
        });
    }
}
