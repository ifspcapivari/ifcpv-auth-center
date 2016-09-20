<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of Api
 *
 * @author Rafael W. Pinheiro
 */

require_once APPPATH . '/libraries/REST_Controller.php';

class Api extends REST_Controller {
    
    private $_data;
    
    public function __construct() {
        parent::__construct();

        $this->load->model('usuario_model', 'usuario');
        $this->load->model('app_model', 'app');
    }
    
    private function _validateToken($token_app)
    {
        if($token_app == NULL){
            $this->_data['code'] = 401;
            $this->_data['message'] = 'Empty Token APP';
            $this->_data['status'] = 'error';
            $this->_data['data'] = 'UnauthorizedException';
            
            return false;
        }
        
        if(!$this->app->validar_token($token_app)){
            $this->_data['code'] = 401;
            $this->_data['message'] = 'Token APP is invalid';
            $this->_data['status'] = 'error';
            $this->_data['data'] = 'UnauthorizedException';
            
            return false;
        }
        
        return true;
    }
    
    public function auth_post($token_app = NULL)
    {
        if($this->_validateToken($token_app)){
            $this->usuario->usuario = $this->post('usuario');
            $this->usuario->senha = md5($this->post('senha'));
            $resp = $this->usuario->autenticar($token_app);

            if(!$resp){
                $this->_data['code'] = 401;
                $this->_data['message'] = 'User credentials are invalids';
                $this->_data['status'] = 'error';
                $this->_data['data'] = 'UnauthorizedException';
            }
            else{
                $this->_data['code'] = 200;
                $this->_data['status'] = 'success';
                $this->_data['data'] = $resp;
            }
        }
        $this->response($this->_data);
    }
    
    public function changepass_post($token_app = NULL)
    {
        if($this->_validateToken($token_app)){
            $this->usuario->usuario = $this->post('usuario');
            $this->usuario->senha = md5($this->post('senha'));
            $auth = $this->usuario->autenticar($token_app);
            
            if(!$auth){
                $this->_data['code'] = 401;
                $this->_data['message'] = 'User credentials are invalids';
                $this->_data['status'] = 'error';
                $this->_data['data'] = 'UnauthorizedException';
            }
            else{
                $usuario = $this->usuario->getByOne('token', $auth->token);
                $usuario->senha = md5($this->post('novasenha'));
                if($this->usuario->update($usuario)){
                    $this->_data['code'] = 200;
                    $this->_data['status'] = 'success';
                    $this->_data['data'] = array();
                }
                else{
                    $this->_data['code'] = 401;
                    $this->_data['message'] = 'Update error';
                    $this->_data['status'] = 'error';
                    $this->_data['data'] = 'UnauthorizedException';
                }
            }
        }
        $this->response($this->_data);
    }
    
    public function users_get($token_app = NULL, $token_user = NULL)
    {
        if($this->_validateToken($token_app)){
            $this->load->model('app_model', 'app');
            $app_id = $this->app->getByOne('token_app', $token_app, 'id')->id;
            
            $list_usuarios = $this->usuario->getUsuarioByApp($app_id, $token_user);
            
            $this->_data['code'] = 200;
            $this->_data['status'] = 'success';
            $this->_data['data'] = $list_usuarios;
        }
        $this->response($this->_data);
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
