<?php

namespace App\Http\Controllers;

use App\Models\Collaborator;
use Illuminate\Http\Request;

class CollaboratorController extends Controller
{
    public function getCollaborators() {
        $results = [];
        
        $user_company_id = auth()->user()->company_id;
        // $collaborators = Collaborator::where('company_id', $user_company_id)->paginate(8);
        $collaborators = Collaborator::where('company_id', $user_company_id)->get();
        // $collaborators->toArray();

        // dd(json_encode($collaborators->toArray()));
        // dd($collaborators->links());

        // $results['collaborators'] = $collaborators;
        // $results['collaborators'] = json_encode($collaborators->toArray());
        $results['collaborators'] = $collaborators->toArray();

        return $results;
    }

    public function index()
    {
        // abort_if(Gate::denies('user_index'), 403);
        $user_company_id = auth()->user()->company_id;
        $collaborators = Collaborator::where('company_id', $user_company_id)->get();
        // $collaborators = $collaboratorsData->toArray();
        // $collaborators = Collaborator::where('company_id', $user_company_id)->paginate(8);
        // $collaborators = Collaborator::where('company_id', $user_company_id)->paginate(8)->toArray;
        // dd($collaborators);
        return view('back.collaborators.index', compact('collaborators'));
        // return view('back.collaborators.index');
    }
}
