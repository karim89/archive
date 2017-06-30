<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Hash;
use App\Permission;
use App\Role;
use App\User;
use App\Models\PermissionRole;
use App\Models\RoleUser;

class DataSeeder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // permissions
        DB::table('permissions')->delete();
        $permissions = [
            [
                'id' => 1, 
                'name' => 'user-manager',
                'display_name' => 'User Manager',
                'description' => 'Manage permission, Role and User',
            ],
            [
                'id' => 2,
                'name' => 'lookup-manager',
                'display_name' => 'Lookup Manager',
                'description' => '',
            ],
        ];
        Permission::insert($permissions);
        
        // roles
        DB::table('roles')->delete();
        $roles = [
            [
                'id' => 1, 
                'name' => 'admin',
                'display_name' => 'Administrator',
                'description' => 'All Access',
            ],
        ];
        Role::insert($roles);
        
        // users
        DB::table('users')->delete();
        $users = [
            [
                'id' => 1, 
                'name' => 'Admin',
                'username' => 'admin',
                'email' => 'sohib.a.karim@gmail.com',
                'password' => Hash::make('123123'),
            ],
        ];
        User::insert($users);

        // permission_role
        DB::table('permission_role')->delete();
        $permission_role = [
            [
                'permission_id' => 1,
                'role_id' => 1, 
            ],
            [
                'permission_id' => 2,
                'role_id' => 1, 
            ],
        ];
        PermissionRole::insert($permission_role);

        // permission_role
        DB::table('role_user')->delete();
        $role_user = [
            [
                'role_id' => 1,
                'user_id' => 1,
            ], 
        ];
        RoleUser::insert($role_user);
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
