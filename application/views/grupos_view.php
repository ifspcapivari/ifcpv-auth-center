<h1>Gerenciar Grupos</h1>
<br />
<?php echo display_flash_var('msg', '<div class="alert alert-danger">{{$var}}</div>') ?>
<br />
<button type="button" class="btn btn-default" data-toggle="modal" data-target="#modalFormGrupo" title="Clique para adicionar um novo grupo">
            + Grupo
</button>
<br /><br />
    <?php echo $tabela ?>

<!-- Modal Form Grupos -->
<div class="modal fade" id="modalFormGrupo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Adicionar Novo grupo</h4>
      </div>
        <form method="post" action="<?php echo base_url('grupos/add') ?>">
            <div class="modal-body">
                <div class="form-group">
                    <label for="nome_grupo">Nome do Grupo:</label>
                    <input type="text" class="form-control" id="nome_grupo" name="nome_grupo" placeholder="Nome do Grupo">
                </div>
                <div class="form-group">
                    <label for="descricao_grupo">Descrição para esse grupo:</label>
                    <textarea class="form-control" id="descricao_grupo" name="descricao_grupo" placeholder="Descrição do Grupo"></textarea>
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