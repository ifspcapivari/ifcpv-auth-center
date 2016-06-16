<h1>Dados Pessoais</h1>
    <br />
    <?php echo display_flash_var('msg', '<div class="alert alert-danger">{{$var}}</div>') ?>
    <br />
    <div class="form-group">
        <label for="nome">Nome:</label>
        <input type="text" class="form-control" id="nome" value="<?php echo $usuario->nome ?>" readonly>
    </div>
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" id="email" value="<?php echo $usuario->email ?>" readonly>
    </div>
    <div class="form-group">
        <label for="perfil">Perfil:</label>
        <input type="text" class="form-control" id="perfil" value="<?php echo $this->session->perfil ?>" readonly>
    </div>
    <div class="form-group">
        <label for="usuario">Usuário:</label>
        <input type="text" class="form-control" id="usuario" value="<?php echo $usuario->usuario ?>" readonly>
    </div>
    <div class="form-group">
        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalSenha" title="Clique para alterar sua senha de acesso ao SigProf">
            Alterar Senha
        </button>
    </div>

<!-- Modal Senha -->
<div class="modal fade" id="modalSenha" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Alterar Senha</h4>
      </div>
        <form method="post" action="<?php echo base_url('home/changepass') ?>">
            <div class="modal-body">
                <div class="form-group">
                    <label for="senha">Nova Senha:</label>
                    <input type="password" class="form-control" id="senha" name="senha" placeholder="Nova Senha">
                </div>
                <div class="form-group">
                    <label for="confirmarSenha">Confirmar Senha:</label>
                    <input type="password" class="form-control" id="confirmarSenha" name="confirmarsenha" placeholder="Confirmar Senha Senha">
                </div>
            </div>
            <div class="modal-footer">
                 <button type="submit" class="btn btn-success">Alterar Senha</button>
                 <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            </div>
        </form>
    </div>
  </div>
</div>