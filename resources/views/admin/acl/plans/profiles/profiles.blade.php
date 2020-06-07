@extends('adminlte::page')
@section('title',"Perfis do plano {$plan->name}")
@section('content_header')
<div class="container-fluid border-bottom">
    <div class="row mb-2">
        <div class="col-sm-6">
            Listagem dos perfis do plano: <strong>{{ $plan->name }}</strong>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route( 'admin.index' ) }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route( 'plans.index' ) }}">Perfis</a></li>
                <li class="breadcrumb-item active"><a href="{{ route( 'plans.profiles', $plan->id ) }}">Planos</a></li>
            </ol>
        </div>
    </div>
    <a href="{{ route('plans.profiles.available', $plan->id) }}" class="btn btn-dark">ADD NOVO PERFIL</a>
@stop 
@section('content')
<div class="card">
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
                        <a href="{{ route( 'plans.profile.detach',[$plan->id, $profile->id] ) }}" class="btn btn-danger">DESVINCULAR</a>
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