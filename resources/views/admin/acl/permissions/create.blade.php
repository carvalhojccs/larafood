@extends('adminlte::page')
@section('title','Permissão - Cadastro')
@section('content_header')
<div class="container-fluid border-bottom">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h3>Gestão de Permissão</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route( 'admin.index' ) }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route( 'permissions.index' ) }}">Permissão</a></li>
                <li class="breadcrumb-item active"><a href="{{ route( 'permissions.create' ) }}">Cadastrar</a></li>
            </ol>
        </div>
    </div>
</div>
@stop
@section('content')
<div class="card">
    <div class="card-header bg-blue">
        Cadastro de nova permissão
    </div>
    <div class="card-body">
        <form action="{{ route( 'permissions.store' ) }}" method="POST">
            @csrf
            @method('POST')
            @include('admin.acl.permissions._partials.form')
        </form>
    </div>
</div>
@stop