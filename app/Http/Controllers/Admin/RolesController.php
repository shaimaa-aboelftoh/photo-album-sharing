<?php

namespace App\Http\Controllers\Admin;

use App\Entrust\Permission;
use App\Entrust\Role;
use App\Http\Requests\Dashboard\CreateRoleRequest;
use App\Http\Requests\Dashboard\UpdateRoleRequest;
use App\Http\Controllers\Controller;

class RolesController extends Controller
{
    const VIEW_PATH = 'dashboard.roles.';

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAllRoles()
    {
        $roles = Role::orderByDesc('id')->get();
        return view(self::VIEW_PATH . 'all-roles')->with([
            'pageTitle' => 'Roles',
            'roles' => $roles,
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getCreateRole()
    {
        $permissions = Permission::all();
        return view(self::VIEW_PATH . 'create-role')->with([
            'pageTitle' => 'Create Role',
            'permissions' => $permissions
        ]);
    }

    /**
     * @param CreateRoleRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postCreateRole(CreateRoleRequest $request)
    {
        $request['name'] = str_slug($request['display_name']);
        $role = Role::create($request->all());
        $role->permissions()->sync($request['permission_ids']);
        return json_response(null, 'Role Created successfully !');
    }

    /**
     * @param Role $role
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getShowRole(Role $role)
    {
        $permissions = Permission::all();
        $rolePermissionIds = $role->permissions->pluck('id')->toArray();
        return view(self::VIEW_PATH . 'show-role')->with([
            'pageTitle' => str_limit($role->name, 60),
            'role' => $role,
            'rolePermissionIds' => $rolePermissionIds,
            'permissions' => $permissions,
        ]);
    }

    /**
     * @param Role $role
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getUpdateRole(Role $role)
    {
        if (in_array($role['id'], [1, 2])) {
            abort(403);
        }
        $rolePermissionIds = $role->permissions->pluck('id')->toArray();
        $permissions = Permission::all();
        return view(self::VIEW_PATH . 'update-role')->with([
            'pageTitle' => str_limit($role->name, 60),
            'role' => $role,
            'rolePermissionIds' => $rolePermissionIds,
            'permissions' => $permissions,
        ]);
    }

    /**
     * @param UpdateRoleRequest $request
     * @param Role $role
     * @return \Illuminate\Http\JsonResponse
     */
    public function postUpdateRole(UpdateRoleRequest $request, Role $role)
    {
        $request['name'] = str_slug($request['display_name']);
        $role->update($request->all());
        $role->permissions()->sync($request['permission_ids']);
        return json_response(null, 'Role Updated successfully !');
    }

    /**
     * @param Role $role
     * @return \Illuminate\Http\JsonResponse
     */
    public function postDeleteRole(Role $role)
    {
        if (in_array($role['id'], [1, 2])) {
            abort(403);
        }
        $role->delete();
        return json_response(null, 'Role Deleted successfully !');
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function getRolesAjax()
    {
        $roles = Role::orderByDesc('id')->get();
        $data = view(self::VIEW_PATH . 'ajax.get-all-roles-ajax')->with([
            'roles' => $roles
        ])->render();
        return json_response($data);
    }
}
