@extends('back.layouts.app')

@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-users text-success"></i>
            </div>
            <div>
                Agregar Usuario
            </div>
        </div>
        <div class="page-title-actions">
            <button type="button" class="btn-shadow me-3 btn btn-info"
            onclick="event.preventDefault();
                document.getElementById('show-list-form').submit();">
                <i class="fa fa-list"></i>
                Ver Listado
            </button>

            <form id="show-list-form" action="{{ route('users.index') }}" method="GET" class="d-none">
                @csrf
            </form>
        </div>
    </div>
</div>

<div class="mbg-3 alert alert-info alert-dismissible fade show" role="alert">
    <span class="pe-2">
        <i class="fa fa-question-circle"></i>
    </span>
    This dashboard example was created using only the available elements and components, no additional SCSS was
written!
</div>

<div class="main-card mb-3 card">
    <div class="card-body">
        <form action="{{ route('users.store') }}" method="post" class="">
        @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="position-relative mb-3">
                        <label for="name" class="form-label">Nombre</label>
                        <input name="name" id="name"
                            placeholder="Ingresar nombre" type="text" class="form-control" autofocus>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="position-relative mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input name="email" id="email"
                            placeholder="Ingresar email" type="email" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="position-relative mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input name="password" id="password"
                            placeholder="Ingresar contraseña"
                            type="password" class="form-control">
                    </div>
                </div>
            </div>
            <button type="submit" class="mt-2 btn btn-primary">Guardar</button>
        </form>
    </div>
</div>
@endsection