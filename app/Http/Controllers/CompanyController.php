<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyCreateRequest;
use App\Http\Requests\CompanyEditRequest;
use App\Models\City;
use App\Models\Collaborator;
use App\Models\CollaboratorContract;
use App\Models\Company;
use App\Models\CompanyType;
use App\Models\DocumentType;
use App\Models\Industry;
use App\Models\Province;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class CompanyController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('company_index'), 403);
        $companies = Company::all();
        return view('back.companies.index', compact('companies'));
    }

    public function create()
    {
        abort_if(Gate::denies('company_create'), 403);

        $company_types = CompanyType::all();
        $document_types = DocumentType::all();
        $provinces = Province::all();
        $industry_types = Industry::all();

        return view('back.companies.create', compact('company_types', 'document_types', 'provinces', 'industry_types'));
    }

    public function store(CompanyCreateRequest $request)
    {
        try {
            // Asignación masiva de los datos a través del método fill()
            $company = new Company();
            $company->fill($request->only([
                'company_type_id', 
                'company_name', 
                'identification_type_id', 
                'identification_number', 
                'province_id', 
                'city_id', 
                'address', 
                'industry_type_id', 
                'size', 
                'founded_at', 
                'description', 
                'contact_name', 
                'contact_first_surname', 
                'contact_second_surname', 
                'website', 
                'email', 
                'phone', 
                'cellphone', 
                'facebook', 
                'instagram', 
                'linkedin', 
                'x_twitter', 
                'youtube'
            ]));

            // Manejo del campo 'is_active'
            $company->is_active = $request->filled('is_active') ? 1 : 0;

            // Guardar la empresa
            $company->save();

            // Subida y actualización del logo, si existe
            if ($request->hasFile('logo')) {
                $this->uploadLogo($company, $request->file('logo'));
            }

            return response()->json([
                'message' => 'Empresa creada exitosamente!',
                'company' => $company,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    protected function uploadLogo(Company $company, $logoFile)
    {
        $cloudinary_object = Cloudinary::upload($logoFile->getRealPath(), [
            'folder' => 'mh/' . env("APP_ENV", "local") . '/' . $company->id . '/logo'
        ]);

        $company->update([
            'logo_public_id' => $cloudinary_object->getPublicId(),
            'logo_url' => $cloudinary_object->getSecurePath(),
        ]);
    }

    public function show(Company $company)
    {
        abort_if(Gate::denies('company_show'), 403);

        $company_type = CompanyType::where('id', $company->company_type_id)->first();
        $industry_type = Industry::where('id', $company->industry_type_id)->first();
        $identification_type = DocumentType::where('id', $company->identification_type_id)->first();
        $province = Province::where('id', $company->province_id)->first();
        $city = City::where('id', $company->city_id)->first();

        return view('back.companies.show', compact('company', 'company_type', 'industry_type', 'identification_type', 'province', 'city'));
    }

    public function edit(Company $company)
    {
        abort_if(Gate::denies('company_edit'), 403);

        $company_types = CompanyType::all();
        $document_types = DocumentType::all();
        $provinces = Province::all();
        $industry_types = Industry::all();

        return view('back.companies.edit', compact('company', 'company_types', 'document_types', 'provinces', 'industry_types'));
    }

    public function update(CompanyEditRequest $request, Company $company)
    {
        // Las validaciones se realizan en CompanyEditRequest

        try {
            $data = array(
                'company_name' => $request->company_name,
                'company_type_id' => $request->company_type_id,
                'identification_type_id' => $request->identification_type_id,
                'identification_number' => $request->identification_number,
                'province_id' => $request->province_id,
                'city_id' => $request->city_id,
                'address' => $request->address,
                'industry_type_id' => $request->industry_type_id,
                'size' => $request->size,
                'founded_at' => $request->founded_at,
                'description' => $request->description,

                'contact_name' => $request->contact_name,
                'contact_first_surname' => $request->contact_first_surname,
                'contact_second_surname' => $request->contact_second_surname,
                'website' => $request->website,
                'email' => $request->email,
                'phone' => $request->phone,
                'cellphone' => $request->cellphone,

                'facebook' => $request->facebook,
                'instagram' => $request->instagram,
                'linkedin' => $request->linkedin,
                'x_twitter' => $request->x_twitter,
                'youtube' => $request->youtube
            );

            // Manejo del campo 'is_active'
            $company->is_active = $request->filled('is_active') ? 1 : 0;

            // dd($data);

            // Guardar la empresa
            $company->update($data);

            // Subida y actualización del logo, si existe
            if ($request->hasFile('logo')) {
                $this->uploadLogo($company, $request->file('logo'));
            }
    
            return response()->json([
                'message' => 'Empresa actualizada exitosamente!',
                'company' => $company,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    // public function destroy(Company $company)
    // {
    //     abort_if(Gate::denies('company_destroy'), 403);

    //     $company->delete();

    //     return back()->with('success', 'Empresa eliminada correctamente.');
    // }

    public function destroy($id)
    {
        abort_if(Gate::denies('collaborator_destroy'), 403);

        $company = Company::find($id);
        
        try {
            if(isset($company['logo_public_id'])) {
                $public_id = $company['logo_public_id'];
                Cloudinary::destroy($public_id);
            }
    
            $company->delete();

            return response()->json([
                'message'=>'Empresa eliminada exitosamente!',
                'company'=>$company
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }


    // COMPANY
    public function companyShow(Company $company)
    {
        // abort_if(Gate::denies('company_show'), 403);
        $provinces = Province::all()->sortBy("name");
        $company_type = CompanyType::where('id', $company->company_type_id)->first();
        $industry_type = Industry::where('id', $company->industry_type_id)->first();
        $identification_type = DocumentType::where('id', $company->identification_type_id)->first();
        $province = Province::where('id', $company->province_id)->first();
        $city = City::where('id', $company->city_id)->first();
        return view('back.company.show', compact('company', 'provinces', 'company_type', 'industry_type', 'identification_type', 'province', 'city'));
    }

    public function getContracts($company_id)
    {
        $results = [];
        $contracts = [];

        $contracts = Collaborator::join('companies as cp', 'cp.id', '=', 'collaborators.company_id')
            ->join('collaborator_contracts as cc', 'cc.collaborator_id', '=', 'collaborators.id')
            ->join('contract_types as ct', 'ct.id', '=', 'cc.contract_type_id')
            ->where('cp.id', $company_id)
            ->select('cc.position_id')
            ->get();

        $results['contracts'] = $contracts;

        return $results;
    }

    public function getGenderData($company_id)
    {
        $results = [];
        $gender_data = [];

        $data = Collaborator::join('companies as cp', 'cp.id', '=', 'collaborators.company_id')
            ->join('sex_types as st', 'st.id', '=', 'collaborators.sex_type_id')
            ->where('cp.id', $company_id)
            ->select('collaborators.sex_type_id', 'st.name', DB::raw('COUNT(*) as count'))
            ->groupBy('collaborators.sex_type_id', 'st.name')
            ->orderBy('count', 'desc')
            ->get();

        $gender_data['labels'] = $data->pluck('name');
        $gender_data['values'] = $data->pluck('count');

        $results['gender_data'] = $gender_data;

        return $results;
    }

    public function getCivilStatusData($company_id)
    {
        $results = [];
        $civil_status_data = [];

        $data = Collaborator::join('companies as cp', 'cp.id', '=', 'collaborators.company_id')
            ->join('civil_status_types as cs', 'cs.id', '=', 'collaborators.civil_status_type_id')
            ->where('cp.id', $company_id)
            ->select('collaborators.civil_status_type_id', 'cs.type', DB::raw('COUNT(*) as count'))
            ->groupBy('collaborators.civil_status_type_id', 'cs.type')
            ->orderBy('count', 'desc')
            ->get();

        $civil_status_data['labels'] = $data->pluck('type');
        $civil_status_data['values'] = $data->pluck('count');

        $results['civil_status_data'] = $civil_status_data;

        return $results;
    }

    public function getAgeRangesData ($company_id)
    {
        $results = [];
        $age_ranges_data = [];

        $data = Collaborator::select(
            DB::raw('
                CASE 
                    WHEN TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) < 25 THEN "Menor de 25" 
                    WHEN TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 26 AND 33 THEN "Entre 26 y 33" 
                    WHEN TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 34 AND 41 THEN "Entre 34 y 41" 
                    WHEN TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 42 AND 49 THEN "Entre 42 y 49" 
                    WHEN TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 50 AND 60 THEN "Entre 50 y 60" 
                    ELSE "Mayor de 60"
                END as age_group'),
            DB::raw('COUNT(*) as count')
        )
        ->groupBy('age_group')
        ->orderBy('count', 'desc')
        ->get();

        $age_ranges_data['labels'] = $data->pluck('age_group');
        $age_ranges_data['values'] = $data->pluck('count');

        $results['age_ranges_data'] = $age_ranges_data;

        return $results;
    }

    public function getAcademicLevelData ($company_id)
    {
        $results = [];
        $academic_level_data = [];

        $data = Collaborator::join('companies as cp', 'cp.id', '=', 'collaborators.company_id')
            ->join(DB::raw('(
                SELECT 
                    caa.collaborator_id,
                    MAX(caa.achievement_type_id) AS level,
                    (
                        SELECT aat.type FROM academic_achievement_types AS aat
                        WHERE aat.id = MAX(caa.achievement_type_id)
                    ) AS type
                FROM collaborator_academic_achievements AS caa
                GROUP BY caa.collaborator_id
            ) as lb'), 'lb.collaborator_id', '=', 'collaborators.id')
            ->where('cp.id', $company_id)
            ->select(DB::raw("CASE
                WHEN lb.type = 'Educación Básica - Primaria' THEN 'Primaria'
                WHEN lb.type = 'Educación Básica - Secundaria' THEN 'Secundaria'
                WHEN lb.type = 'Educación Media - Bachillerato' THEN 'Bachillerato'
                WHEN lb.type = 'Pregrado - Nivel Técnico Profesional' THEN 'Técnico'
                WHEN lb.type = 'Pregrado - Nivel Tecnológico' THEN 'Tecnólogo'
                WHEN lb.type = 'Pregrado - Nivel Profesional' THEN 'Profesional'
                WHEN lb.type = 'Posgrado - Especialización Técnica Profesional' THEN 'Esp. Técnica'
                WHEN lb.type = 'Posgrado - Especialización Tecnológica' THEN 'Esp. Tecnológica'
                WHEN lb.type = 'Posgrado - Especialización Profesional' THEN 'Esp. Profesional'
                WHEN lb.type = 'Posgrado - Magister' THEN 'Magister'
                WHEN lb.type = 'Posgrado - Doctorado' THEN 'Doctorado'
            END as type"), DB::raw('COUNT(*) as count'))
            ->groupBy('type')
            ->orderBy('count', 'desc')
            ->get();

        $academic_level_data['labels'] = $data->pluck('type');
        $academic_level_data['values'] = $data->pluck('count');

        $results['academic_level_data'] = $academic_level_data;

        return $results;
    }

    public function getSocialStrataData ($company_id)
    {
        $results = [];
        $social_strata_data = [];

        $data = DB::table('collaborators')
            ->select('collaborators.stratum_type_id as id', 'social_strata.name as name', DB::raw('COUNT(*) as count'))
            ->join('social_strata', 'social_strata.id', '=', 'collaborators.stratum_type_id')
            ->where('collaborators.company_id', $company_id)
            ->groupBy('collaborators.stratum_type_id', 'social_strata.name')
            ->orderByDesc('count')
            ->get();

        $social_strata_data['labels'] = $data->pluck('name');
        $social_strata_data['values'] = $data->pluck('count');

        $results['social_strata_data'] = $social_strata_data;

        return $results;
    }

    public function getLengthServiceData ($company_id)
    {
        $results = [];
        $length_service_data = [];

        $data = Collaborator::select(
                DB::raw("
                    CASE
                        WHEN TIMESTAMPDIFF(MONTH, collaborator_contracts.contract_start_date, CURDATE()) < 24 THEN 'Menor de 2'
                        WHEN TIMESTAMPDIFF(MONTH, collaborator_contracts.contract_start_date, CURDATE()) BETWEEN 24 AND 60 THEN 'Entre 2 y 5'
                        WHEN TIMESTAMPDIFF(MONTH, collaborator_contracts.contract_start_date, CURDATE()) BETWEEN 72 AND 120 THEN 'Entre 6 y 10'
                        ELSE 'Mayor de 10'
                    END AS time
                "),
                DB::raw('COUNT(collaborator_contracts.id) AS count')
            )
            ->join('collaborator_contracts', 'collaborators.id', '=', 'collaborator_contracts.collaborator_id')
            ->where('collaborators.company_id', $company_id)
            ->groupBy('time')
            ->orderBy('count', 'desc')
            ->get();

        $length_service_data['labels'] = $data->pluck('time');
        $length_service_data['values'] = $data->pluck('count');

        $results['length_service_data'] = $length_service_data;

        return $results;
    }

    public function getNextBirthdays ($company_id)
    {
        $results = [];

        $data = Collaborator::select(
            DB::raw("CONCAT(name, ' ', first_surname, ' ', second_surname) AS name"),
            'document_number AS document',
            'birth_date',
            DB::raw('MONTH(birth_date) AS month'),
            DB::raw('DAY(birth_date) AS day'),
            DB::raw("
                CASE 
                    WHEN WEEK(birth_date_this_year, 1) = WEEK(CURDATE(), 1) THEN 'current'
                    WHEN WEEK(birth_date_this_year, 1) = WEEK(CURDATE() + INTERVAL 1 WEEK, 1) THEN 'next'
                    ELSE 'none'
                END AS week
            ")
        )
        ->fromSub(function ($query) use ($company_id) {
            $query->from('collaborators')
                  ->select(
                      'collaborators.*',
                      DB::raw("STR_TO_DATE(CONCAT(YEAR(CURDATE()), '-', DATE_FORMAT(birth_date, '%m-%d')), '%Y-%m-%d') AS birth_date_this_year")
                  )
                  ->where('company_id', $company_id)
                  ->where(DB::raw("STR_TO_DATE(CONCAT(YEAR(CURDATE()), '-', DATE_FORMAT(birth_date, '%m-%d')), '%Y-%m-%d')"), '>=', DB::raw('CURDATE()'));
        }, 'c')
        ->orderBy(DB::raw('MONTH(birth_date)'))
        ->orderBy(DB::raw('DAY(birth_date)'))
        ->get();

        $results['next_birthdays'] = $data;

        return $results;
    }

    public function getExpiringContracts ($company_id)
    {
        $results = [];

        // $data = Collaborator::select(
        //     DB::raw("CONCAT(collaborators.name, ' ', collaborators.first_surname, ' ', collaborators.second_surname) AS name"),
        //     'collaborators.document_number AS document',
        //     'collaborators.birth_date',
        //     'cc.contract_end_date',
        //     DB::raw('YEAR(cc.contract_end_date) AS year'),
        //     DB::raw('MONTH(cc.contract_end_date) AS month'),
        //     DB::raw('DAY(cc.contract_end_date) AS day'),
        //     DB::raw("
        //         CASE 
        //             WHEN (YEAR(cc.contract_end_date - INTERVAL 1 MONTH) = YEAR(CURDATE()) AND WEEK(cc.contract_end_date - INTERVAL 1 MONTH, 1) = WEEK(CURDATE(), 1)) 
        //               OR (YEAR(cc.contract_end_date - INTERVAL 1 MONTH) = YEAR(CURDATE() + INTERVAL 1 YEAR) AND WEEK(cc.contract_end_date - INTERVAL 1 MONTH, 1) = 1 AND WEEK(CURDATE(), 1) = WEEK(CURDATE())) THEN 'current'
        //             WHEN (YEAR(cc.contract_end_date - INTERVAL 1 MONTH) = YEAR(CURDATE()) AND WEEK(cc.contract_end_date - INTERVAL 1 MONTH, 1) = WEEK(CURDATE() + INTERVAL 1 WEEK, 1)) 
        //               OR (YEAR(cc.contract_end_date - INTERVAL 1 MONTH) = YEAR(CURDATE() + INTERVAL 1 YEAR) AND WEEK(cc.contract_end_date - INTERVAL 1 MONTH, 1) = 1 AND WEEK(CURDATE() + INTERVAL 1 WEEK, 1) = 1) THEN 'next'
        //             ELSE 'none'
        //         END AS week
        //     ")
        // )
        // ->join('collaborator_contracts AS cc', 'collaborators.id', '=', 'cc.collaborator_id')
        // ->where('cc.contract_end_date', '>=', DB::raw('CURDATE()'))
        // ->orderBy(DB::raw('cc.contract_end_date'), 'asc')
        // ->get();

        $data = Collaborator::select(
            DB::raw("CONCAT(collaborators.name, ' ', collaborators.first_surname, ' ', collaborators.second_surname) AS name"),
            'collaborators.document_number AS document',
            'collaborators.birth_date',
            'cc.contract_end_date',
            DB::raw('YEAR(cc.contract_end_date) AS year'),
            DB::raw('MONTH(cc.contract_end_date) AS month'),
            DB::raw('DAY(cc.contract_end_date) AS day'),
            DB::raw("
                CASE 
                    WHEN (cc.contract_end_date - INTERVAL 1 MONTH < CURDATE()) THEN 'previous'
                    WHEN (YEAR(cc.contract_end_date - INTERVAL 1 MONTH) = YEAR(CURDATE()) AND WEEK(cc.contract_end_date - INTERVAL 1 MONTH, 1) = WEEK(CURDATE(), 1)) 
                      OR (YEAR(cc.contract_end_date - INTERVAL 1 MONTH) = YEAR(CURDATE() + INTERVAL 1 YEAR) AND WEEK(cc.contract_end_date - INTERVAL 1 MONTH, 1) = 1 AND WEEK(CURDATE(), 1) = WEEK(CURDATE())) THEN 'current'
                    WHEN (YEAR(cc.contract_end_date - INTERVAL 1 MONTH) = YEAR(CURDATE()) AND WEEK(cc.contract_end_date - INTERVAL 1 MONTH, 1) = WEEK(CURDATE() + INTERVAL 1 WEEK, 1)) 
                      OR (YEAR(cc.contract_end_date - INTERVAL 1 MONTH) = YEAR(CURDATE() + INTERVAL 1 YEAR) AND WEEK(cc.contract_end_date - INTERVAL 1 MONTH, 1) = 1 AND WEEK(CURDATE() + INTERVAL 1 WEEK, 1) = 1) THEN 'next'
                    ELSE 'none'
                END AS week
            ")
        )
        ->join('collaborator_contracts AS cc', 'collaborators.id', '=', 'cc.collaborator_id')
        ->where('cc.contract_end_date', '>=', DB::raw('CURDATE()'))
        ->orderBy(DB::raw('cc.contract_end_date'), 'asc')
        ->get();

        $results['expiring_contracts'] = $data;

        return $results;
    }
}
