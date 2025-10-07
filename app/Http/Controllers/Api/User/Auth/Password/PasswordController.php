<?php

namespace App\Http\Controllers\Api\User\Auth\Password;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\sendOTPNotify;
use App\Traits\ApiResponse;
use Ichtrojan\Otp\Otp;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
    use ApiResponse;

    protected $otp2;
    public function __construct()
    {
        $this->otp2 = new Otp();
    }

    // forget password
    public function forgetPassword(Request $request)
    {
        $user = User::where('email', $request->username)->orWhere('mobile', $request->mobile)->first();
        if (!$user) {
            return $this->ApiResponse(null, false,'Invalid User', 404);
        }
        $user->notify(new sendOTPNotify());
        return $this->ApiResponse(null, true,'OTP send Successfully', 200);
    }

    // reset password
    public function resetPassword(Request $request)
    {
        if (!$this->otp2->validate($request->email, $request->otp)) {
            return $this->ApiResponse(null, false,'invalid OTP', 404);
        }

        $user = User::where('email', $request->email)->first();
        $user->password = bcrypt($request->password);
        $user->save();
        return $this->ApiResponse(null, true,'Password Reset Successfully', 200);
    }
}
