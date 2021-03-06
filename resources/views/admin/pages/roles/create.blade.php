@extends('adminlte::page')
@section('title','Cargos - Criar')
@section('content_header')
<div class="container-fluid border-bottom">
    <div class="row mb-2">
        <div class="col-sm-6">
            Criar novo cargo
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Cargos</a></li>
                <li class="breadcrumb-item active"><a href="#">Cadastrar</a></li>
            </ol>
        </div>
    </div>
</div>
@stop
@section('content')
<div class="card">
    <form action="{{ route('roles.store') }}" class="form" method="POST">
        @csrf
        <div class="card-body">
            @include('admin.pages.roles._partials.form')
        </div>
        @include('admin.includes.btn_create')
    </form>
</div>
@stop