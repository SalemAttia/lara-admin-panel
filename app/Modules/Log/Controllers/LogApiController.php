<?php

namespace App\Modules\Log\Controllers;

use App\Modules\Core\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Modules\Log\Models\Log;



class LogApiController extends Controller
{


        /**
         *
         * @return \Illuminate\Http\Response
         */
        public function ReturnAll(Request $request)
        {
            $limit = $request->has('limit') ? $request->limit : 10;
            $offset = $request->has('offset') ? $request->offset : 0;
            $items = Log::limit($limit)->offset($offset)->get();
            return response()->json(['Logs' => $items],200);

        }

        /**
         *
         * @return \Illuminate\Http\Response
         */
        public function ReturnById(Request $request)
        {
            $itemId = $request->id;
            $item = Log::where('id',$itemId)->first();
            if(!$item){
             return response()->json(null,203);
            }
            return MyResponse(0, $item, MassageEn()[0], 200);
        }

        /**
         *
         * @return \Illuminate\Http\Response
         */
        public function CreateItem(Request $request)
        {
            $data = $request->all();
            $Log = new Log;
            validate($data, $Log->validation, true);
            $Log->save($data);
            return MyResponse(0, $Log, MassageEn()[0], 200);

        }

        /**
         *
         * @return \Illuminate\Http\Response
         */
        public function UpdateItem(Request $request)
        {
             $itemId = $request->id;
             $data = $request->all();
             $item = Log::where('id',$itemId)->first();
              if(!$item){
                 return MyResponse(7, null, MassageEn()[7], 203);
              }
             $Log = new Log;
             validate($data, $Log->validation, true);
             $Log->save($data);
             return MyResponse(0, $Log, MassageEn()[0], 200);
        }
}
