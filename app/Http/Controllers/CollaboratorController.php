<?php

namespace App\Http\Controllers;

use App\Models\Collaborator;
use Illuminate\Http\Request;

class CollaboratorController extends Controller
{
    public function index()
    {
        // abort_if(Gate::denies('user_index'), 403);
        $user_company_id = auth()->user()->company_id;
        $collaborators = Collaborator::where('company_id', $user_company_id)->get();
        // $collaborators = Collaborator::where('company_id', $user_company_id)->paginate(8);
        // $collaborators = Collaborator::where('company_id', $user_company_id)->paginate(8)->toArray;
        // dd($collaborators);
        return view('back.collaborators.index', compact('collaborators'));
    }
}
