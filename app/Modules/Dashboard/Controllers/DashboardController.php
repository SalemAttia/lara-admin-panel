<?php
namespace App\Modules\Dashboard\Controllers;
use App\Modules\Clinic\Models\Clinic;
use App\Modules\Pharmacy\Models\Pharmacy;
use App\Modules\Team\Models\Team;
use App\Modules\Users\Models\Hcpvisit;
use App\Modules\Users\Models\Pharmacyvisits;
use App\Modules\Users\Models\User;
use Illuminate\Http\Request;
use App\Modules\Core\Controllers\Controller;
use Carbon\Carbon;


class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['AdminAuth', 'Roles']);
    }

    public function index()
    {
        $teams = Team::count();
        $users = User::count();

        return view('Dashboard::olddashboard',compact('teams','users'));
    }



}