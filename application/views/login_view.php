<h1>Acessar o Auth Center</h1>
<?php echo display_flash_var('msg', '<div class="alert alert-danger">{{$var}}</div>') ?>
<form method="post">
    <div class="form-group">
        <label for="usuario">Usuário:</label>
        <input type="text" class="form-control" name="usuario" id="usuario" placeholder="Usuário">
    </div>
    <div class="form-group">
        <label for="senha">Email:</label>
        <input type="password" class="form-control" name="senha" id="senha" placeholder="Senha">
    </div>
    <button type="submit" class="btn btn-success">Entrar</button>
</form>