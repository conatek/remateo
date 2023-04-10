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
            'name' => 'Antonio Contreras',
            'email' => 'conatekpro@gmail.com',
            'password' => bcrypt('29405014'),
        ]);

        $user->assignRole('Master');
    }
}
