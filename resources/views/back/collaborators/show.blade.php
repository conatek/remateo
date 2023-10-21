@extends('back.layouts.app')

@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-user text-success"></i>
            </div>
            <div>
                Información del Colaborador
            </div>
        </div>
        <div class="page-title-actions">
            <a href="{{ route('collaborators.index') }}" type="button" class="btn-shadow me-3 btn btn-info">
                <i class="fa fa-list"></i>
                Ver Listado
            </a>
        </div>
    </div>
</div>

@isset($message)
    <div class="mbg-3 alert alert-success alert-dismissible fade show" role="alert">
        <span class="pe-2">
            <i class="fa fa-star"></i>
            {{-- <i class="pe-7s-star"></i> --}}
        </span>
        {{ $message }}
    </div>
@endisset

<collaborator-show 
    :collaborator="{{ $collaborator }}"
    :document_type="{{ $document_type }}"
    :document_province="{{ $document_province }}"
    :document_city="{{ $document_city }}"
    :birth_province="{{ $birth_province }}"
    :birth_city="{{ $birth_city }}"
    :civil_status="{{ $civil_status }}"
    :sex_type="{{ $sex_type }}"
    :rh_type="{{ $rh_type }}"
    :scholarship_type="{{ $scholarship_type }}"
></collaborator-show>

@endsection
