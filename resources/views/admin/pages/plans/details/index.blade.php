@extends('adminlte::page')
@section('title',"Detalhes do plano {$plan->name}")
@section('content_header')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('plans.index') }}">Planos</a></li>
    <li class="breadcrumb-item"><a href="{{ route('plans.show', $plan->url) }}">{{ $plan->name }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('details.plan.index', $plan->url) }}">Detalhes</a></li>
</ol>
<h1>Detalhes do plano - <strong>{{ $plan->name }}</strong> <a href="{{ route('details.plan.create',$plan->url) }}" class="btn btn-dark"><i class="fas fa-plus-square"></i></a></h1>
@stop
@section('content')
<div class="card">
    <div class="card-body">
        @include('admin.includes.alerts')
        <table class="table table-condensed">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th style="text-align: right;">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($details as $detail)
                <tr>
                    <td>{{ $detail->name }}</td>
                    <td style="text-align: right;">
                        <a href="{{ route('details.plan.edit',[$detail->id,$plan->url]) }}" class="btn btn-info">EDITAR</a>
                        <a href="{{ route('details.plan.show',[$detail->id,$plan->url]) }}" class="btn btn-warning">VER</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="2">Nenhum dado cadastrado!</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        @if(isset($filters))
        {{ $details->appends($filters)->links() }}
        @else
        {{ $details->links() }}
        @endif
    </div>
</div>
@stop