<?php

namespace App\Modules\Team\Controllers;

use Illuminate\Http\Request;
use App\Modules\Core\Controllers\Controller;
use App\Modules\Team\Models\Team;



class TeamController extends Controller
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
            if(Team::$ModelFunctionsNames){
                 $data = Team::with(Team::$ModelFunctionsNames)->get();
            }else{
                   $data = Team::all();
             }
            $cols = Team::$cols;
            $xlx = Team::$xlx;

             return view('Team::list', [
                        'data' => $data,
                         'cols' => $cols,
                          'xlx' => $xlx
                    ]);
        }

            public function create()
            {
                $xlx = Team::$xlx;
                return view('Team::add_edit', [
                    'action' => 'add',
                    'data' => null,
                    'xlx' => $xlx
                ]);
            }

            public function store(Request $request)
            {

                $validation = Team::createValidation();

                $data = $this->validate($request, $validation);

                Team::create($data);

                return redirect()->route('admin.Team.index')->with('success', 'Team (' . array_first($data) . ') is created!');

            }

            public function show(Team $Team)
            {

                return view('Dashboard::base.show', ['data' => $Team->toArray()]);
            }

            public function edit(Team $Team)
            {
                return view('Team::add_edit', [
                    'action' => 'edit',
                    'data' => $Team
                ]);
            }

            public function update(Team $Team, Request $request)
            {
                $validation = Team::updateValidation($Team->id);
                $data = $this->validate($request, $validation);
                $Team->update($data);
                return redirect()->route('admin.Team.index')->with('success', 'Team (' . array_first($data) . ') is updated!');
            }

            public function destroy(Team $Team)
            {
                $Team->delete();
                return redirect()->route('admin.Team.index');
            }
}
