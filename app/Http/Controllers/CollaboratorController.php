<?php

namespace App\Http\Controllers;

use App\Http\Requests\CollaboratorCreateRequest;
use App\Http\Requests\CollaboratorEditRequest;
use App\Models\City;
use App\Models\CivilStatusType;
use App\Models\Collaborator;
use App\Models\DocumentType;
use App\Models\HousingTenure;
use App\Models\Province;
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
        $results['collaborators'] = $collaborators->toArray();

        return $results;
    }

    public function index()
    {
        abort_if(Gate::denies('collaborator_index'), 403);
        $user_company_id = auth()->user()->company_id;
        $collaborators = Collaborator::where('company_id', $user_company_id)->orderBy('created_at', 'desc')->get();
        return view('back.collaborators.index', compact('collaborators'));
    }

    public function create()
    {
        abort_if(Gate::denies('collaborator_create'), 403);

        $document_types = DocumentType::all();
        $sex_types = SexType::all();
        $rh_types = RhType::all();
        $scholarship_types = Scholarship::all();
        $stratum_types = SocialStratum::all();
        $civil_status_types = CivilStatusType::all();
        $housing_tenure_types = HousingTenure::all();
        $provinces = Province::all();

        return view('back.collaborators.create', compact('document_types','sex_types', 'rh_types', 'scholarship_types', 'stratum_types', 'civil_status_types', 'housing_tenure_types', 'provinces'));
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
                'scholarship_type_id' => $request->scholarship_type_id,
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

    // public function show(Collaborator $collaborator, $message = false)
    public function show(Collaborator $collaborator, Request $request)
    {
        $origin = $request->origin;
        $message = '';

        abort_if(Gate::denies('collaborator_show'), 403);

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
        $stratum_type = SocialStratum::where('id', $collaborator->stratum_type_id)->first();
        $housing_tenure = HousingTenure::where('id', $collaborator->housing_tenure_id)->first();

        if($origin == 'update') {
            $message = 'Colaborador actualizado exitosamente!';
        } elseif($origin == 'store') {
            $message = 'Colaborador creado exitosamente!';
        }

        return view('back.collaborators.show', compact(
            'collaborator', 
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
            'scholarship_type',
            'stratum_type',
            'housing_tenure',
            'message'
        ));
    }

    public function edit(Collaborator $collaborator)
    {
        abort_if(Gate::denies('collaborator_edit'), 403);

        $document_types = DocumentType::all();
        $sex_types = SexType::all();
        $rh_types = RhType::all();
        $scholarship_types = Scholarship::all();
        $stratum_types = SocialStratum::all();
        $civil_status_types = CivilStatusType::all();
        $housing_tenure_types = HousingTenure::all();
        $provinces = Province::all();

        return view('back.collaborators.edit', compact(
            'collaborator', 
            'document_types',
            'sex_types', 
            'rh_types', 
            'scholarship_types', 
            'stratum_types', 
            'civil_status_types',
            'housing_tenure_types',
            'provinces'
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
                'scholarship_type_id' => $request->scholarship_type_id,
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
        
        // return back()->with('success', 'Colaborador eliminado correctamente!');
    }
}
