@extends('adminlte::page')
@section('title','Perfis da permissão {$permission->name}')
@section('content_header')
<div class="container-fluid border-bottom">
    <div class="row mb-2">
        <div class="col-sm-6">
            Listagem dos perfis da permissão: <strong>{{ $permission->name }}</strong>
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
    <div class="card-header">
    </div>
    <div class="card-body">
        <table class="table table-condensed table-hover">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th style="text-align: right">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($profiles as $profile)
                <tr>
                    <td>{{ $profile->name }}</td>
                    <td>{{ $profile->description }}</td>
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
            {{ $profiles->appends($filters)->links() }}
        @else
            {{ $profiles->links() }}
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