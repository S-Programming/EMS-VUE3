<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserVerify;
use Illuminate\Support\Facades\Password;
use Validator;
use App\Notifications\UserPasswordReset;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status == Password::RESET_LINK_SENT
                    ? back()->with('status', __($status))
                    : back()->withInput($request->only('email'))
                            ->withErrors(['email' => __($status)]);
    }

    public function resetPasswordEmail(Request $request)
    {
        $request_data = $request->toArray();
        $validator = Validator::make($request_data, [
            "email" => 'required', 'email',
        ]);
        if ($validator->fails()) {
            return $this->error($validator->errors()->first());
        } else {
            $email = $request['email'] ?? '';
            $user = User::where('email', '=', $email)->first();
            if ($user) {
                $userId = !is_null($user->id) ? $user->id : '';
                if ($userId != '') {
                    $verification = $this->updateOrCreateVerificationToken(['user_id' => $userId, 'type' => 'reset_password', 'type_value' => $email]);
                    $verificationCode = $verification->code ?? null;
                    if ($verificationCode) {
                        $mainAppUrl = config('app.url', null);
                        $verificationCode = $verification->code . '|' . $user->email;
                        $mainAppUrl = $mainAppUrl.'/' . 'reset-password/' . $this->customEncode($verificationCode);
                        $user->notify(new UserPasswordReset(['url' => $mainAppUrl]));
                        $response = $this->successResponse('Password Reset Email Sent');
                    } else {
                        $response = $this->errorResponse('Password Reset Email Could Not Be Sent');
                    }
                } else {
                    $response = $this->errorResponse('Password Reset Email Could Not Be Sent');
                }
            } else {
                $response = $this->errorResponse('Email Not Found');
            }
        }
        return $response;
    }



}
