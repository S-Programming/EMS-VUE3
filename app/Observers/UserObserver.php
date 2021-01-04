<?php

namespace App\Observers;

use App\Http\Models\User;
use App\Http\Traits\CustomHash;
use App\Http\Traits\VerificationToken;
use App\Notifications\UserRegistration;

class UserObserver
{
    use VerificationToken;
    use CustomHash;

    /**
     * Handle the user "created" event.
     *
     * @param \App\Http\Models\User $user
     * @return void
     */
    public function created(User $user)
    {
//        $userId = $user->id ?? 0;
//        $signupSourceId = isset($user->signup_source_id) ? intval($user->signup_source_id) : 0;
//        $userEmail = $user->email ?? '';
//        if ($userId && $signupSourceId == 0) {
//            $verification = $this->updateOrCreateVerificationToken(['user_id' => $userId, 'type' => 'reset_password', 'type_value' => $userEmail]);
//            $verificationCode = $verification->code ?? null;
//            if ($verificationCode) {
//                $mainAppUrl = config('app.url', null);
//                $verificationCode = $verification->code . '_' . $user->email;
//                $mainAppUrl = $mainAppUrl . 'reset-password/' . $this->customEncode($verificationCode);
//                $user->notify(new UserRegistration(['url' => $mainAppUrl]));
//            }
//        }
    }

    /**
     * Handle the user "updated" event.
     *
     * @param \App\Http\Models\User $user
     * @return void
     */
    public function updated(User $user)
    {
        //
    }

    /**
     * Handle the user "deleted" event.
     *
     * @param \App\Http\Models\User $user
     * @return void
     */
    public function deleted(User $user)
    {
        //
    }

    /**
     * Handle the user "restored" event.
     *
     * @param \App\Http\Models\User $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the user "force deleted" event.
     *
     * @param \App\Http\Models\User $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}
