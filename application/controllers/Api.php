<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of Api
 *
 * @author Rafael W. Pinheiro
 */

require_once APPPATH . '/libraries/REST_Controller.php';

class Api extends REST_Controller {
    
    public function __construct() {
        parent::__construct();

        $this->load->model('usuario_model', 'usuario');
        $this->load->model('app_model', 'app');
    }
    
    public function auth_post($token_app = NULL)
    {
        $data = array();
        
        if($token_app == NULL){
            $data['code'] = 401;
            $data['message'] = 'Empty Token APP';
            $data['status'] = 'error';
            $data['data'] = 'UnauthorizedException';
            
            $this->response($data);
        }
        
        if(!$this->app->validar_token($token_app)){
            $data['code'] = 401;
            $data['message'] = 'Token APP is invalid';
            $data['status'] = 'error';
            $data['data'] = 'UnauthorizedException';
            
            $this->response($data);
        }
        
        $this->usuario->usuario = $this->post('usuario');
        $this->usuario->senha = md5($this->post('senha'));
        $resp = $this->usuario->autenticar($token_app);
        
        if(!$resp){
            $data['code'] = 401;
            $data['message'] = 'User credentials are invalids';
            $data['status'] = 'error';
            $data['data'] = 'UnauthorizedException';
            
            $this->response($data);
        }
        else{
            $data['code'] = 200;
            $data['status'] = 'success';
            $data['data'] = $resp;
            
            $this->response($data);            
        }
    }
    
    protected function display($resp)
    {
        $data = array();
        if(count($resp) > 0){
            $data['code'] = 200;
            $data['status'] = 'success';
            $data['data'] = $resp;
        }
        $this->response($data);
    }
}
