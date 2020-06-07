@extends('adminlte::page')
@section('title','Listagem dos cargos')
@section('content_header')
@include('admin.includes.alerts')
<div class="container-fluid border-bottom">
    <div class="row mb-2">
        <div class="col-sm-6">
            Listagem dos cargos
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="#">Cargos</a></li>
            </ol>
        </div>
    </div>
</div>
@stop
@section('content')
<div class="card card-primary">
    <div class="card-body">
        <form action="{{ route('roles.search') }}" method="POST" class="form form-inline">
            @csrf
            <input type="text" name="name" placeholder="Cargo" class="form-control-sm" value="{{ $filters['name'] ?? '' }}">
            <input type="text" name="description" placeholder="Descrição" class="form-control-sm" value="{{ $filters['description'] ?? '' }}">
            <button type="submit" class="btn btn-info btn-sm"><i class="fas fa-search">&nbsp;</i>Pesquisar</button>
            @if(isset($filters))
            <a href="{{ route('roles.index') }}" class="btn btn-dark btn-sm"><i class="fas fa-sync"></i></a>
            @endif
        </form>
    </div>
</div>
<div class="card">
    <div class="card-header">
        <a href="{{ route('roles.create') }}" class="btn btn-success btn-sm"><i class="fas fa-file">&nbsp;</i>Novo</a>
    </div>
    <div class="card-body">
        <table class="table table-condensed table-hover">
            <thead>
                <tr>
                    <th>Cargo</th>
                    <th>Descrição</th>
                    <th style="text-align: right">Detalhe</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->description }}</td>
                    <td style="text-align: right">
                        <a href="{{ route('roles.show', $item->id) }}" class="btn btn-primary btn-sm">Detalhes</a>
                        <a href="{{ route('roles.permissions', $item->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-lock"></i></a>
                        
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3"><div class="container-fluid">Nenhum cadastro encontrato</div></td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        @if(isset($filters))
            {{ $data->appends($filters)->links() }}
        @else
            {{ $data->links() }}
        @endif
    </div>
</div>
@stop
@section('css')
<link rel="stylesheet" href="{{ asset('/vendor/toastr/css/toastr.min.css') }}">
@stop
@section('js')
<script src="{{ asset('/vendor/toastr/js/toastr.min.js') }}"></script>
@stop
