@extends('adminlte::page')
@section('title',"Permissões do perfil {$profile->name}")
@section('content_header')
<div class="container-fluid border-bottom">
    <div class="row mb-2">
        <div class="col-sm-6">
            Listagem das permissões do perfil: <strong>{{ $profile->name }}</strong>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route( 'admin.index' ) }}">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="{{ route( 'profiles.index' ) }}">Perfis</a></li>
            </ol>
        </div>
    </div>
@stop
@section('content')
<div class="card">
    <a href="{{ route( 'profile.permissions.available', $profile->id ) }}" class="btn btn-dark"><i class="fas fa-plus-square">&nbsp;</i>Adicionar Permissão</a>
    <div class="card-header">
        <form action="{{ route( 'profiles.search' ) }}" method="POST" class="form form-inline">
            @csrf
                <input type="text" name="filter" placeholder="Perfil" class="form-control" value="{{ $filters['filter'] ?? ''}}">
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
                @forelse($permissions as $permission)
                <tr>
                    <td>{{ $permission->name }}</td>
                    <td>{{ $permission->description }}</td>
                    <td  style="text-align: right">
                        <a href="{{ route( 'profile.permissions.detach',[$profile->id, $permission->id] ) }}" class="btn btn-danger">Remover</a>
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
            {{ $permissions->appends($filters)->links() }}
        @else
            {{ $permissions->links() }}
        @endif
    </div>
</div>
@stop
@section('js')
<script>
$(document).ready(function(){
    $(".alert").fadeIn().delay(5000).fadeOut();
});
</script>
@stop