<?php
namespace App\Modules\Users\Models
;


use App\Modules\Team\Models\Team;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

/**
 * Class User
 * @package App\Modules\Users\Models
 */
class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'users';
    public $timestamps = false;

    protected $fillable = [
        'name', 'email','password'
    ];

    static $ModelFunctionsNames = 'team' ;
    static $xlx = true;

    static $cols = [
        'name','email','password'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','pivot'
    ];


    public $casts = [
    ];

    public function team()
    {
        return $this->belongsToMany(Team::class,'team_user');
    }

    static function createValidation(){
        return [
            'name' => 'required|regex:/[a-zA-Z_][0-9a-zA-Z_]*/|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'teams' => 'array'
        ];
    }

    static function updateValidation($id){
        return [
            'name' => 'required|regex:/[a-zA-Z_][0-9a-zA-Z_]*/|max:255',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'required|min:6',
            'teams' => 'array'

        ];
    }

    public function SetTeams($teams)
    {

        foreach ($teams as $team) {
            try {
                TeamUser::firstOrCreate([
                        'user_id' => $this->id,
                        'team_id' => $team
                    ]
                );
            } catch (\Illuminate\Database\QueryException $e) {

                // Error form database
//                    return false;
            }
        }
        return true;
    }

    public function SetUserTeamOwner($team)
    {
        try {
            $teamOwner = TeamUser::firstOrCreate([
                    'user_id' => $this->id,
                    'team_id' => $team,
                ]
            );

            $teamOwner->update([
                'owner' => 1
            ]);
            return true;
        } catch (\Illuminate\Database\QueryException $e) {
            // db QueryException
            return false;
        }
    }





}
