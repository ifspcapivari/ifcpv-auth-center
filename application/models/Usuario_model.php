<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of Docente_model
 *
 * @author Rafael W. Pinheiro
 */
class Usuario_model extends CI_Model {
    public $id;
    public $nome;
    public $email;
    public $usuario;
    public $senha;
    public $token;
    
    public function __construct() 
    {
        parent::__construct();
    }
    
    public function insert()
    {
        return $this->db->insert('usuario', $this);
    }
}
