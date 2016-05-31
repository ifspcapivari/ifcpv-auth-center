<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Install
 *
 * @author rafael
 */
class Install extends CI_Controller {
    
    public function __construct() 
    {
        parent::__construct();
    }
    
    public function index()
    {
        $this->load->database();
        $this->load->model('usuario_model', 'usuario');
        
        $this->usuario->nome = 'Rafael Wendel Pinheiro';
        $this->usuario->email = 'professor@rafaelwendel.com';
        $this->usuario->usuario = '130266';
        $this->usuario->senha = md5('123456');
        $this->usuario->token = md5(date('YmdHis'));
        
        if($this->usuario->insert()){
            echo 'Instalado com sucesso';
        }
        else{
            echo 'Erro...';
        }
    }
    
}
