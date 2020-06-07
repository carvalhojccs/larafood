@include('admin.includes.alerts')
<div class="form-group">
    <label>{{ trans('cruds.products.title') }}:</label>
    <input type="text" name="title" class="form-control" placeholder="Título" value="{{ $data->title ?? old('title') }}">
</div>
<div class="form-group">
    <label>{{trans('cruds.products.price') }}:</label>
    <input type="text" name="price" class="form-control" placeholder="R$ 0.00" value="{{ $data->price ?? old('price') }}">
</div>
<div class="form-group">
    <label>{{trans('cruds.products.image') }}:</label>
    <input type="file" name="image" class="form-control">
</div>
<div class="form-group">
    <label>{{trans('cruds.products.description') }}:</label>
    <textarea name="description" class="form-control" placeholder="Descrição" cols="30" rows="5">{{ $data->description ?? old('description') }}</textarea>
</div>