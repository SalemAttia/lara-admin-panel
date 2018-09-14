<?php

namespace App\Modules\Log\Models;

use Illuminate\Database\Eloquent\Model;


class Log extends Model
{

   protected $table = 'logs';
   protected $guarded = ['id'];
   protected $hidden = [];
   protected $dates = [];
   //public $timestamps = false;
   protected $fillable = [
       'action','Url','ProwserDetalis','user_id','ip'
       ];

   public function createValidation($id){
        return [
        ];
   }

   public function updateValidation($id){
           return [

           ];
   }

}
