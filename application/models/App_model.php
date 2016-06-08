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
        $this->generateToken();
        return $this->db->insert('app', $this);
    }
    
    private function generateToken()
    {
        $this->token_app = md5(HASH_SYSTEM . date('YmdHis'));
    }
    
    public function getAll($with_count = false)
    {
        if($with_count == false){
            return $this->db->get('app')->result();
        }
        else{
            return  $this->db->select('id, nome_app, descricao_app, url_app, token_app, count(ua.usuario_id) as num_usuarios')
                    ->from('app a')
                    ->join('usuario_app ua', 'a.id = ua.app_id', 'left')
                    ->group_by('id')
                    ->get()
                    ->result();
        }
    }
    
    public function getByOne($param, $value, $fields = '*')
    {
        return  $this->db
                ->select($fields)
                ->from('app a')
                ->where($param, $value)
                ->get()
                ->row_object();
    }
    
    public function validar_token($token_app)
    {
        return is_object($this->getByOne('token_app', $token_app, 'id')) ? true : false;
    }
}
