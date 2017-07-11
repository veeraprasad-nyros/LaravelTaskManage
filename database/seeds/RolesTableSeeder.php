<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $company = new Role();
        $company->name 			= 'company';
        $company->display_name  = 'Company';
        $company->description   = 'User is allowed to manage and edit members';
        $company->save();

        $member  = new Role();
        $member->name 			= 'member';
        $member->display_name   = 'Member';
        $member->description    = 'User is Member roled';
        $member->save();

        $others = new Role();
        $others->name           = 'others';
        $others->display_name   = 'Other user';
        $others->description    = 'The default user';
        $others->save();
    	echo ('Roles Table seeded successfull');
    }
}
