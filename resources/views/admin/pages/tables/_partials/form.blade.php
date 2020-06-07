@include('admin.includes.alerts')
<div class="form-group">
    <label>Identificação:</label>
    <input type="text" name="identify" class="form-control" placeholder="Identificação" value="{{ $data->identify ?? old('identify') }}">
</div>
<div class="form-group">
    <label>Descrição:</label>
    <textarea name="description" class="form-control" placeholder="Descrição" cols="30" rows="5">{{ $data->description ?? old('description') }}</textarea>
</div>