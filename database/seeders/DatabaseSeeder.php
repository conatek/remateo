<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            CompanySeeder::class,
            PermissionSeeder::class,
            RoleSeeder::class,
            RoleHasPermissionSeeder::class,
            UserSeeder::class,
            ProvinceSeeder::class,
            CitySeeder::class,
            DocumentTypeSeeder::class,
            SocialStratumSeeder::class,
            SexTypeSeeder::class,
            RhTypeSeeder::class,
            ScholarshipSeeder::class,
            AcademicAchievementTypeSeeder::class,
            CivilStatusSeeder::class,
            HousingTenureSeeder::class,
            RelationshipSeeder::class,
            OccupationSeeder::class,
            BankTypeSeeder::class,
            EpsTypeSeeder::class,
            AfpTypeSeeder::class,
            ArlTypeSeeder::class,
            CcfTypeSeeder::class,
            PositionCriticalityLevelSeeder::class,
            PositionRiskClassSeeder::class,
            ContractTypeSeeder::class,
            MedicalExaminationTypeSeeder::class,
            HomeVisitTypeSeeder::class,
            ContractualDocumentTypeSeeder::class,
            CollaboratorSeeder::class,
        ]);
    }
}
