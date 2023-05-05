<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'company_id' => 1,
            'name' => 'Antonio Contreras',
            'email' => 'conatekpro@gmail.com',
            'password' => bcrypt('29405014'),
        ]);
        $user->assignRole('Master');

        $user_master_test = User::create([
            'company_id' => 1,
            'name' => 'Test Master',
            'email' => 'master@test.com',
            'password' => bcrypt('29405014'),
        ]);
        $user_master_test->assignRole('Master');

        $user_super_test = User::create([
            'company_id' => 1,
            'name' => 'Test Super',
            'email' => 'super@test.com',
            'password' => bcrypt('29405014'),
        ]);
        $user_super_test->assignRole('Super');

        $user_admin_test = User::create([
            'company_id' => 1,
            'name' => 'Test Admin',
            'email' => 'admin@test.com',
            'password' => bcrypt('29405014'),
        ]);
        $user_admin_test->assignRole('Admin');

        $user_editor_test = User::create([
            'company_id' => 1,
            'name' => 'Test Editor',
            'email' => 'editor@test.com',
            'password' => bcrypt('29405014'),
        ]);
        $user_editor_test->assignRole('Editor');

        $user_analyst_test = User::create([
            'company_id' => 1,
            'name' => 'Test Analyst',
            'email' => 'analyst@test.com',
            'password' => bcrypt('29405014'),
        ]);
        $user_analyst_test->assignRole('Analyst');

        $user_collaborator_test = User::create([
            'company_id' => 1,
            'name' => 'Test Collaborator',
            'email' => 'collaborator@test.com',
            'password' => bcrypt('29405014'),
        ]);
        $user_collaborator_test->assignRole('Collaborator');

        $user_guest_test = User::create([
            'company_id' => 2,
            'name' => 'MH Guest',
            'email' => 'mh_guest@test.com',
            'password' => bcrypt('29405014'),
        ]);
        $user_guest_test->assignRole('Guest');

        $user_admin_guest_test = User::create([
            'company_id' => 2,
            'name' => 'MH Admin',
            'email' => 'mh_admin@test.com',
            'password' => bcrypt('29405014'),
        ]);
        $user_admin_guest_test->assignRole('Admin');
    }
}
