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
    
    public function insert()
    {
        return $this->db->insert('usuario_app', $this);
    }
}
