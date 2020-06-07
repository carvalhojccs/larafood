@extends('adminlte::page')
@section('title','Detalhes da empresa')
@section('content_header')
<div class="container-fluid border-bottom">
    <div class="row mb-2">
        <div class="col-sm-6">
            Detalhes da empresa
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('tenants.index') }}">Empresas</a></li>
                <li class="breadcrumb-item active"><a href="#">Detalhes</a></li>
            </ol>
        </div>
    </div>
</div>
@stop
@section('content')
<div class="row">
    <div class="col-md-7">
    <div class="card">
    <div class="card-body">
        <form class="form-horizontal">
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Plano</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" value="{{ $data->plan->name }}" disabled>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nome</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" value="{{ $data->name }}" disabled>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">URL</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" value="{{ $data->url }}" disabled>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" value="{{ $data->email }}" disabled>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">CNPJ</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" value="{{ $data->cnpj }}" disabled>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Ativo</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" value="{{ $data->active == 'Y' ? 'SIM' : 'NÃO' }}" disabled>
                </div>
            </div>
            
        </form>
    </div>
    <div class="card-footer">
        <form action="{{ route('tenants.destroy', $data->id) }}" id="formDestroy" method="POST">
            @csrf
            @method('DELETE')
            <a href="{{ route('tenants.index') }}" class="btn btn-info btn-sm"><i class="fas fa-reply">&nbsp;</i>Voltar</a>
            <a href="{{ route('tenants.edit',$data->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit">&nbsp;</i>Editar</a>
            <button type="submit" class="btn btn-danger btn-sm float-sm-right" id="btnDeletar"><i class="fas fa-trash">&nbsp;</i>Deletar</button>
        </form>
    </div>
</div>
</div>
<div class="col-md-5">
    <div class="card">
        <div class="card-body">
            <form class="form-horizontal">
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Assinatura</label>
                    <div>
                        <input type="text" class="form-control" value="{{ $data->subscription }}" disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Expira</label>
                    <div>
                        <input type="text" class="form-control" value="{{ $data->expires_at }}" disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Identificador</label>
                    <div>
                        <input type="text" class="form-control" value="{{ $data->subscription_id }}" disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Ativo</label>
                    <div>
                        <input type="text" class="form-control" value="{{ $data->subscription_active ? 'SIM' : 'NÃO' }}" disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Cancelou</label>
                    <div>
                        <input type="text" class="form-control" value="{{ $data->subscription_suspended ? 'SIM' : 'NÃO' }}" disabled>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
@stop
@section('js')
    <script src="{{ asset('includes/js/confirm.delete.js') }}"></script>
@stop