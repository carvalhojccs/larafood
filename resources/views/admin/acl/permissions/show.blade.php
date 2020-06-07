@extends('adminlte::page')
@section('title','Permissão - Detalhes')
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
                <li class="breadcrumb-item active"><a href="#">Detalhes</a></li>
            </ol>
        </div>
    </div>
    @stop
    @section('content')
    <div class="card">
        <div class="card-header bg-blue">
            Detalhes da permissão
        </div>
        <div class="card-body">
            <div class="form form-group">
                <label>Nome:</label>
                <input type="text" class="form-control" value="{{ $data->name }}" disabled>
            </div>
            <div class="form form-group">
                <label>Descrição:</label>
                <input type="text" class="form-control" value="{{ $data->description }}" disabled>
            </div>
        </div>
        <div class="card-footer">
            <form action="{{ route('permissions.destroy', $data->id) }}" id="formDestroy" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" id="btnDeletar"><i class="fas fa-trash">&nbsp;</i>Deletar</button>
            </form>
        </div>
    </div>
    @stop
    @section('js')
    <script src="{{ asset('includes/js/confirm.delete.js') }}"></script>
    @stop