@extends('adminlte::page')
@section('title',"Detalhes do detalhe {$detail->name}")
@section('content_header')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('plans.index') }}">Planos</a></li>
    <li class="breadcrumb-item"><a href="{{ route('plans.show', $plan->url) }}">{{ $plan->name }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('details.plan.index', $plan->url) }}">Detalhes</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('details.plan.show', [$detail->id, $plan->url]) }}">Detalhe</a></li>
</ol>
<h1>Detalhe do detalhe - <strong>{{ $detail->name }}</strong></h1>
@stop
@section('content')
<div class="card">
    <div class="card-header bg-primary"></div>
    <div class="card-body">
        <ol>
            <li>
                <strong>Nome: </strong> {{ $detail->name }}
            </li>
        </ol>
    </div>
    <div class="card-footer">
        <form action="{{ route('details.plan.destroy',[$detail->id, $plan->url]) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger"><i class="fas fa-trash">&nbsp;</i>Deletar</button>
        </form>
    </div>
</div>
@stop