<?php

namespace App\Http\Controllers;

use App\Http\Requests\CollaboratorContractCreateRequest;
use App\Http\Requests\CollaboratorContractEditRequest;
use App\Http\Requests\CollaboratorCreateRequest;
use App\Http\Requests\CollaboratorEditRequest;
use App\Models\AcademicAchievementType;
use App\Models\AfpType;
use App\Models\ArlType;
use App\Models\BankType;
use App\Models\CcfType;
use App\Models\City;
use App\Models\CivilStatusType;
use App\Models\Collaborator;
use App\Models\CollaboratorContract;
use App\Models\Company;
use App\Models\ContractType;
use App\Models\ContractualDocumentType;
use App\Models\DocumentType;
use App\Models\EpsType;
use App\Models\HomeVisitType;
use App\Models\HousingTenure;
use App\Models\MedicalExaminationType;
use App\Models\Occupation;
use App\Models\Position;
use App\Models\Province;
use App\Models\Relationship;
use App\Models\RhType;
use App\Models\Scholarship;
use App\Models\SexType;
use App\Models\SocialStratum;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CollaboratorController extends Controller
{
    public function getCollaborators() {
        $results = [];
        
        $user_company_id = auth()->user()->company_id;
        $collaborators = Collaborator::where('company_id', $user_company_id)->get();
        $collaborators_data = [];

        foreach ($collaborators as $collaborator) {
            $data = [];

            $data['id'] = $collaborator->id;
            $data['name'] = $collaborator->name;
            $data['first_surname'] = $collaborator->first_surname;
            $data['second_surname'] = $collaborator->second_surname;

            array_push($collaborators_data, $data);
        }
        
        $results['collaborators'] = $collaborators_data;

        return $results;
    }

    public function getContractualInformation($id) {
        $results = [];

        $contractual_information = CollaboratorContract::where('collaborator_id', $id)->first();

        if($contractual_information != null) {
            $position = Position::where('id', $contractual_information->position_id)->first();
            $contract_type = ContractType::where('id', $contractual_information->contract_type_id)->first();
            $bank = BankType::where('id', $contractual_information->bank_id)->first();
            $eps = EpsType::where('id', $contractual_information->eps_id)->first();
            $afp_pension = AfpType::where('id', $contractual_information->afp_pension_id)->first();
            $afp_saving = AfpType::where('id', $contractual_information->afp_saving_id)->first();
            $arl = ArlType::where('id', $contractual_information->arl_id)->first();
            $ccf = CcfType::where('id', $contractual_information->ccf_id)->first();

            $contractual_information['position'] = $position;
            $contractual_information['contract_type'] = $contract_type;
            $contractual_information['bank'] = $bank;
            $contractual_information['eps'] = $eps;
            $contractual_information['afp_pension'] = $afp_pension;
            $contractual_information['afp_saving'] = $afp_saving;
            $contractual_information['arl'] = $arl;
            $contractual_information['ccf'] = $ccf;
        }
        
        $results['contractual_information'] = $contractual_information;

        return $results;
    }

    public function index()
    {
        abort_if(Gate::denies('collaborator_index'), 403);

        $user = auth()->user();
        $company = Company::where('id', $user->company_id)->first();

        // $user_company_id = auth()->user()->company_id;
        $collaborators = Collaborator::where('company_id', $company->id)->orderBy('created_at', 'desc')->get();
        return view('back.collaborators.index', compact('company', 'collaborators'));
    }

    public function create()
    {
        $user = auth()->user();
        $company = Company::where('id', $user->company_id)->first();

        abort_if(Gate::denies('collaborator_create'), 403);

        $document_types = DocumentType::all();
        $sex_types = SexType::all();
        $rh_types = RhType::all();
        // $academic_achievement_types = AcademicAchievementType::all();
        $stratum_types = SocialStratum::all();
        $civil_status_types = CivilStatusType::all();
        $housing_tenure_types = HousingTenure::all();
        $provinces = Province::all();

        return view('back.collaborators.create', compact('company', 'document_types', 'sex_types', 'rh_types', 'stratum_types', 'civil_status_types', 'housing_tenure_types', 'provinces'));
    }

    public function store(CollaboratorCreateRequest $request)
    {
        // Las validaciones se realizan en CollaboratorCreateRequest

        try{
            $company_id = auth()->user()->company_id;
    
            if($request->hasFile('image')) {
                $file = request()->file('image');
            }

    
            $cloudinary_object = Cloudinary::upload($file->getRealPath(), ['folder' =>  'mh/' . env("APP_ENV", "local") . '/' . $company_id . '/collaborators']); // => mh/local/1/collaborators/qxrcxytjrwufqjij9ix3
            $image_public_id = $cloudinary_object->getPublicId();
            $image_url = $cloudinary_object->getSecurePath();
    
            $data = array(
                'company_id' => $company_id,
                'name' => $request->name,
                'first_surname' => $request->first_surname,
                'second_surname' => $request->second_surname,
                'document_type_id' => $request->document_type_id,
                'document_number' => $request->document_number,
                'document_province_id' => $request->document_province_id,
                'document_city_id' => $request->document_city_id,
                'expedition_date' => $request->expedition_date,
                'birth_province_id' => $request->birth_province_id,
                'birth_city_id' => $request->birth_city_id,
                'birth_date' => $request->birth_date,
                'civil_status_type_id' => $request->civil_status_type_id,
                'sex_type_id' => $request->sex_type_id,
                'rh_type_id' => $request->rh_type_id,
                // 'academic_achievement_type_id' => $request->academic_achievement_type_id,
                'observations' => $request->observations,
                'residence_province_id' => $request->residence_province_id,
                'residence_city_id' => $request->residence_city_id,
                'stratum_type_id' => $request->stratum_type_id,
                'housing_tenure_id' => $request->housing_tenure_id,
                'address' => $request->address,
                'phone' => $request->phone,
                'cellphone' => $request->cellphone,
                'email' => $request->email,
                'image_public_id' => $image_public_id,
                'image_url' => $image_url,
            );
    
            $collaborator = Collaborator::create($data);
    
            return response()->json([
                'message'=>'Colaborador creado exitosamente!',
                'collaborator'=>$collaborator
            ]);
        } catch(Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }

    public function storeContractualInformation(CollaboratorContractCreateRequest $request, $id) {
        // Las validaciones se realizan en CollaboratorContractCreateRequest

        $user = auth()->user();
        $company = Company::where('id', $user->company_id)->first();

        $data = array(
            'collaborator_id' => $id,
            'position_id' => $request->position_id,
            'salary' => $request->salary,
            'contract_type_id' => $request->contract_type_id,
            'contract_start_date' => $request->contract_start_date,
            'contract_end_date' => $request->contract_end_date,
            'test_period_end_date' => $request->test_period_end_date,
            'corporate_email' => $request->corporate_email,
            'corporate_cellphone' => $request->corporate_cellphone,
            'bank_id' => $request->bank_id,
            'bank_account' => $request->bank_account,
            'eps_id' => $request->eps_id,
            'afp_pension_id' => $request->afp_pension_id,
            'afp_saving_id' => $request->afp_saving_id,
            'arl_id' => $request->arl_id,
            'ccf_id' => $request->ccf_id,
        );

        $collaborator_contract = CollaboratorContract::create($data);

        return response()->json([
            'message'=>'Información contractual creada exitosamente!',
            'collaborator_contract'=>$collaborator_contract
        ]);
    }

    public function show(Collaborator $collaborator)
    {
        $user = auth()->user();
        $company = Company::where('id', $user->company_id)->first();

        abort_if(Gate::denies('collaborator_show'), 403);

        // $collaborator_contract = CollaboratorContract::where('collaborator_id', $collaborator->id)->first();
        $document_type = DocumentType::where('id', $collaborator->document_type_id)->first();
        $document_province = Province::where('id', $collaborator->document_province_id)->first();
        $document_city = City::where('id', $collaborator->document_city_id)->first();
        $birth_province = Province::where('id', $collaborator->birth_province_id)->first();
        $birth_city = City::where('id', $collaborator->birth_city_id)->first();
        $residence_province = Province::where('id', $collaborator->residence_province_id)->first();
        $residence_city = City::where('id', $collaborator->residence_city_id)->first();
        $civil_status = CivilStatusType::where('id', $collaborator->civil_status_type_id)->first();
        $sex_type = SexType::where('id', $collaborator->sex_type_id)->first();
        $rh_type = RhType::where('id', $collaborator->rh_type_id)->first();
        $scholarship_type = Scholarship::where('id', $collaborator->scholarship_type_id)->first();
        // $highest_academic_achievement = AcademicAchievementType::where('id', $collaborator->academic_achievement_type_id)->first();
        $stratum_type = SocialStratum::where('id', $collaborator->stratum_type_id)->first();
        $housing_tenure = HousingTenure::where('id', $collaborator->housing_tenure_id)->first();

        $relationship_types = Relationship::all();
        $occupation_types = Occupation::all();
        $sex_types = SexType::all();
        $achievement_types = AcademicAchievementType::all();
        $examination_types = MedicalExaminationType::all();
        $home_visit_types = HomeVisitType::all();
        $contractual_documents_types = ContractualDocumentType::all();

        $relationship_type = Relationship::where('id', $collaborator->relationship_id)->first();
        $occupation_type = Occupation::where('id', $collaborator->occupation_id)->first();

        // $position_type = Position::where('id', $collaborator_contract->position_id)->first();

        return view('back.collaborators.show', compact(
            'company',
            'collaborator', 
            // 'collaborator_contract', 
            'document_type', 
            'document_province', 
            'document_city',
            'birth_province',
            'birth_city',
            'residence_province',
            'residence_city',
            'civil_status',
            'sex_type',
            'rh_type',
            // 'scholarship_type',
            // 'highest_academic_achievement',
            'stratum_type',
            'housing_tenure',
            'relationship_types',
            'relationship_type',
            'occupation_types',
            'occupation_type',
            'sex_types',
            'achievement_types',
            'examination_types',
            'home_visit_types',
            'contractual_documents_types',
        ));
    }

    public function edit(Collaborator $collaborator)
    {
        $user = auth()->user();
        $company = Company::where('id', $user->company_id)->first();
        
        abort_if(Gate::denies('collaborator_edit'), 403);

        $document_types = DocumentType::all();
        $sex_types = SexType::all();
        $rh_types = RhType::all();
        // $academic_achievement_types = AcademicAchievementType::all();
        $stratum_types = SocialStratum::all();
        $civil_status_types = CivilStatusType::all();
        $housing_tenure_types = HousingTenure::all();
        $provinces = Province::all();
        // $contractual_information = CollaboratorContract::where('collaborator_id', $collaborator->id)->first();

        // dd($contractual_information);

        $position_types = Position::where('company_id',$company->id)->get();
        $contract_types = ContractType::all();
        $bank_types = BankType::all();
        $eps_types = EpsType::all();
        $afp_types = AfpType::all();
        $arl_types = ArlType::all();
        $ccf_types = CcfType::all();

        return view('back.collaborators.edit', compact(
            'company',
            'collaborator', 
            'document_types',
            'sex_types', 
            'rh_types', 
            // 'academic_achievement_types', 
            'stratum_types', 
            'civil_status_types',
            'housing_tenure_types',
            'provinces',
            // 'contractual_information',
            'position_types',
            'contract_types',
            'bank_types',
            'eps_types',
            'afp_types',
            'arl_types',
            'ccf_types',
        ));
    }

    public function update(CollaboratorEditRequest $request, Collaborator $collaborator)
    {
        // Las validaciones se realizan en CollaboratorEditRequest

        try {
            $company_id = auth()->user()->company_id;

            $data = array(
                'company_id' => $company_id,
                'name' => $request->name,
                'first_surname' => $request->first_surname,
                'second_surname' => $request->second_surname,
                'document_type_id' => $request->document_type_id,
                'document_number' => $request->document_number,
                'document_province_id' => $request->document_province_id,
                'document_city_id' => $request->document_city_id,
                'expedition_date' => $request->expedition_date,
                'birth_province_id' => $request->birth_province_id,
                'birth_city_id' => $request->birth_city_id,
                'birth_date' => $request->birth_date,
                'civil_status_type_id' => $request->civil_status_type_id,
                'sex_type_id' => $request->sex_type_id,
                'rh_type_id' => $request->rh_type_id,
                // 'scholarship_type_id' => $request->scholarship_type_id,
                'observations' => $request->observations,
                'residence_province_id' => $request->residence_province_id,
                'residence_city_id' => $request->residence_city_id,
                'stratum_type_id' => $request->stratum_type_id,
                'housing_tenure_id' => $request->housing_tenure_id,
                'address' => $request->address,
                'phone' => $request->phone,
                'cellphone' => $request->cellphone,
                'email' => $request->email,
            );
    
            $url = isset($collaborator['image_url']) ? $collaborator['image_url'] : null;
            $public_id = isset($collaborator['image_public_id']) ? $collaborator['image_public_id'] : null;
            if($request->hasFile('image')) {
                if($public_id != null) {
                    Cloudinary::destroy($public_id);
                }
                $file = request()->file('image');
                $cloudinary_object = Cloudinary::upload($file->getRealPath(), ['folder' =>  'mh/' . env("APP_ENV", "local") . '/' . $company_id . '/collaborators']); // => mh/local/1/collaborators/qxrcxytjrwufqjij9ix3
                $image_public_id = $cloudinary_object->getPublicId();
                $image_url = $cloudinary_object->getSecurePath();

                $data['image_public_id'] = $image_public_id;
                $data['image_url'] = $image_url;
            } else {
                $data['image_public_id'] = $public_id;
                $data['image_url'] = $url;
            }
    
            $collaborator->update($data);

            // return redirect()->route('collaborators.show', $collaborator->id)->with('success', 'Colaborador actualizado correctamente.');
    
            return response()->json([
                'message'=>'Colaborador actualizado exitosamente!',
                'collaborator'=>$collaborator
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }

    public function updateContractualInformation(CollaboratorContractEditRequest $request, $id)
    {
        // Las validaciones se realizan en CollaboratorContractEditRequest

        try {

            $collaborator_contract = CollaboratorContract::where('collaborator_id', $id)->first();

            $data = array(
                'collaborator_id' => $id,
                'position_id' => $request->position_id,
                'salary' => $request->salary,
                'contract_type_id' => $request->contract_type_id,
                'contract_start_date' => $request->contract_start_date,
                'contract_end_date' => $request->contract_end_date,
                'test_period_end_date' => $request->test_period_end_date,
                'corporate_email' => $request->corporate_email,
                'corporate_cellphone' => $request->corporate_cellphone,
                'bank_id' => $request->bank_id,
                'bank_account' => $request->bank_account,
                'eps_id' => $request->eps_id,
                'afp_pension_id' => $request->afp_pension_id,
                'afp_saving_id' => $request->afp_saving_id,
                'arl_id' => $request->arl_id,
                'ccf_id' => $request->ccf_id,
            );

            if(isset($collaborator_contract['id'])) {
                $collaborator_contract->update($data);
            } else {
                $collaborator_contract = CollaboratorContract::create($data);
            }
    
            return response()->json([
                'message'=>'Información contractual actualizada exitosamente!',
                'collaborator'=>$collaborator_contract
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }

    public function destroy(Collaborator $collaborator)
    {
        abort_if(Gate::denies('collaborator_destroy'), 403);

        try {
            if(isset($collaborator['image_public_id'])) {
                $public_id = $collaborator['image_public_id'];
                Cloudinary::destroy($public_id);
            }
    
            $collaborator->delete();

            return response()->json([
                'message'=>'Colaborador eliminado exitosamente!',
                'collaborator'=>$collaborator
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }
}
