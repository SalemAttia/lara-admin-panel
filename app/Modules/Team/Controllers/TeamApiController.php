<?php

namespace App\Modules\Team\Controllers;

use App\Modules\Core\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Modules\Team\Models\Team;



class TeamApiController extends Controller
{

    public function index()
    {
        $teams = Team::with('users')->get();

        return response()->json(['data' => $teams->toArray(), 'message' => null, 'error' => false], 200);
    }

    public function show($id)
    {
        $team = Team::find($id);
        if (!$team) {
            return response()->json(['data' => null, 'message' => 'Not Founded', 'error' => false], 404);
        }

        return response()->json(['data' => $team->toArray(), 'message' => null, 'error' => false], 200);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $Validator = Validator::make($data, [
            'title' => 'required|regex:/[a-zA-Z_][0-9a-zA-Z_]*/|max:255|unique:teams',
        ]);
        if ($Validator->fails()) {
            return response()->json(['data' => null, 'message' => $Validator->errors(), 'error' => true], 405);
        }

        $team = Team::create($data);

        return response()->json(['data' => $team->toArray(), 'message' => 'Created Successfully', 'error' => false], 200);
    }

    public function update(Request $request, $id)
    {
        $team = Team::findOrFail($id);
        $data = $request->all();

        $Validator = Validator::make($data, [
            'title' => 'required|regex:/[a-zA-Z_][0-9a-zA-Z_]*/|max:255|unique:teams,title,'.$id,
        ]);

        if ($Validator->fails()) {
            return response()->json(['data' => null, 'message' => $Validator->errors(), 'error' => true], 405);
        }

        $team->update($data);

        return response()->json(['data' => $team->toArray()], 200);
    }

    public function delete(Request $request, $id)
    {
        $team = Team::findOrFail($id);
        $team->delete();

        return response()->json(['data' => null, 'message' => 'Deleted Successfully', 'error' => false], 200);
    }
    public function search(Request $request)
    {
        $filed = $request->filed;
        $order = $request->order;
        $searchtext = $request->searchtext;

        if($searchtext){
            $data = Team::where($filed,$searchtext)->orderBy($filed,$order)->get();
        }else{
            $data = Team::orderBy($filed,$order)->get();
        }
        return MyResponse(0, $data, MassageEn()[0], 200);

    }
}
