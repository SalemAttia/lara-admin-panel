<?php
/**
 * Created by PhpStorm.
 * Admin: salem
 * Date: 7/31/18
 * Time: 12:13 PM
 */

namespace App\Modules\Users\Controllers;

use App\Modules\Core\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Users\Models\User as Users;
use Carbon\Carbon;

use Excel;
use Illuminate\Support\Facades\Input;
use File;


class ExportDataExcel
{

    /**
     * @var
     */
    public $data;
    /**
     * @var
     */
    public $FailsInsertToDataBase;
    /**
     * @var
     */
    public $SuccessInsertToDataBase;

    /**
     * @param Request $request
     */
    public function export(){

        $data = Users::get();

        $this->data = $this->transform($data);

        $this->ExportExcel();

    }

    /**
     * @param $users
     * @return array
     */
    private function transform($data)
    {

        return array_map(function($data) {
            return [
               'name' => $data['name'],'email' => $data['email']
            ];
        }, $data->toArray());
    }

    /**
     * @return bool
     */
    public function ExportExcel()
    {
        /*excel*/
        $date = Carbon::now();
        Excel::create('data_'.$date, function($excel) {
            $excel->sheet('Success', function($sheet) {
                $sheet->row(1, array('name','email'));
                $cnt = 2;

                foreach ($this->data as $user) {
                    $item = $user;
                    $sheet->appendRow($cnt++, array($item['name'],$item['email']));
                }

            });
        })->download('xlsx');
        /*end sheet of excel*/
        return true;
    }


    /**
     * @param Request $request
     * @return mixed
     */
    public function readExcel(Request $request)
    {
         $nameexlx = "";
         if (request()->file('excel')) {
              request()->file('excel')->move('exports', $nameexlx = str_random(10).'.xls');
         }

        $success_list = [];
        $failed_list = [];
        try{
        if(Input::hasFile('excel')){
           $path = public_path()."/exports/".$nameexlx;
           $data = Excel::load($path, function($reader) {

            })->get();

            $excel_record = array();
            $final_records =array();
            if(!empty($data) && $data->count()){
                foreach ($data as $key => $value) {
                    unset($excel_record);
                    $excel_record['name'] = $value->name;
                    $excel_record['email'] = $value->email;
                    $excel_record['password'] = bcrypt('secret');;


                    $excel_record = (object)$excel_record;

                    $final_records[] = $excel_record;
                }

                if($this->pushToDb($final_records)){

                    $success_list = $final_records;
                }
            }

            $this->FailsInsertToDataBase = $failed_list;
            $this->SuccessInsertToDataBase= $success_list;
            $this->ExportExcelsuccess('Users');

        }
        }
        catch( \Illuminate\Database\QueryException $e)
        {
            return $e->errorInfo;
        }
        // URL_USERS_IMPORT_REPORT
        $data['failed_list']   =   $failed_list;
        $data['success_list']  =    $success_list;
        $data['records']      = FALSE;

    }

    /**
     * @param $records
     * @return bool
     */
    public function pushToDb($records)
    {
        foreach($records as $request) {
            $subject         = new Users();
            $subject->name = $request->name;
			$subject->email = $request->email;
			$subject->password = $request->password;
            $subject->save();
        }
        return TRUE;
    }



    /**
     * @return bool
     */
    public function ExportExcelsuccess($status)
    {
        /*excel*/
        $date = Carbon::now();
        Excel::create($status.$date, function($excel) {
            $excel->sheet('Success', function($sheet) {
                $sheet->row(1, array('name','email'));
                $cnt = 2;

                foreach ($this->SuccessInsertToDataBase as $data) {
                    $item = $data;
                    $sheet->appendRow($cnt++, array('#',$item->name,$item->email));
                }

            });
            $excel->sheet('fails', function($sheet) {
                $sheet->row(1, array('name','email'));
                $cnt = 2;

                foreach ($this->FailsInsertToDataBase as $user) {
                    $item = $user;
                    $sheet->appendRow($cnt++, array('#',$item->name,$item->email));
                }

            });
        })->download('xlsx');
        /*end sheet of excel*/
        return true;
    }

      public function ExportExcelTemplete()
        {
            /*excel*/
            $date = Carbon::now();
            Excel::create('Template'.$date, function($excel) {
                $excel->sheet('Success', function($sheet) {
                    $sheet->row(1, array('name','email'));


                });
            })->download('xlsx');
            /*end sheet of excel*/
            return true;
        }


}