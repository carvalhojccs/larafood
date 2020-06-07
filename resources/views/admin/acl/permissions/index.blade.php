@extends('adminlte::page')
@section('title','Permissões')
@section('content_header')
<div class="container-fluid border-bottom">
    <div class="row mb-2">
        <div class="col-sm-6">
            Listagem das Permissões
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route( 'admin.index' ) }}">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="{{ route( 'permissions.index' ) }}">Permissões</a></li>
            </ol>
        </div>
    </div>
@stop
@section('content')
<div class="card">
    <a href="{{ route( 'permissions.create' ) }}" class="btn btn-dark"><i class="fas fa-plus-square">&nbsp;</i>Adicionar</a>
    <div class="card-header">
        <form action="{{ route( 'permissions.search' ) }}" method="POST" class="form form-inline">
            @csrf
                <input type="text" name="filter" placeholder="Filtro" class="form-control" value="{{ $filters['filter'] ?? ''}}">
                <button type="submit" class="btn btn-dark"><i class="fas fa-search">&nbsp;</i>Pesquisar</button>
        </form>
    </div>
    <div class="card-body">
        @include('admin.includes.alerts')
        <table class="table table-condensed table-hover">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th style="text-align: right">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->description }}</td>
                    <td  style="text-align: right">
                        <a href="{{ route( 'permissions.edit',$item->id ) }}" class="btn btn-primary">Editar</a>
                        <a href="{{ route( 'permissions.show',$item->id ) }}" class="btn btn-info">Ver</a>
                        <a href="{{ route( 'permission.profiles',$item->id ) }}" class="btn btn-danger" title="Perfis associados"><i class="fas fa-address-book"></i></a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3">Nenhuma informação cadastrada!</td>
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
@section('js')
<script>
$(document).ready(function(){
    $(".alert").fadeIn().delay(2000).fadeOut();
});
</script>
@stop