<?php

namespace App\Modules\Team\Models;

use Illuminate\Database\Eloquent\Model;


class Team extends Model
{

   protected $table = 'teams';
   protected $guarded = ['id'];
   protected $hidden = ['pivot'];
   protected $dates = [];
   public $timestamps = false;
   static $ModelFunctionsNames = 'users' ;
    static $xlx = false;
   protected $fillable = [
            'title'
       ];
   static $cols = [
        'title'
   ];

   public $casts = [

       ];

   static function createValidation(){
        return [
            'title' => 'required|regex:/[a-zA-Z_][0-9a-zA-Z_]*/|max:255|unique:teams',
			
        ];
   }

   static function updateValidation($id){
           return [
                'title' => 'required|regex:/[a-zA-Z_][0-9a-zA-Z_]*/|max:255|unique:teams,title,'.$id,
			
           ];
   }

    public function users(){
			return $this->BelongsToMany(\App\Modules\Users\Models\User::class);
			}

}
