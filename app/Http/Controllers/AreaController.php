<?php

namespace App\Http\Controllers;

use App\Http\Requests\AreaCreateRequest;
use App\Http\Requests\AreaEditRequest;
use App\Models\Area;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('area_index'), 403);
        $areas = Area::all();
        return view('back.areas.index', compact('areas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('area_create'), 403);
        return view('back.areas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AreaCreateRequest $request)
    {
        // Las validaciones se realizan en AreaCreateRequest

        $area = Area::create($request->all());
        return redirect()->route('areas.show', $area->id)->with('success', 'Área creada exitosamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function show(Area $area)
    {
        abort_if(Gate::denies('area_show'), 403);
        return view('back.areas.show', compact('area'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function edit(Area $area)
    {
        abort_if(Gate::denies('area_edit'), 403);
        return view('back.areas.edit', compact('area'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function update(AreaEditRequest $request, Area $area)
    {
        // Las validaciones se realizan en AreaEditRequest

        $data = $request->only('name');

        $area->update($data);
        return redirect()->route('areas.show', $area->id)->with('success', 'Área actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function destroy(Area $area)
    {
        abort_if(Gate::denies('area_destroy'), 403);
        $area->delete();
        return back()->with('success', 'Área eliminada correctamente.');
    }
}
