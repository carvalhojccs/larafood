@extends('adminlte::page')

@section('title','Planos')

@section('content_header')
<h1>Detalhes do plano <b>{{ $data->name }}</b></h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <ul>
            <li>
                <strong>Nome: </strong>{{ $data->name }}
            </li>
            <li>
                <strong>Url: </strong>{{ $data->url }}
            </li>
            <li>
                <strong>Preço: </strong>R$ {{ number_format($data->price,2,',','.') }}
            </li>
            <li>
                <strong>Descrição: </strong>{{ $data->description }}
            </li>
            <li>
                <strong>Cadastrado em: </strong>{{ $data->created_at->format('d/m/Y') }}
            </li>
        </ul>
        @include('admin.includes.alerts')
    </div>
    <div class="card-footer">
        <form action="{{ route('plans.destroy', $data->url) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">DELETAR</button>
        </form>
    </div>
</div>
@stop