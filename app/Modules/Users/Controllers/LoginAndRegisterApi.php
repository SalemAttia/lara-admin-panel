<?php

namespace App\Modules\Users\Controllers;

use App\Modules\Brick\Models\Brick;
use App\Modules\Line\Models\Line;
use Illuminate\Http\Request;
use App\Modules\Core\Controllers\Controller;
use App\Modules\Users\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Validator;

/**
 * Class loginandregisterapi
 * @package App\Modules\Users\Controllers
 */
class LoginAndRegisterApi extends Controller
{

    /**
     * @var int
     */
    public $successStatus = 200;


    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(){
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::user();
            $userdata = User::find($user->id);
            $success=  $this->transform($userdata->toArray());
            $success['token'] =  $user->createToken('App')->accessToken;
            return MyResponse(0, $success, MassageAr()[0], 200);
        }
        else{
            $useremail = User::where('email',request('email'))->first();
            if($useremail){
                return MyResponse(2, [], "Wrong Password", 200);
            }else{
                return MyResponse(1, [], "Email Not Found !", 200);
            }
        }
    }



    public function transform($userdata){

            return [
                'id' => $userdata['id'],
                'name' => $userdata['name'],
                'email' => $userdata['email']
            ];
    }


}