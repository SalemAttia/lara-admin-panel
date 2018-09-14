<?php

namespace App\Modules\Log\Controllers;

use Illuminate\Http\Request;
use App\Modules\Core\Controllers\Controller;
use App\Modules\Log\Models\Log;



class LogController extends Controller
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
            $data = Log::all();

             return view('Log::list', [
                        'data' => $data
                    ]);
        }


        public function createLog($action , $model ,$adminId ,$itemId)
          {
             $data = [
               'action' => $action,
               'model' => $model,
               'user_id' => $adminId,
               'item_id' => $itemId,
              ];
              Log::create($data);
            }

            public function show(Log $Log)
            {

                return view('Log::show', ['data' => $Log->toArray()]);
            }

}
