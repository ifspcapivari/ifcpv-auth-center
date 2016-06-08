<h1>Gerenciar Usuários da Aplicação "<?php echo $app->nome_app ?>"</h1>
<br />
<?php echo display_flash_var('msg', '<div class="alert alert-danger">{{$var}}</div>') ?>
<br /><br />
<form method="post" action="<?php echo base_url('app/acao_app') ?>">
<input type="hidden" name="id" value="<?php echo $app->id ?>" />
<div class="col-lg-3">
    <p>Usuários Disponíveis</p>
    <?php echo $combo_usuarios_available ?>
    <div class="form-group">
        <label for="perfil">Perfil:</label>
        <input type="text" class="form-control" id="perfil" name="perfil" placeholder="Definir um perfil para os usuários selecionados">
    </div>
</div>
<div class="col-lg-2">
    <p>Ações</p>
    <button type="submit" name="action" value="Adicionar" class="btn btn-default">> Adicionar</button>
    <button type="submit" name="action" value="Remover" class="btn btn-default">< Remover</button>
</div>
<div class="col-lg-3">
    <p>Usuários ds aplicação <?php echo $app->nome_app ?></p>
    <?php echo $combo_usuarios_app ?>
</div>        
</form>
