@extends('adminlte::page')
@section('title','Planos')
@section('content_header')
<h1>{{ trans('cruds.plans.edit') }}</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('plans.update', $data->url) }}" class="form" method="POST">
            @csrf
            @method('PUT')
            @include('admin.pages.plans._partials.form')
        </form>
    </div>
</div>
@stop