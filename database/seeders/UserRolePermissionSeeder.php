<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserRolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $default_user_value = [
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10)
        ];

        DB::beginTransaction();
        try {
            
            $admin = User::create(array_merge([
                'email' => 'admin@monster.id',
                'name' => 'Monster',
                'handphone' => '08116565911',
            ], $default_user_value));

            $user = User::create(array_merge([
                'email' => 'user@rooms.id',
                'name' => 'User',
                'handphone' => '08116565911',
            ], $default_user_value));

            $role_admin = Role::create(['name' => 'admin']);
            $role_user = Role::create(['name' => 'user']);

            $permission = Permission::create(['name' => 'admin read']);
            $permission = Permission::create(['name' => 'user read']);
        
            $role_admin->givePermissionTo(['admin read']);
            $role_user->givePermissionTo(['user read']);
                
            $admin->assignRole('admin');
            $user->assignRole('user');

            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
        }
    }
}
