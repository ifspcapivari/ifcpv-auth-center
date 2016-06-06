<h1>Gerenciar Usuários do grupo "<?php echo $grupo->nome_grupo ?>"</h1>
<br />
<?php echo display_flash_var('msg', '<div class="alert alert-danger">{{$var}}</div>') ?>
<br /><br />
<form method="post" action="<?php echo base_url('grupos/acao_grupos') ?>">
<input type="hidden" name="id" value="<?php echo $grupo->id ?>" />
<div class="col-lg-3">
    <p>Usuários Disponíveis</p>
    <?php echo $combo_usuarios_available ?>
</div>
<div class="col-lg-2">
    <p>Ações</p>
    <button type="submit" name="action" value="Adicionar" class="btn btn-default">> Adicionar</button>
    <button type="submit" name="action" value="Remover" class="btn btn-default">< Remover</button>
</div>
<div class="col-lg-3">
    <p>Usuários do grupo <?php echo $grupo->nome_grupo ?></p>
    <?php echo $combo_usuarios_grupo ?>
</div>        
</form>
