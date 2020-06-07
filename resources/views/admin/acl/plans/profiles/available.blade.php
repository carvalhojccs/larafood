@extends('adminlte::page')
@section('title',"Permissões do perfil {$plan->name}")
@section('content_header')
<div class="container-fluid border-bottom">
    <div class="row mb-2">
        <div class="col-sm-6">
            Perfis disponíveis para o plano: <strong>{{ $plan->name }}</strong>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route( 'admin.index' ) }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route( 'plans.index' ) }}">Planos</a></li>
                <li class="breadcrumb-item"><a href="{{ route( 'plans.profiles', $plan->id ) }}">Perfis</a></li>
                <li class="breadcrumb-item active"><a href="{{ route( 'plans.profiles.available', $plan->id ) }}">Disponíveis</a></li>
            </ol>
        </div>
    </div>
@stop
@section('content')
<div class="card">
    <div class="card-header">
        <form action="{{ route( 'plans.profiles.available', $plan->id ) }}" method="POST" class="form form-inline">
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
                    <th width='50px'>#</th>
                    <th>Nome</th>
                </tr>
            </thead>
            <tbody>
            <form action="{{ route('plans.profiles.attach', $plan->id) }}" method="POST"> 
                @csrf
                @forelse($profiles as $profile)
                <tr>
                    <td><input type="checkbox" name="profiles[]" value="{{ $profile->id }}"> </td>
                    <td>{{ $profile->description }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="3">Nenhuma informação cadastrada!</td>
                </tr>
                @endforelse
                <tr>
                    <td colspan="500">
                        <button type="submit" class="btn btn-primary">Vincular</button>
                    </td>
                </tr>
            </form>
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