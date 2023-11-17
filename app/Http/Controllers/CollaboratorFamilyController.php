<?php

namespace App\Http\Controllers;

use App\Models\CollaboratorFamily;
use Illuminate\Http\Request;
use Exception;

class CollaboratorFamilyController extends Controller
{
    public function show($collaborator_id) {
        try{
            $relatives_data = CollaboratorFamily::where('collaborator_id', $collaborator_id)->orderBy('created_at', 'desc')->get();

            return response()->json([
                'relatives_data' => $relatives_data,
            ]);
        } catch(Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }

    // public function store(PersonalDataCreateRequest $request)
    public function store(Request $request)
    {
        // Las validaciones se realizan en PersonalDataCreateRequest

        try{
            $data = array(
                'collaborator_id' => $request->collaborator_id,
                'name' => $request->name,
                'first_surname' => $request->first_surname,
                'second_surname' => $request->second_surname,
                'relationship_id' => $request->relationship_type_id,
                'occupation_id' => $request->occupation_type_id,
                'sex_type_id' => $request->sex_type_id,
                'birth_date' => $request->birth_date,
            );

            $relative_data = CollaboratorFamily::create($data);
    
            return response()->json([
                'message'=>'Familiar creado exitosamente!',
                'relative_data'=>$relative_data,
            ]);
        } catch(Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }
}
