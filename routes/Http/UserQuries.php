<?php
namespace Route\Http;

use App\Http\Controllers\UserQuriesController;
use \Illuminate\Support\Facades\Route;

class UserQuries
{
    static function register()
    {
        Route::group(['middleware' => ['auth:sanctum']], function () {
//            Route::get('/feedback', [FeedbackController::class, 'index'])->name('feedback.index');
            Route::get('add_userquery', [UserQuriesController::class,'addUserQuery'])->name('userquery.add');
//            Route::get('feedback', [FeedbackController::class,'addFeedback'])->name('feedback');
            Route::post('add_userquery_modal', [UserQuriesController::class,'addUserQueryModal'])->name('userquery.add.modal');
//            Route::post('add_feedback_modal', [FeedbackController::class,'addFeedbackModal'])->name('feedback.add.modal');
            Route::post('confirm_add_userquery', [UserQuriesController::class,'confirmAddUserQuery'])->name('userquery.add.confirm');
//            Route::post('confirm_add_feedback', [FeedbackController::class,'confirmAddFeedbackModal'])->name('feedback.add.confirm');


            //For All users
            Route::get('/comments', [UserQuriesController::class,'viewCommentsUserQuery'])->name('userquery.comments');
//            Route::get('/comments', [FeedbackController::class,'viewCommentsFeedback'])->name('feedback.comments');
            //Admin Feedback Routes
            //Admin Feedback Routes
            //Admin Feedback Routes

            Route::get('/userqueries', [UserQuriesController::class,'viewAdminUserQuery'])->name('userquery.admin.view.userqueries');
//            Route::get('/feedbacks', [FeedbackController::class,'viewAdminFeedback'])->name('feedback.view');

            Route::post('/comment_on_userquery_modal', [UserQuriesController::class,'addCommentModal'])->name('comment.modal');
//            Route::post('/comment_on_feedback_modal', [FeedbackController::class,'addCommentModal'])->name('comment.modal');

            Route::post('/comment_add_confirm', [UserQuriesController::class,'confirmAddComment'])->name('comment.add.confirm');
//            Route::post('/comment_add_confirm', [FeedbackController::class,'confirmAddComment'])->name('comment.add.confirm');

            Route::post('/delete_user_query_modal', [UserQuriesController::class,'deleteUserQueryModal'])->name('userquery.delete.modal');
//            Route::post('/delete_feedback_modal', [FeedbackController::class,'deleteFeedbackModal'])->name('feedback.delete.modal');

            Route::post('/confirm_delete_user_query', [UserQuriesController::class,'confirmDeleteUserQuery'])->name('userquery.confirm.delete');
//            Route::post('/confirm_delete_feedback', [FeedbackController::class,'confirmDeleteFeedback'])->name('feedback.confirm.delete');

        });
    }
}
