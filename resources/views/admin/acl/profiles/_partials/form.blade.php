<div class="form form-group">
    <label for="name">Nome:</label>
    <input type="text" name="name" class="form-control" id="name" value="{{ $data->name ?? '' }}">
</div>
<div class="form form-group">
    <label for="description">Descrição:</label>
    <input type="text" name="description" class="form-control" id="description" value="{{ $data->description ?? '' }}">
</div>
<div class="form-group">
    <button type="submit" class="bnt btn-dark" id="btnSalvar"><i class="fas fa-save">&nbsp;</i>Salvar</button>
</div>
