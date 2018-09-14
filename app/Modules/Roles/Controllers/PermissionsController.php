<?php

namespace App\Modules\Roles\Controllers;

use App\Modules\Roles\Models\Permission;
use Illuminate\Http\Request;
use App\Modules\Core\Controllers\Controller;


/**
 * Class PermissionsController
 * @package App\Modules\Roles\Controllers
 */
class PermissionsController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('Roles::permissions.list', [
            'data' => Permission::all()
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('Roles::permissions.add_edit', [
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
            'slug' => 'required|alpha_dash|unique:permissions',
        ]);

        Permission::create($data);

        return redirect()->route('admin.permissions.index')->with('success', 'Permission (' . array_first($data) . ') is created!');

    }

    /**
     * @param Permission $permission
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Permission $permission)
    {
//        unset($permission->password, $permission->remember_token);
        return view('Dashboard::base.show', ['data' => $permission->toArray()]);
    }

    /**
     * @param Permission $permission
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Permission $permission)
    {
//        $data = Permission::findOrFail($id);
        return view('Roles::permissions.add_edit', [
            'action' => 'edit',
            'data' => $permission
        ]);
    }

    /**
     * @param Permission $permission
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Permission $permission, Request $request)
    {
        $data = $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'slug' => 'required|alpha_dash|unique:permissions,slug,' . $permission->id,
        ]);

        $permission->update($data);

        return redirect()->route('admin.permissions.index')->with('success', 'Permission (' . array_first($data) . ') is updated!');
    }

    /**
     * @param Permission $permission
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();
        return redirect()->route('admin.permissions.index');
    }

}