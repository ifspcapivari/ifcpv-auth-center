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
        $result = $this->grupo->getAll();
        
        $this->load->library('table');
        $this->table->set_template(array('table_open' => '<table class="table table-bordered table-hover">'));
        $this->table->set_heading(array('Grupo', 'Descrição', ''));
        
        if(count($result)){
            foreach ($result as $res){
                $this->table->add_row($res->nome_grupo, $res->descricao_grupo, '<a href="'. base_url('grupos/delete/' . $res->id) .'" class="btn btn-primary btn-sm excluir">Excluir</a>');
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
    
}
