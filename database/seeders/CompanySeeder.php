<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $main_company = Company::create([
            'name' => 'CONATEK',
        ]);

        $guest_company = Company::create([
            'name' => 'MUY HUMANO',
        ]);
    }
}
