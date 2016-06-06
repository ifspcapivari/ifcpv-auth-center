<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Grupos
 *
 * @author Rafael W. Pinheiro
 */
class Grupos extends CI_Controller {
    
    protected $_template = 'template';
    
    public function __construct() 
    {
        parent::__construct();
        validar_sessao($this->session, array('token', 'perfil'), 'login');
        $this->load->model('grupo_model', 'grupo');
    }
    
    public function index()
    {
        $result = $this->grupo->getAll(true);
        
        $this->load->library('table');
        $this->table->set_template(array('table_open' => '<table class="table table-bordered table-hover">'));
        $this->table->set_heading(array('Grupo', 'Descrição', 'Nº Usuários', '', ''));
        
        if(count($result)){
            foreach ($result as $res){
                $this->table->add_row($res->nome_grupo, $res->descricao_grupo, $res->num_usuarios, '<a href="'. base_url('grupos/usuarios/' . $res->id) .'" class="btn btn-primary btn-sm">Gerenciar Usuários</a>', '<a href="'. base_url('grupos/delete/' . $res->id) .'" class="btn btn-primary btn-sm excluir">Excluir</a>');
            }
        }
        
        $dados['tabela'] = $this->table->generate();
        $dados['active'] = 'grupos';
        $this->template->load($this->_template, 'grupos_view', $dados);
    }
    
    public function add()
    {
        if($this->input->post()){
            $this->grupo->nome_grupo = $this->input->post('nome_grupo');
            $this->grupo->descricao_grupo = $this->input->post('descricao_grupo');
            
            if($this->grupo->insert()){
                $this->session->set_flashdata('msg', 'Grupo <strong>' . $this->grupo->nome_grupo . '</strong> inserido com sucesso');
            }
            else{
                $this->session->set_flashdata('msg', 'Erro ao inserir grupo');
            }
        }
        redirect('grupos');
    }
    
    public function delete($id = null)
    {
        if(!is_null($id)){
            try{
                $this->grupo->delete($id);
                $this->session->set_flashdata('msg', "Grupo excluído com sucesso");
            } catch (Exception $ex) {
                $this->session->set_flashdata('msg', $ex->getMessage());
            }
        }
        redirect('grupos');
    }
    
    public function usuarios($id = null)
    {
        if($id == null){
            redirect('grupos');
        }
        
        $dados['grupo'] = $this->grupo->getByOne('id', $id);
        
        $this->load->model('usuario_model', 'usuario');
        
        $usuarios_grupo = $this->usuario->getUsuarioByGrupo($id);
        $usuarios_available = $this->usuario->getUsuarioAvailableForGrupo($id);
        
        $dados['combo_usuarios_grupo'] = multi_select_obj('usuarios_grupo[]', $usuarios_grupo, 'id', 'nome', '', 'class="form-control"');
        $dados['combo_usuarios_available'] = multi_select_obj('usuarios_available[]', $usuarios_available, 'id', 'nome', '', 'class="form-control"');
        
        $dados['active'] = 'grupos';
        $this->template->load($this->_template, 'grupos_usuarios_view', $dados);
    }
    
    public function acao_grupos()
    {
        if($this->input->post()){
            $this->load->model('Usuariogrupo_model', 'usuario_grupo');
            $action = $this->input->post('action');
            $grupo_id = $this->input->post('id');
            
            if($action == 'Adicionar'){
                $usuarios = $this->input->post('usuarios_available');
                if($this->usuario_grupo->insert($grupo_id, $usuarios)){
                    $this->session->set_flashdata('msg', "Usuários adicionados com sucesso");
                }
                else{
                    $this->session->set_flashdata('msg', "Erro ao adicionar usuários");
                }
                redirect('grupos/usuarios/' . $grupo_id);
            }
            else if ($action == 'Remover'){
                $usuarios = $this->input->post('usuarios_grupo');
                if($this->usuario_grupo->delete($grupo_id, $usuarios)){
                    $this->session->set_flashdata('msg', "Usuários removidos com sucesso");
                }
                else{
                    $this->session->set_flashdata('msg', "Erro ao remover usuários");
                }
                redirect('grupos/usuarios/' . $grupo_id);
            }
            else{
                redirect('grupos/usuarios/' . $grupo_id);
            }
        }
        redirect('grupos');
    }
    
}
