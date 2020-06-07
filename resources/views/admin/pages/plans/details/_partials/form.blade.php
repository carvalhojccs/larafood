@include('admin.includes.alerts')
@csrf
<div class="form-group">
    <label>Nome:</label>
    <input type="text" class="form-control" name="name" placeholder="Nome" value="{{ $detail->name ?? old('name') }}">
</div>
<div class="form-group">
    <button type="submit" class="btn btn-info">Enviar</button>
</div>