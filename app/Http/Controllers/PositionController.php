<?php

namespace App\Http\Controllers;

use App\Http\Requests\PositionCreateRequest;
use App\Http\Requests\PositionEditRequest;
use App\Models\Area;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('position_index'), 403);
        $positions = Position::all();
        return view('back.positions.index', compact('positions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('position_create'), 403);
        $areas = Area::all()->sortBy("name");
        return view('back.positions.create', compact('areas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PositionCreateRequest $request)
    {
        $position = Position::create($request->all());
        return redirect()->route('positions.show', $position->id)->with('success', 'Cargo creado exitosamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function show(Position $position)
    {
        abort_if(Gate::denies('position_show'), 403);
        return view('back.positions.show', compact('position'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function edit(Position $position)
    {
        abort_if(Gate::denies('position_edit'), 403);
        $areas = Area::all()->sortBy("name");
        return view('back.positions.edit', compact('position', 'areas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function update(PositionEditRequest $request, Position $position)
    {
        // Las validaciones se realizan en PositionEditRequest

        $data = $request->all();

        $position->update($data);
        return redirect()->route('positions.show', $position->id)->with('success', 'Cargo actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function destroy(Position $position)
    {
        abort_if(Gate::denies('position_destroy'), 403);
        $position->delete();
        return back()->with('success', 'Cargo eliminado correctamente.');
    }
}
