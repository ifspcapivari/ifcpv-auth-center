<li>
    <a href="<?php echo base_url('home') ?>" <?php echo (!$active || $active == 'home' ? 'class="active"' : '') ?>>Dados Pessoais</a>
</li>
<li>
    <a href="<?php echo base_url('usuarios') ?>" <?php echo (!$active || $active == 'usuarios' ? 'class="active"' : '') ?>>Usuários</a>
</li>
<li>
    <a href="<?php echo base_url('grupos') ?>" <?php echo (!$active || $active == 'grupos' ? 'class="active"' : '') ?>>Grupos</a>
</li>
<li>
    <a href="<?php echo base_url('app') ?>" <?php echo (!$active || $active == 'app' ? 'class="active"' : '') ?>>Aplicações</a>
</li>