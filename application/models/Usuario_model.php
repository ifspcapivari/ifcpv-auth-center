<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of Usuario_model
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
    
    public function autenticar()
    {
        return  $this->db
                ->select('nome, token, perfil')
                ->from('usuario u')
                ->join('usuario_app ua', 'u.id = ua.usuario_id')
                ->join('app a', 'ua.app_id = a.id')
                ->where('usuario', $this->usuario)
                ->where('senha', $this->senha)
                ->get()
                ->row_object();
    }
}
