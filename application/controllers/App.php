<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of App
 *
 * @author rafael
 */
class App extends CI_Controller {
    
    protected $_template = 'template';
    
    public function __construct() 
    {
        parent::__construct();
        validar_sessao($this->session, array('token', 'perfil'), 'login');
        $this->load->model('app_model', 'app');
    }
    
    public function index()
    {
        $result = $this->app->getAll();
        
        $this->load->library('table');
        $this->table->set_template(array('table_open' => '<table class="table table-bordered table-hover">'));
        $this->table->set_heading(array('Nome', 'URL', 'Token', ''));
        
        if(count($result)){
            foreach ($result as $res){
                $this->table->add_row($res->nome_app, $res->url_app, $res->token_app, '<a href="'. base_url('app/delete/' . $res->id) .'" class="btn btn-primary btn-sm excluir">Excluir</a>');
            }
        }
        
        $dados['tabela'] = $this->table->generate();
        $dados['active'] = 'app';
        $this->template->load($this->_template, 'app_view', $dados);
    }
}
