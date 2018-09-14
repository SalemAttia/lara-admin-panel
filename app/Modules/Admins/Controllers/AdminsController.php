<?php

namespace App\Modules\Admins\Controllers;

use App\Modules\Brick\Models\Brick;
use App\Modules\Line\Models\Line;
use App\Modules\ModulesHelpers;
use App\Modules\Roles\Models\Role;
use App\Modules\Users\Models\User;
use Illuminate\Http\Request;
use App\Modules\Core\Controllers\Controller;
use App\Modules\Admins\Models\Admin;


/**
 * Class AdminsController
 * @package App\Modules\Admins\Controllers
 */
class AdminsController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        if(getCurrentAdmin()->isRole('super.admin')){
            $data = Admin::all();
        } else {
            $data = Admin::where('role', '!=', 'super.admin')->get();
        }

        return view('Admins::list', [
            'data' => $data
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {

        return view('Admins::add_edit', [
            'action' => 'add',
            'data' => null,
            'roles' => Role::all(),
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'name' => 'required|regex:/[a-zA-Z][0-9a-zA-Z_]*/',
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:6',
            'role' => 'required'
        ]);

        Admin::create($data);

        return redirect()->route('admin.admins.index')->with('success', 'Admin (' . array_first($data) . ') is created!');

    }

    /**
     * @param Admin $admin
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Admin $admin)
    {
        unset($admin->password, $admin->remember_token);

        $admin = [
            'id' => $admin->id,
            'name' => $admin->name,
            'email' => $admin->email,
            'role' => $admin->role

        ];
        return view('Dashboard::base.show', ['data' => $admin]);
    }

    /**
     * @param Admin $admin
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Admin $admin)
    {

//        $data = Role::findOrFail($id);
        return view('Admins::add_edit', [
            'action' => 'edit',
            'data' => $admin,
            'roles' => Role::all()
        ]);
    }

    /**
     * @param Admin $admin
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Admin $admin, Request $request)
    {
        $data = $this->validate($request, [
            'name' => 'required|regex:/[a-zA-Z][0-9a-zA-Z_]*/',
            'email' => 'required|email|unique:admins,email,'. $admin->id,
            'role' => 'required'
        ]);

        if($request->password){
            $data['password']    =   $request->password;
        }

        $admin->update($data);

        return redirect()->route('admin.admins.index')->with('success', 'Admin (' . array_first($data) . ') is updated!');
    }

    /**
     * @param Admin $admin
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Admin $admin)
    {
        if($admin->role != "super.admin"){
            return redirect()->route('admin.admins.index')->with('success','You Can\'t delete this Admin');
        }else{
            $admin->delete();
            return redirect()->route('admin.admins.index');
        }
    }

}
