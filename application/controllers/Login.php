<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Home
 *
 * @author Rafael W. Pinheiro
 */
class Login extends CI_Controller {
    
    protected $_template = 'template';
    
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('docente_model', 'docente');
        $this->template->set('desabilitarmenu', true);
    }
    
    public function index()
    {
        if($this->input->post()){
            $this->docente->usuario = $this->input->post('usuario');
            $this->docente->senha = md5($this->input->post('senha'));
            $retorno = $this->docente->autenticar();
            
            if(isset($retorno)){
                $user_data = array(
                    'token' => $retorno->token,
                    'perfil' => $retorno->perfil
                );
                $this->session->set_userdata($user_data);
                redirect('home');
            }            
            else{
                $this->session->set_flashdata('msg', 'Usuário e/ou senha incorretos');
                redirect('login');
            }
        }
        $dados['msg'] = $this->session->flashdata('msg');
        $this->template->load($this->_template, 'login_view', $dados);
    }
    
    public function teste()
    {
        $this->docente->usuario = '13026';
        $this->docente->senha = md5('123');
        
        $doc = $this->docente->autenticar();
        print_r($doc);
    }
}
