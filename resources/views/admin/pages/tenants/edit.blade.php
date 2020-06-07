@extends('adminlte::page')
@section('title','Empresa - Editar')
@section('content_header')
<div class="container-fluid border-bottom">
    <div class="row mb-2">
        <div class="col-sm-6">
            Editar empresa
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('tenants.index') }}">Empresas</a></li>
                <li class="breadcrumb-item active"><a href="#">Editar</a></li>
            </ol>
        </div>
    </div>
</div>
@stop
@section('content')
<div class="card">
    <form action="{{ route('tenants.update', $data->id) }}" class="form" method="POST" enctype="multipart/form-data">
        @csrf
        @method("PUT")
        <div class="card-body">
            @include('admin.pages.tenants._partials.form')
        </div>
        <div class="card-footer">
            <a href="{{ route('tenants.index') }}" class="btn btn-info btn-sm"><i class="fas fa-reply">&nbsp;</i>Voltar</a>
            <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-save">&nbsp;</i>Salvar</button>
        </div>
    </form>
</div>
@stop
