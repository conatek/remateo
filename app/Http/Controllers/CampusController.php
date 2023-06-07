<?php

namespace App\Http\Controllers;

use App\Models\Campus;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CampusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('campus_index'), 403);
        $campuses = Campus::all()->sortBy('name');
        return view('back.campuses.index', compact('campuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('campus_create'), 403);
        $provinces = Province::all()->sortBy("name");
        return view('back.campuses.create', compact('provinces'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = array(
            'company_id' => $request->company_id,
            'province_id' => $request->province_id,
            'city_id' => $request->city_id,
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
        );

        $campus = Campus::create($data);

        return response()->json([
            'message'=>'Sede creada exitosamente!',
            'campus'=>$campus
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Campus  $campus
     * @return \Illuminate\Http\Response
     */
    public function show(Campus $campus)
    {
        abort_if(Gate::denies('campus_show'), 403);
        return view('back.campuses.show', compact('campus'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Campus  $campus
     * @return \Illuminate\Http\Response
     */
    public function edit(Campus $campus)
    {
        abort_if(Gate::denies('campus_edit'), 403);
        $provinces = Province::all()->sortBy("name");
        return view('back.campuses.edit', compact('campus', 'provinces'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Campus  $campus
     * @return \Illuminate\Http\Response
     */
//    public function update(Request $request, Campus $campus)
    public function update(Request $request)
    {
        // Las validaciones se realizan en PositionEditRequest

//        $data = $request->all();
//
//        $campus->update($data);
//        return redirect()->route('campuses.show', $campus->id)->with('success', 'Sede actualizada correctamente.');

        $data = array(
            'id' => $request->id,
            'company_id' => $request->company_id,
            'province_id' => $request->province_id,
            'city_id' => $request->city_id,
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
        );

        $campus = Campus::where('id', $data['id'])->first();
        $campus->update($data);

        return response()->json([
            'message'=>'Sede actualizada exitosamente!',
            'campus'=>$data['id']
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Campus  $campus
     * @return \Illuminate\Http\Response
     */
    public function destroy(Campus $campus)
    {
        abort_if(Gate::denies('campus_destroy'), 403);
        $campus->delete();
        return back()->with('success', 'Sede eliminada correctamente.');
    }
}
