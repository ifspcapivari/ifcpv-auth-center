<h1>Gerenciar Usuários</h1>
<br />
<?php echo display_flash_var('msg', '<div class="alert alert-danger">{{$var}}</div>') ?>
<br />
<button type="button" class="btn btn-default" data-toggle="modal" data-target="#modalFormUsuario" title="Clique para adicionar um novo usuário">
            + Usuário
</button>
<button type="button" class="btn btn-default" data-toggle="modal" data-target="#modalImportarLista" title="Clique para importar uma lista de usuários">
            + Importar Lista de Usuários
</button>
<br /><br />
    <?php echo $tabela ?>

<!-- Modal Form Usuarios -->
<div class="modal fade" id="modalFormUsuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Adicionar Novo usuário</h4>
      </div>
        <form method="post" action="<?php echo base_url('usuarios/add') ?>">
            <div class="modal-body">
                <div class="form-group">
                    <label for="descricao">Nome:</label>
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome Completo">
                </div>
                <div class="form-group">
                    <label for="descricao">Email:</label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="Email do Usuário">
                </div>
                <div class="form-group">
                    <label for="descricao">Usuário:</label>
                    <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Nome de usuário">
                </div>
                <div class="form-group">
                    <label for="descricao">Senha:</label>
                    <input type="password" class="form-control" id="senha" name="senha">
                </div>
            </div>
            <div class="modal-footer">
                 <button type="submit" class="btn btn-success">Salvar</button>
                 <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            </div>
        </form>
    </div>
  </div>
</div>
<!-- Modal Importar Lista -->
<div class="modal fade" id="modalImportarLista" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Importar Lista de Usuários</h4>
      </div>
        <form method="post" action="<?php echo base_url('usuarios/import_list') ?>" enctype="multipart/form-data">
            <div class="modal-body">
                <div class="form-group">
                    <label for="foto">Escolha um arquivo no formato CSV:</label>
                    <input type="file" class="form-control" id="arquivo" name="arquivo">
                </div>
            </div>
            <div class="modal-footer">
                 <button type="submit" class="btn btn-success">Enviar</button>
                 <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            </div>
        </form>
    </div>
  </div>
</div>