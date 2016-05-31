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
        /*
        $this->load->database();
        $this->load->model('usuario_model', 'usuario');
        
        $this->usuario->nome = 'Rafael Wendel Pinheiro';
        $this->usuario->email = 'professor@rafaelwendel.com';
        $this->usuario->usuario = '130266';
        $this->usuario->senha = md5('123456');
        $this->usuario->token = md5(date('YmdHis'));
        
        if($this->usuario->insert()){
            echo 'Usuario criado <br>';
        }
        else{
            echo 'Erro...';
        }        
        
        
       $this->load->model('app_model', 'app');
       $this->app->nome_app = 'Auth Center';
       $this->app->url_app = 'http://localhost/ifcpv-auth-center';
       $this->app->token_app = md5(date('YmdHis'));
       
       if($this->app->insert()){
           echo 'App criada <br>';
       }
       else{
           echo 'Erro...';
       }
       */
       $this->load->model('usuarioapp_model', 'usuario_app');
       $this->usuario_app->usuario_id = 1;
       $this->usuario_app->app_id = 1;
       $this->usuario_app->perfil = 'Master';
       
       if($this->usuario_app->insert()){
           echo 'Usuario App criada <br>';
       }
       else{
           echo 'Erro...';
       }
    }
    
}
