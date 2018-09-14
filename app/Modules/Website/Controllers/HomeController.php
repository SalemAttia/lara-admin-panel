<?php
namespace App\Modules\Website\Controllers;
use App\Modules\Core\Controllers\Controller;

class HomeController extends Controller
{
    public function __construct(){
//        $this->middleware('auth');
    }

    public function index(){

        return view('Website::welcome');
    }

    public function home(){
        return view('Website::home');
    }
}