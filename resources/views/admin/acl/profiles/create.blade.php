@extends('adminlte::page')
@section('title','Perfil - Cadastro')
@section('content_header')
<div class="container-fluid border-bottom">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h3>Gestão de Perfis</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route( 'admin.index' ) }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route( 'profiles.index' ) }}">Perfis</a></li>
                <li class="breadcrumb-item active"><a href="{{ route( 'profiles.create' ) }}">Cadastrar</a></li>
            </ol>
        </div>
    </div>
</div>
@stop
@section('content')
<div class="card">
    <div class="card-header bg-blue">
        Cadastro de novo perfil
    </div>
    <div class="card-body">
        <form action="{{ route( 'profiles.store' ) }}" method="POST">
            @csrf
            @method('POST')
            @include('admin.acl.profiles._partials.form')
        </form>
    </div>
</div>
@stop