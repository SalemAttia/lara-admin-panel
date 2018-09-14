<?php

namespace App\Modules\Users\Controllers;

use App\Modules\Core\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Modules\Users\Models\User;



class UserApiController extends Controller
{

    public function index()
    {
        $users = User::with('team')->get();
        return response()->json(['data' => $users->toArray(),'message' => null,'error' => false], 200);
    }

    public function show($id)
    {
        $user = User::with('team')->find($id);
        if(!$user){
            return response()->json(['data' => null,'message' => 'Not Founded','error' => false], 404);
        }
        return response()->json(['data' => $user->toArray(),'message' => null,'error' => false], 200);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $Validator = Validator::make($data, [
            'name' => 'required|regex:/[a-zA-Z_][0-9a-zA-Z_]*/|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);
        if ($Validator->fails()) {
            return response()->json(['data' => null,'message' => $Validator->errors(),'error' => true], 405);
        }

        $user = User::create($data);

        if(isset($data['teams']) && count($data['teams']) > 0){
            $user->setTeams($data['teams']);
        }
        return response()->json(['data' => $user->toArray(),'message' => 'Created Successfully','error' => false], 200);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $data = $request->all();

        $Validator = Validator::make($data, [
            'name' => 'required|regex:/[a-zA-Z_][0-9a-zA-Z_]*/|max:255',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'required|min:6'
        ]);


        if ($Validator->fails()) {
            return response()->json(['data' => null,'message' => $Validator->errors(),'error' => true], 405);
        }

        $user->update($data);

        return response()->json(['data' => $user->toArray()], 200);
    }

    public function delete(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(['data' => null,'message' => 'Deleted Successfully','error' => false], 200);
    }

    public function storeUserTeam(Request $request,$user_id)
    {
        $user = User::with('team')->findOrFail($user_id);
        $data = $request->all();
        $Validator = Validator::make($data, [
            'teams' => 'required|array'
        ]);
        if ($Validator->fails()) {
            return response()->json(['data' => null,'message' => $Validator->errors(),'error' => true], 405);
        }
        if(count($data['teams']) > 0){
            $user->setTeams($data['teams']);
        }
        $user = User::with('team')->findOrFail($user_id);
        return response()->json(['data' => $user->toArray(),'message' => 'Created Successfully','error' => false], 200);

    }

    public function SetTeamOwner(Request $request,$user_id)
    {
        $user = User::findOrFail($user_id);
        $data = $request->all();

        $Validator = Validator::make($data, [
            'team' => 'required|numeric'
        ]);

        if ($Validator->fails()) {
            return response()->json(['data' => null,'message' => $Validator->errors(),'error' => true], 405);
        }

        $owner = $user->SetUserTeamOwner($data['team']);
        if($owner){
            $user = User::with('team')->findOrFail($user_id);
            return response()->json(['data' => $user->toArray(),'message' => 'Created Successfully','error' => false], 200);
        }else{
            return response()->json(['data' => null,'message' => 'something went wrong','error' => true], 405);
        }

    }
    public function search(Request $request)
    {
        $filed = $request->filed;
        $order = $request->order;
        $searchtext = $request->searchtext;

        if($searchtext){
            $data = User::with('team')->where($filed,$searchtext)->orderBy($filed,$order)->get();
        }else{
            $data = User::with('team')->orderBy($filed,$order)->get();
        }
        return MyResponse(0, $data, MassageEn()[0], 200);

    }
}
