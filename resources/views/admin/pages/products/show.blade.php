@extends('adminlte::page')
@section('title','Detalhes do produto')
@section('content_header')
<div class="container-fluid border-bottom">
    <div class="row mb-2">
        <div class="col-sm-6">
            Detalhes do produto
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Produtos</a></li>
                <li class="breadcrumb-item active"><a href="#">Detalhes</a></li>
            </ol>
        </div>
    </div>
</div>
@stop
@section('content')
<div class="row">
    <div class="col-md-8">
    <div class="card">
    <div class="card-body">
        <form class="form-horizontal">
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Título</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" value="{{ $data->title }}" disabled>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Preço</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" value="R$ {{ number_format($data->price,2,',','.') }}" disabled>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Descrição</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" value="{{ $data->description }}" disabled>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Criado em</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" value="{{ $data->created_at->format('d/m/Y') }}" disabled>
                </div>
            </div>
        </form>
    </div>
    <div class="card-footer">
        <form action="{{ route('products.destroy', $data->id) }}" id="formDestroy" method="POST">
            @csrf
            @method('DELETE')
            <a href="{{ route('products.index') }}" class="btn btn-info btn-sm"><i class="fas fa-reply">&nbsp;</i>Voltar</a>
            <a href="{{ route('products.edit',$data->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit">&nbsp;</i>Editar</a>
            <a href="{{ route('products.categories',$data->id) }}" class="btn btn-dark btn-sm"><i class="fas fa-edit">&nbsp;</i>Categorias</a>
            <button type="submit" class="btn btn-danger btn-sm float-sm-right" id="btnDeletar"><i class="fas fa-trash">&nbsp;</i>Deletar</button>
        </form>
    </div>
</div>
</div>
<div class="col-md-4">
    <div class="card">
        <div class="card-body text-center">
            <img src="{{ asset("storage/$data->image") }}" style="max-width: 200px;">
        </div>
    </div>
</div>
</div>
@stop
@section('js')
    <script src="{{ asset('includes/js/confirm.delete.js') }}"></script>
@stop