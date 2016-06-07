<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of App_model
 *
 * @author Rafael W. Pinheiro
 */
class App_model extends CI_Model {
    public $id;
    public $nome_app;
    public $descricao_app;
    public $url_app;
    public $token_app;
    
    public function __construct() 
    {
        parent::__construct();
    }
    
    public function insert()
    {
        return $this->db->insert('app', $this);
    }
    
    public function getAll()
    {
        return $this->db->get('app')->result();
    }
}
