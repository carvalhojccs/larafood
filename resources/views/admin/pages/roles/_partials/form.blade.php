@include('admin.includes.alerts')
<div class="form-group">
    <label>Cargo:</label>
    <input type="text" name="name" class="form-control" placeholder="Nome" value="{{ $data->name ?? old('name') }}">
</div>
<div class="form-group">
    <label>Descrição:</label>
    <textarea name="description" class="form-control" placeholder="Descrição" cols="30" rows="5">{{ $data->description ?? old('description') }}</textarea>
</div>