<?php

namespace App\Modules\Users\Controllers\Auth;

use App\Modules\Core\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use App\Modules\Users\Models\User;
use Validator;
use Response;
use Mail;
use Carbon\Carbon;
use App\Modules\Users\Controllers\Mail\resetpassword;
class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      $this->middleware('guest');
    }

    /**
     * get user token.
     * send mail to user with link to reset password
     *
     * @return void
     */


     /**
     * Send a reset link to the given user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getResetToken(Request $request)
    {
        $this->validate($request, ['email' => 'required|email']);
        if ($request->wantsJson()) {
            $user = User::where('email', $request->input('email'))->first();
            if (!$user) {
                return MyResponse(1,[], "Mail Not Found", 200);
            }
            $token = $this->broker()->createToken($user);
             $this->sendEmailReminder($user,$token);
            return MyResponse(0,[], MassageEn()[0], 200);
//            return response()->json(['token' => $token],200);
        }
    }


  public function sendEmailReminder($user, $token)
  {
    $time=Carbon::now()->addMinute(1);
    $email = $user->email;
    Mail::to($user->email)->later($time,new resetpassword($token,$email));
  }


}
