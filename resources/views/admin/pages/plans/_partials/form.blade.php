@include('admin.includes.alerts')
<div class="form-group">
    <label>{{ trans('cruds.plans.fields.name') }}:</label>
    <input type="text" name="name" class="form-control" value="{{ $data->name ?? '' }}">
</div>
<div class="form-group">
    <label>{{ trans('cruds.plans.fields.price') }}:</label>
    <input type="text" name="price" class="form-control" value="{{ $data->price ?? ''}}">
</div>
<div class="form-group">
    <label>{{ trans('cruds.plans.fields.description') }}:</label>
    <input type="text" name="description" class="form-control" value="{{ $data->description ?? '' }}">
</div>
<div class="form-group">
    <button type="submit" class="btn btn-dark">Enviar</button>
</div>