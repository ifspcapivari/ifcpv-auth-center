<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Usuarios
 *
 * @author Rafael W. Pinheiro
 */
class Usuarios extends CI_Controller {
    
    protected $_template = 'template';
    
    public function __construct() 
    {
        parent::__construct();
        validar_sessao($this->session, array('token', 'perfil'), 'login');
        $this->load->model('usuario_model', 'usuario');
    }
    
    public function index()
    {
        $result = $this->usuario->getAll();
        
        $this->load->library('table');
        $this->table->set_template(array('table_open' => '<table class="table table-bordered table-hover">'));
        $this->table->set_heading(array('Nome', 'Email', 'Usuário', ''));
        
        if(count($result)){
            foreach ($result as $res){
                $this->table->add_row($res->nome, $res->email, $res->usuario, '<a href="'. base_url('usuarios/delete/' . $res->id) .'" class="btn btn-primary btn-sm excluir">Excluir</a>');
            }
        }
        
        $dados['tabela'] = $this->table->generate();
        $dados['active'] = 'usuarios';
        $this->template->load($this->_template, 'usuarios_view', $dados);
    }
    
    public function add()
    {
        if($this->input->post()){
            $this->usuario->nome = $this->input->post('nome');
            $this->usuario->email = $this->input->post('email');
            $this->usuario->usuario = $this->input->post('usuario');
            $this->usuario->senha = $this->input->post('senha');
            
            if($this->usuario->insert()){
                $this->session->set_flashdata('msg', 'Usuário <strong>' . $this->usuario->nome . '</strong> criado com sucesso');
            }
            else{
                $this->session->set_flashdata('msg', 'Erro ao criar usuário');
            }
        }
        redirect('usuarios');
    }
    
    public function import_list()
    {
        $config['upload_path'] = './assets/imports/';
        $config['file_name'] = 'CSV_' . date('YmdHis');
        $config['overwrite'] = TRUE;
        $config['allowed_types'] = 'csv';
        
        $this->load->library('upload', $config);
        if($this->upload->do_upload('arquivo')){
            //Fez o upload
            $dados_up = $this->upload->data();
            
            $this->load->helper('importarusuario');
            $list = importar($dados_up['full_path']);
                        
            try{
               $res = $this->usuario->insertBatch($list); 
               $this->session->set_flashdata('msg', 'Lista importada com sucesso');
               $this->session->set_flashdata('importados', $res['validos']);
               $this->session->set_flashdata('duplicados', $res['duplicados']);
            } catch (Exception $ex) {
                $this->session->set_flashdata('msg', $ex->getMessage());
            }
            
            //Excluir o arquivo CSV
            unlink($dados_up['full_path']);
        }
        else{
            $this->session->set_flashdata('msg', 'Erro ao fazer o upload do arquivo CSV (' . $this->upload->display_errors() . ')');
        }
        redirect('usuarios');
    }
}
