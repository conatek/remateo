<?php

namespace App\Http\Controllers;

use App\Models\Collaborator;
use Illuminate\Http\Request;

class CollaboratorController extends Controller
{
    public function index()
    {
        // abort_if(Gate::denies('user_index'), 403);
        $collaborators = Collaborator::all();
        return view('back.collaborators.index', compact('collaborators'));
    }
}
