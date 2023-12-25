<?php

namespace App\Http\Controllers;

use App\Http\Requests\PositionCreateRequest;
use App\Http\Requests\PositionEditRequest;
use App\Models\Area;
use App\Models\Company;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PositionController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('position_index'), 403);

        $user = auth()->user();
        $company = Company::where('id', $user->company_id)->first();

        $positions = Position::all();
        return view('back.positions.index', compact('company', 'positions'));
    }

    public function create()
    {
        abort_if(Gate::denies('position_create'), 403);
        $areas = Area::all()->sortBy("name");
        return view('back.positions.create', compact('areas'));
    }

    public function store(PositionCreateRequest $request)
    {
        $position = Position::create($request->all());
        return redirect()->route('positions.show', $position->id)->with('success', 'Cargo creado exitosamente!');
    }

    public function show(Position $position)
    {
        abort_if(Gate::denies('position_show'), 403);
        return view('back.positions.show', compact('position'));
    }

    public function edit(Position $position)
    {
        abort_if(Gate::denies('position_edit'), 403);
        $areas = Area::all()->sortBy("name");
        return view('back.positions.edit', compact('position', 'areas'));
    }

    public function update(PositionEditRequest $request, Position $position)
    {
        // Las validaciones se realizan en PositionEditRequest

        $data = $request->all();

        $position->update($data);
        return redirect()->route('positions.show', $position->id)->with('success', 'Cargo actualizado correctamente.');
    }

    public function destroy(Position $position)
    {
        abort_if(Gate::denies('position_destroy'), 403);
        $position->delete();
        return back()->with('success', 'Cargo eliminado correctamente.');
    }
}
