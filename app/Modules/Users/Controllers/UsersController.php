<?php

namespace App\Modules\Users\Controllers;

use App\Modules\Team\Models\Team;
use App\Modules\Users\Models\TeamUser;
use App\Modules\Users\Models\User;
use Illuminate\Http\Request;
use App\Modules\Core\Controllers\Controller;


class UsersController extends Controller
{

       public function __construct()
       {
               $this->middleware(['AdminAuth', 'Roles']);
       }


        /**
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {

            if(User::$ModelFunctionsNames){
                $data = User::with(User::$ModelFunctionsNames)->get();
            }else{
                $data = User::all();
            }

            $cols = User::$cols;
            $xlx = User::$xlx;

             return view('Users::list', [
                        'data' => $data,
                         'cols' => $cols,
                          'xlx' => $xlx
                    ]);
        }

        public function create()
        {

                $xlx = User::$xlx;
                $teams = Team::all();
                $userTeams = [];
                return view('Users::add_edit', [
                    'action' => 'add',
                    'data' => null,
                    'xlx' => $xlx,
                    'teams' => $teams,
                    'userTeams' => $userTeams
                ]);
        }

        public function store(Request $request)
        {

            $validation = User::createValidation();

            $data = $this->validate($request, $validation);

            $user = User::create($data);
            if(count($request->teams) > 0){
                $user->SetTeams($request->teams);
            }

            return redirect()->route('admin.User.index')->with('success', 'Users (' . array_first($data) . ') is created!');

        }

        public function show(User $User)
        {
            return view('Dashboard::base.show', ['data' => $User->toArray()]);
        }

        public function edit(User $User)
        {
                $teams = Team::all();
                $userTeams = TeamUser::where('user_id',$User->id)->pluck('team_id')->toArray();
                return view('Users::add_edit', [
                    'action' => 'edit',
                    'data' => $User,
                    'teams' => $teams,
                    'userTeams' => $userTeams
                ]);
        }

        public function update(User $User, Request $request)
        {
                $validation = User::updateValidation($User->id);
                $data = $this->validate($request, $validation);
                $User->update($data);
                TeamUser::where('user_id',$User->id)->delete();

                if(count($request->teams) > 0){
                        $User->SetTeams($request->teams);
                }
                return redirect()->route('admin.User.index')->with('success', 'Users (' . array_first($data) . ') is updated!');
            }
        public function destroy(User $User)
        {
                $User->delete();
                return redirect()->route('admin.User.index');
        }

    public function search(Request $request)
    {
        $filed = $request->filed;
        $order = $request->order;
        $searchtext = $request->searchtext;

        if($searchtext){
            $data = User::where($filed,$searchtext)->orderBy($filed,$order)->get();
        }else{
            $data = User::orderBy($filed,$order)->get();
        }
        return MyResponse(0, $data, MassageEn()[0], 200);

    }

}
