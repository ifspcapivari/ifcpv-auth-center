<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of Usuariogrupo_model
 *
 * @author Rafael W. Pinheiro
 */
class Usuariogrupo_model extends CI_Model {
    
    public $usuario_id;
    public $grupo_id;
    
    public function __construct() {
        parent::__construct();
    }
    
    public function insert($grupo_id, $list_usuarios)
    {
        $this->grupo_id = $grupo_id;
        
        if(count($list_usuarios) > 0){
            foreach ($list_usuarios as $usuario_id){
                $this->usuario_id = $usuario_id;
                if(!$this->db->insert('usuario_grupo', $this)){
                    return false;
                }
            }
        }
        return true;
    }
    
    public function delete($grupo_id, $list_usuarios){
        $this->grupo_id = $grupo_id;
        
        if(count($list_usuarios) > 0){
            foreach ($list_usuarios as $usuario_id){
                $this->usuario_id = $usuario_id;
                if(!$this->db->delete('usuario_grupo', array('usuario_id' => $usuario_id))){
                    return false;
                }
            }
        }
        return true;
    }
        
}
