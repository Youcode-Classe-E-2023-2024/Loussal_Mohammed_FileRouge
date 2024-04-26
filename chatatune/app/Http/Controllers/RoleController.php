<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use App\Models\RoleHasPermission;
use App\Models\UserHasRole;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    static function assignRole($user, $role)
    {
        $roleId = Role::where('name', $role)->pluck('id');
        UserHasRole::create([
            'user_id' => $user,
            'role_id' => $roleId[0]
        ]);
    }


    static function givePermissionsToRole($role, $permission)
    {
        $role_id = Role::where('name', $role)->first()->value('id');

        $permission_id = Permission::where('name', $permission)->value('id');
        if ($permission_id) { // Check if permission exists
            RoleHasPermission::create([
                'role_id' => $role_id,
                'permission_id' => $permission_id
            ]);

        }

        return response()->json(['status' => 'done'], 200);
    }


    static function userCan($user_id, $permission)
    {
        $userRole = UserHasRole::where('user_id', $user_id)->first();

        if (!$userRole) {
            return response()->json([
                'error' => 'User role not found'
            ], 404);
        }

        $rolePermissions = RoleHasPermission::where('role_id', $userRole->role_id)->pluck('permission_id');

        if ($rolePermissions->isEmpty()) {
            return response()->json([
                'error' => 'Role permissions not found'
            ], 404);
        }

        $permissionModel = Permission::where('name', $permission)->first();

        if (!$permissionModel) {
            return response()->json([
                'error' => 'Permission not found'
            ], 404);
        }

        // Extract the integer value from the collection
        $permissionId = $permissionModel->id;

        // Check if the permission ID is contained within the role's permissions
        if (!$rolePermissions->contains($permissionId)) {
            return response()->json([
                'error' => 'Unauthorized'
            ], 403);
        }

        return response()->json([
            'message' => 'Permission granted'
        ], 200);
    }



    static function userHasRole($user_id, $role)
    {
        $userRole = UserHasRole::where('user_id', $user_id)->get()->first();

        if (!$userRole) {
            return response()->json([
                'error' => 'User role not found'
            ], 404);
        }

        $role_id = Role::where('name', $role)->value('id');

        if (!$role_id) {
            return response()->json([
                'error' => 'Role not found'
            ], 404);
        }

        if ($userRole->role_id !== $role_id || !$userRole) {
            return false;
        }

        return true;
    }

    function storePermission(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3'
        ]);

        Permission::create([
            'name' => $request->permission
        ]);
        return response()->json([
            'status' => 'success'
        ]);
    }

    function storeRole(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3'
        ]);

        Role::create([
            'name' => $request->permission
        ]);
        return response()->json([
            'status' => 'success'
        ],200);
    }

}
