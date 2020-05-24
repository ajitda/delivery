<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create(['name' => 'sadmin']);
        $role = Role::create(['name' => 'admin']);
        $role = Role::create(['name' => 'company']); // Company handle both order and user
        $role = Role::create(['name' => 'user']); //employee of company
        $role = Role::create(['name' => 'merchant']); // Merchange can create order

        $role_users = ['sadmin', 'admin', 'company', 'merchant', 'user'];
        foreach ($role_users as $ruser) {
            $ruser_name = $ruser;
            if (in_array($ruser, ['company', 'merchant', 'user'])) {
                $ruser_name = 'test_'.$ruser;
            }
            $user = new User();
            $user->name = $ruser_name;
            $user->email = $ruser_name.'@gmail.com';
            $user->password = bcrypt('password');
            $user->email_verified_at = now();
            $user->remember_token = Str::random(10);
            $user->save();
            $user->assignRole($ruser);
        }
    }
}
