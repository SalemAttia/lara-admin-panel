<?php
namespace App\Modules\Users\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Modules\Core\Controllers\Controller;
use App\Modules\Users\Models\User;





class UpdateUserData extends Controller
{

    public function updateProfile(Request $request){
        $user = User::find($request->id);
        $input = $request->except('password');

        if($request->password){
            $input['password'] = bcrypt($request->password);
        }


        $user->update($input);

        $userdata = User::find($user->id);
        $success=  $this->transform($userdata->toArray());
        $success['token'] =  $user->createToken('App')->accessToken;
        return MyResponse(0, $success, MassageAr()[0], 200);


    }

    private function transform($userdata){

        return [
            'id' => $userdata['id'],
            'name' => $userdata['name'],
            'email' => $userdata['email'],
        ];
    }
}