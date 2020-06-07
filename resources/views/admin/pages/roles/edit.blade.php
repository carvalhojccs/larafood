@extends('adminlte::page')
@section('title','Cargo - Editar')
@section('content_header')
<div class="container-fluid border-bottom">
    <div class="row mb-2">
        <div class="col-sm-6">
            Editar cargo
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Cargos</a></li>
                <li class="breadcrumb-item active"><a href="#">Editar</a></li>
            </ol>
        </div>
    </div>
</div>
@stop
@section('content')
<div class="card">
    <form action="{{ route('roles.update', $data->id) }}" class="form" method="POST">
        @csrf
        @method("PUT")
        <div class="card-body">
            @include('admin.pages.roles._partials.form')
        </div>
        <div class="card-footer">
            <a href="{{ route('roles.index') }}" class="btn btn-info btn-sm"><i class="fas fa-reply">&nbsp;</i>Voltar</a>
            <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-save">&nbsp;</i>Salvar</button>
        </div>
    </form>
</div>
@stop
