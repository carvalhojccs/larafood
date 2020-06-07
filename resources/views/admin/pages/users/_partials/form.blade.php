@include('admin.includes.alerts')
<div class="form-group">
    <label>Nome:</label>
    <input type="text" name="name" class="form-control" placeholder="Name" value="{{$data->name ?? ''}}">
</div>
<div class="form-group">
    <label>E-mail:</label>
    <input type="email" name="email" class="form-control" placeholder="E-mail" value="{{$data->email ?? ''}}">
</div>
<div class="form-group">
    <label>Senha:</label>
    <input type="password" name="password" class="form-control" placeholder="Senha">
</div>
