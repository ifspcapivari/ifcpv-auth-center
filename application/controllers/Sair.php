<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Sair
 *
 * @author Rafael W. Pinheiro
 */
class Sair extends CI_Controller{
    
    public function __construct() 
    {
        parent::__construct();
    }
    
    public function index()
    {
        $userdata = array('token', 'perfil');
        $this->session->unset_userdata($userdata);
        
        $this->session->set_flashdata('msg', 'Logoff efetuado com sucesso');
        redirect('login');
    }
}
