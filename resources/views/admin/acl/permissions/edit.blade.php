@extends('adminlte::page')
@section('title','Permissão - Editar')
@section('content_header')
<div class="container-fluid border-bottom">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h3>Gestão de Permissões</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route( 'admin.index' ) }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route( 'permissions.index' ) }}">Permissões</a></li>
                <li class="breadcrumb-item active"><a href="#">Editar</a></li>
            </ol>
        </div>
    </div>
</div>
@stop
@section('content')
<div class="card">
    <div class="card-header bg-blue">
        Editar permissão
    </div>
    <div class="card-body">
        @include('admin.includes.alerts')
        <form action="{{ route( 'permissions.update', $data->id ) }}" method="POST">
            @csrf
            @method('PUT')
            @include('admin.acl.permissions._partials.form')
        </form>
    </div>
</div>
@stop