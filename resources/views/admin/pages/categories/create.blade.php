@extends('adminlte::page')
@section('title','Categorias - Criar')
@section('content_header')
<div class="container-fluid border-bottom">
    <div class="row mb-2">
        <div class="col-sm-6">
            Criar nova categoria
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Categorias</a></li>
                <li class="breadcrumb-item active"><a href="#">Cadastrar</a></li>
            </ol>
        </div>
    </div>
</div>
@stop
@section('content')
<div class="card">
    <form action="{{ route('categories.store') }}" class="form" method="POST">
        @csrf
        <div class="card-body">
            @include('admin.pages.categories._partials.form')
        </div>
        @include('admin.includes.btn_create')
    </form>
</div>
@stop