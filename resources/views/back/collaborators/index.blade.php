@extends('back.layouts.app')

@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-users text-success"></i>
            </div>
            <div>
                Listado de Colaboradores
            </div>
        </div>
        <div class="page-title-actions">
            @can('user_create')
            <a href="{{ route('users.create') }}" type="button" class="btn-shadow me-3 btn btn-info">
                <i class="fa fa-plus"></i>
                Agregar
            </a>
            @endcan
        </div>
    </div>
</div>

@if (session('success'))
    <div class="mbg-3 alert alert-success alert-dismissible fade show" role="alert">
        <span class="pe-2">
            <i class="fa fa-star"></i>
            <i class="pe-7s-star"></i>
        </span>
        {{ session('success') }}
    </div>
@endif

<div class="main-card mb-3 card">
    <div class="card-body">
        @php
            $company_id = auth()->user()->company_id;
        @endphp

        
        <collaborator-index :company_id="{{ $company_id }}" :collaborators="{{ $collaborators }}"></collaborator-index>
        {{-- <collaborator-index :company_id="{{ $company_id }}" :collaborators="{{ $collaborators }}"></collaborator-index> --}}
        {{-- <collaborator-index :company_id="{{ $company_id }}" :collaborators="{{ $collaborators }}"></collaborator-index> --}}

        {{-- <campus-create :company_id="{{ $company_id }}" :collaborators="{{ $collaborators }}"></campus-create> --}}
        {{-- <collaborator-index :company_id="{{ $company_id }}"></collaborator-index> --}}

        {{-- <div class="row">
            @foreach ($collaborators as $collaborator)
                <div class="col-sm-12 col-md-12 col-lg-6">
                    <div class="mb-3 text-dark card-border card bg-light">
                        <div class="card-header">{{ $collaborator->name }} {{ $collaborator->first_surname }} {{ $collaborator->second_surname }}</div>
                        <div class="card-body">
                            {{ $collaborator->name }} {{ $collaborator->first_surname }} {{ $collaborator->second_surname }}
                        </div>
                        <div class="d-block text-end card-footer">
                            <button class="me-2 btn btn-link btn-sm">Cancel</button>
                            <button class="btn-shadow-primary btn btn-primary btn-lg">Submit</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div> --}}
        {{-- {{ $collaborators->links() }} --}}
    </div>
</div>
@endsection
