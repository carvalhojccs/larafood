@extends('adminlte::page')
@section('title','Permissões')
@section('content_header')
@include('admin.includes.alerts')
<div class="container-fluid border-bottom">
    <div class="row mb-2">
        <div class="col-sm-6">
            Permissões atribuídas ao cargo: <strong>{{ $role->name }}</strong>
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
<div class="card">
    <div class="card-header">
        <a href="{{ route('roles.permissions.available', $role->id) }}" class="btn btn-success btn-sm"><i class="fas fa-file">&nbsp;</i>Nova permissão</a>
    </div>
    <div class="card-body">
        <table class="table table-condensed table-hover">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th style="text-align: right">Detalhe</th>
                </tr>
            </thead>
            <tbody>
                @forelse($permissions as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td style="text-align: right">
                        <a href="{{ route('roles.permission.detach', [$role->id, $item->id]) }}" class="btn btn-danger btn-sm">Desvincular</a>
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
        @if (isset($filters))
            {!! $permissions->appends($filters)->links() !!}
        @else
            {!! $permissions->links() !!}
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
