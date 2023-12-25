<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyCreateRequest;
use App\Http\Requests\CompanyEditRequest;
use App\Models\Company;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CompanyController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('company_index'), 403);
        $companies = Company::all();
        return view('back.companies.index', compact('companies'));
    }

    public function create()
    {
        abort_if(Gate::denies('company_create'), 403);
        return view('back.companies.create');
    }

    public function store(CompanyCreateRequest $request)
    {
        // Las validaciones se realizan en CompanyCreateRequest

        $company = Company::create($request->only('name'));
        return redirect()->route('companies.show', $company->id)->with('success', 'Empresa creada exitosamente!');
    }

    public function show(Company $company)
    {
        abort_if(Gate::denies('company_show'), 403);
        return view('back.companies.show', compact('company'));
    }

    public function edit(Company $company)
    {
        abort_if(Gate::denies('company_edit'), 403);
        return view('back.companies.edit', compact('company'));
    }

    public function update(CompanyEditRequest $request, Company $company)
    {
        // Las validaciones se realizan en CompanyEditRequest

        $data = $request->only('name');

        $company->update($data);
        return redirect()->route('companies.show', $company->id)->with('success', 'Empresa actualizada correctamente.');
    }

    public function destroy(Company $company)
    {
        abort_if(Gate::denies('company_destroy'), 403);
        $company->delete();
        return back()->with('success', 'Empresa eliminada correctamente.');
    }


    // COMPANY
    public function companyShow(Company $company)
    {
        // abort_if(Gate::denies('company_show'), 403);
        $provinces = Province::all()->sortBy("name");
        return view('back.company.show', compact('company', 'provinces'));
    }
}
