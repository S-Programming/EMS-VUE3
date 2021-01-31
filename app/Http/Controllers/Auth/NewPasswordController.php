<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use App\Models\User;
use Validator;

class NewPasswordController extends Controller
{
    /**
     * Display the password reset view.
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        return view('auth.reset-password', ['request' => $request]);
    }

    /**
     * Handle an incoming new password request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|string|confirmed|min:8',
        ]);

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        return $status == Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', __($status))
                    : back()->withInput($request->only('email'))
                            ->withErrors(['email' => __($status)]);
    }

    public function resetPassword(Request $request)
    {
        $request_data = $request->toArray();
        $validator = Validator::make($request_data, [
            "token" => 'required',
            'password' => 'required|confirmed|min:8',
        ]);
        if (!$validator->fails()) {
            $codeData = $this->customDecode($request['token']);
            $codeDataArray = explode('|', $codeData);
            $userCode = $codeDataArray[0] ?? null;
            $userEmail = $codeDataArray[1] ?? null;
            $user = User::where('email', $userEmail)->first();
            if ($user != null) {
                $userId = $user->id ?? '';
                $response = $this->verifyVerificationToken(['user_id' => $userId, 'type' => 'reset_password', 'code' => $userCode]);
                if (isset($response['status']) && trim($response['status']) == 'success') {
                    $user->password = Hash::make($request_data['password']);
                    $user->save();
                    //$this->activityLog("51da6125-6178-48e5-9d8f-87c9febba841", $user->id, $user->id);
                    $this->guard()->login($user);
                    $responseData = ['redirect_to' => '/login'];
                    return $this->successResponse('Password Updated Successfully!', $responseData);
                } else {
                    return $this->errorResponse($response['message'] ?? 'error');
                }
            } else {
                return $this->errorResponse('User Not Found');
            }
        } else {
            return $this->errorResponse($validator->errors()->first());
        }
    }
}
