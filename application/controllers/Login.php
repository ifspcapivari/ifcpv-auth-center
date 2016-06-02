<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Login
 *
 * @author Rafael W. Pinheiro
 */
class Login extends CI_Controller {
    
    protected $_template = 'template';
    
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('usuario_model', 'usuario');
        $this->template->set('desabilitarmenu', true);
    }
    
    public function index()
    {
        if($this->input->post()){
            $this->usuario->usuario = $this->input->post('usuario');
            $this->usuario->senha = md5($this->input->post('senha'));
            $retorno = $this->usuario->autenticar(TOKEN_APP);
            
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
        $this->template->load($this->_template, 'login_view');
    }
}
