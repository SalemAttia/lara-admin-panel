<?php

namespace App\Modules\Roles\Controllers;

use App\Modules\Roles\Models\Role;
use Illuminate\Http\Request;
use App\Modules\Core\Controllers\Controller;


/**
 * Class RolesController
 * @package App\Modules\Roles\Controllers
 */
class RolesController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('Roles::roles.list', [
            'data' => Role::all()
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('Roles::roles.add_edit', [
            'action' => 'add',
            'data' => null
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'slug' => 'required|unique:roles|alpha_dash',
            'actions' => 'required|array',
            'permissions' => 'array'
        ]);

        Role::create($data);

        return redirect()->route('admin.roles.index')->with('success', 'Role (' . array_first($data) . ') is created!');

    }

    /**
     * @param Role $role
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Role $role)
    {
//        unset($role->password, $role->remember_token);
        return view('Dashboard::base.show', ['data' => $role->toArray()]);
    }

    /**
     * @param Role $role
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Role $role)
    {
//        $data = Role::findOrFail($id);
        return view('Roles::roles.add_edit', [
            'action' => 'edit',
            'data' => $role
        ]);
    }

    /**
     * @param Role $role
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Role $role, Request $request)
    {
        $data = $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'slug' => 'required|alpha_dash|unique:roles,slug,' . $role->id,
            'actions' => 'required',
            'permissions' => 'array'
        ]);
        if(!isset($data['permissions'])){
            $data['permissions'] = [];
        }

        $role->update($data);

        return redirect()->route('admin.roles.index')->with('success', 'Role (' . array_first($data) . ') is updated!');
    }

    /**
     * @param Role $role
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('admin.roles.index');
    }

}