<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Home
 *
 * @author Rafael W. Pinheiro
 */
class Home extends CI_Controller {
    
    protected $_template = 'template';
    
    public function __construct() 
    {
        parent::__construct();
        //validar_sessao($this->session, array('token', 'perfil'), 'login');
        //$this->load->model('docente_model', 'docente');
    }
    
    public function index()
    {
        echo 'Hello World!';
    }
}