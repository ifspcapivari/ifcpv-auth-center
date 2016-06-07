<h1>Gerenciar Aplicações</h1>
<br />
<?php echo display_flash_var('msg', '<div class="alert alert-danger">{{$var}}</div>') ?>
<br />
<button type="button" class="btn btn-default" data-toggle="modal" data-target="#modalFormApp" title="Clique para adicionar uma nova aplicação">
            + Aplicação
</button>
<br /><br />
    <?php echo $tabela ?>

<!-- Modal Form Aplicações -->
<div class="modal fade" id="modalFormApp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Adicionar Nova Aplicação</h4>
      </div>
        <form method="post" action="<?php echo base_url('app/add') ?>">
            <div class="modal-body">
                <div class="form-group">
                    <label for="nome_app">Nome da Aplicação:</label>
                    <input type="text" class="form-control" id="nome_app" name="nome_app" placeholder="Nome da Aplicação">
                </div>
                <div class="form-group">
                    <label for="descricao_app">Descrição para esse grupo:</label>
                    <textarea class="form-control" id="descricao_app" name="descricao_app" placeholder="Descrição da Aplicação"></textarea>
                </div>
                <div class="form-group">
                    <label for="url_app">URL:</label>
                    <input type="text" class="form-control" id="url_app" name="url_app" placeholder="URL da Aplicação">
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