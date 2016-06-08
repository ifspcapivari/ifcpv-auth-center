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
        $result = $this->app->getAll(true);
        
        $this->load->library('table');
        $this->table->set_template(array('table_open' => '<table class="table table-bordered table-hover">'));
        $this->table->set_heading(array('Nome', 'URL', 'Token', 'Nº Usuários', '', ''));
        
        if(count($result)){
            foreach ($result as $res){
                $this->table->add_row($res->nome_app, $res->url_app, $res->token_app, $res->num_usuarios, '<a href="'. base_url('app/usuarios/' . $res->id) .'" class="btn btn-primary btn-sm">Gerenciar Usuários</a>', '<a href="'. base_url('app/delete/' . $res->id) .'" class="btn btn-primary btn-sm excluir">Excluir</a>');
            }
        }
        
        $dados['tabela'] = $this->table->generate();
        $dados['active'] = 'app';
        $this->template->load($this->_template, 'app_view', $dados);
    }
    
    public function add()
    {
        if($this->input->post()){
            $this->app->nome_app = $this->input->post('nome_app');
            $this->app->descricao_app = $this->input->post('descricao_app');
            $this->app->url_app = $this->input->post('url_app');
            
            if($this->app->insert()){
                $this->session->set_flashdata('msg', 'Aplicação <strong>' . $this->app->nome_app . '</strong> criado com sucesso');
            }
            else{
                $this->session->set_flashdata('msg', 'Erro ao criar aplicação');
            }
        }
        redirect('app');
    }
    
    public function usuarios($id = null)
    {
        if($id == null){
            redirect('app');
        }
        
        $dados['app'] = $this->app->getByOne('id', $id);
        
        $this->load->model('usuario_model', 'usuario');
        
        $usuarios_app = $this->usuario->getUsuarioByApp($id);
        $usuarios_available = $this->usuario->getUsuarioAvailableForApp($id);
        
        $dados['combo_usuarios_app'] = multi_select_obj('usuarios_app[]', $usuarios_app, 'id', 'nome', '', 'class="form-control"');
        $dados['combo_usuarios_available'] = multi_select_obj('usuarios_available[]', $usuarios_available, 'id', 'nome', '', 'class="form-control"');
        
        $dados['active'] = 'app';
        $this->template->load($this->_template, 'app_usuarios_view', $dados);
    }
    
    public function acao_app()
    {
        if($this->input->post()){
            $this->load->model('Usuarioapp_model', 'usuario_app');
            $action = $this->input->post('action');
            $app_id = $this->input->post('id');
            
            if($action == 'Adicionar'){
                $perfil = $this->input->post('perfil');
                $usuarios = $this->input->post('usuarios_available');
                if($this->usuario_app->insert($perfil, $app_id, $usuarios)){
                    $this->session->set_flashdata('msg', "Usuários adicionados com sucesso");
                }
                else{
                    $this->session->set_flashdata('msg', "Erro ao adicionar usuários");
                }
                redirect('app/usuarios/' . $app_id);
            }
            else if ($action == 'Remover'){
                $usuarios = $this->input->post('usuarios_app');
                if($this->usuario_app->delete($app_id, $usuarios)){
                    $this->session->set_flashdata('msg', "Usuários removidos com sucesso");
                }
                else{
                    $this->session->set_flashdata('msg', "Erro ao remover usuários");
                }
                redirect('app/usuarios/' . $app_id);
            }
            else{
                redirect('app/usuarios/' . $app_id);
            }
        }
        redirect('app');
    }
}
