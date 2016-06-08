<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of Usuarioapp_model
 *
 * @author Rafael W. Pinheiro
 */
class Usuarioapp_model extends CI_Model {
    public $usuario_id;
    public $app_id;
    public $perfil;
    
    public function __construct() 
    {
        parent::__construct();
    }
    
    public function insert($perfil, $app_id, $list_usuarios)
    {
        $this->perfil = $perfil;
        $this->app_id = $app_id;
        
        if(count($list_usuarios) > 0){
            foreach ($list_usuarios as $usuario_id){
                $this->usuario_id = $usuario_id;
                if(!$this->db->insert('usuario_app', $this)){
                    return false;
                }
            }
        }
        return true;
    }
    
    public function delete($app_id, $list_usuarios){
        $this->app_id = $app_id;
        
        if(count($list_usuarios) > 0){
            foreach ($list_usuarios as $usuario_id){
                $this->usuario_id = $usuario_id;
                if(!$this->db->delete('usuario_app', array('usuario_id' => $usuario_id))){
                    return false;
                }
            }
        }
        return true;
    }
}
