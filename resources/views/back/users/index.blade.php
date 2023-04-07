@extends('back.layouts.app')

@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-users text-success"></i>
            </div>
            <div>
                Listado de Usuarios
            </div>
        </div>
        <div class="page-title-actions">
            <button type="button" class="btn-shadow me-3 btn btn-info"
            onclick="event.preventDefault();
                document.getElementById('add-user-form').submit();">
                <i class="fa fa-user-plus"></i>
                Agregar
            </button>

            <form id="add-user-form" action="{{ route('users.create') }}" method="GET" class="d-none">
                @csrf
            </form>
        </div>
    </div>
</div>

@if (session('success'))    
    <div class="mbg-3 alert alert-success alert-dismissible fade show" role="alert">
        <span class="pe-2">
            <i class="fa fa-star"></i>
            {{-- <i class="pe-7s-star"></i> --}}
        </span>
        {{ session('success') }}
    </div>
@endif

<div class="main-card mb-3 card">
    <div class="card-body">
        {{-- <table style="width: 100%;" id="example" class="table table-cntk table-hover table-striped table-bordered"> --}}
        <table style="width: 100%;" id="example" class="table table-cntk table-hover table-bordered">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)    
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        {{-- <td class="d-flex justify-content-end"> --}}
                        {{-- <td class="justify-content-end"> --}}
                        <td class="td-actions">
                            <a href="{{ route('users.show', $user->id) }}" class="mb-2 me-2 btn-icon btn btn-sm btn-success">
                                <i class="pe-7s-look btn-icon-wrapper"></i>Mostrar
                            </a>
                            <a href="#" class="mb-2 me-2 btn-icon btn btn-sm btn-primary">
                                <i class="pe-7s-pen btn-icon-wrapper"></i>Editar
                            </a>
                            <a href="#" class="mb-2 me-2 btn-icon btn btn-sm btn-danger">
                                <i class="pe-7s-trash btn-icon-wrapper"></i>Eliminar
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Acciones</th>
                </tr>
            </tfoot>
        </table>

        {{-- {{ $users->onEachSide(2)->links() }} --}}
    </div>
</div>
@endsection