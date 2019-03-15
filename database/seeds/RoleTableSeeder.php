<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_employee = new Role();
	    $role_employee->name = 'employee';
	    $role_employee->description = 'Employee User';
	    $role_employee->save();

	    $role_admin = new Role();
	    $role_admin->name = 'supervisor';
	    $role_admin->description = 'Supervisor User';
        $role_admin->save();
    }
}
