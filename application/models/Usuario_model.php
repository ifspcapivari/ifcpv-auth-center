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
        $this->criptografarSenha();
        $this->generateToken();
        return $this->db->insert('usuario', $this);
    }
    
    public function update($usuario)
    {
        return $this->db->update('usuario', $usuario, array('token' => $usuario->token));        
    }
        
    private function generateToken()
    {
        $this->token = md5(date('YmdHis'));
    }
    
    private function criptografarSenha()
    {
        if(isset($this->senha)){
            $this->senha = md5($this->senha);
        }
    }
    
    public function autenticar($token_app)
    {
        if(empty($this->usuario) || empty($this->senha)){
            return false;
        }
        $usuario =  $this->db
                ->select('nome, email, usuario, token, perfil')
                ->from('usuario u')
                ->join('usuario_app ua', 'u.id = ua.usuario_id')
                ->join('app a', 'ua.app_id = a.id')
                ->where('usuario', $this->usuario)
                ->where('senha', $this->senha)
                ->where('token_app', $token_app)
                ->get()
                ->row_object();
        
        return is_object($usuario) ? $usuario : false;
    }
    
    public function insertBatch($list)
    {
        $verifica = $this->verificarDuplicidade($list, array('usuario'));
        if(is_array($verifica['validos']) && count($verifica['validos']) > 0){
            $this->db->insert_batch('usuario', $verifica['validos']);
        }        
        return $verifica;
    }
    
    public function verificarDuplicidade($list, $fields)
    {
        $field = array();
        $duplicados = array();
        
        foreach ($fields as $f){
            $field[$f] = $this->getArrayOf($f);
        }
        
        $x = 0;
        foreach ($list as $data){
            foreach ($data as $key => $value){
                if(in_array($key, $fields)){
                    if(in_array($value, $field[$key])){
                        $duplicados[] = $list[$x];
                        unset($list[$x]);
                    }
                }            
            }
            $x++;
        }
        
        return array('validos' => $list, 'duplicados' => $duplicados);
    }
    
    protected function getArrayOf($param)
    {
        $result = $this->db->select($param)->from('usuario u')->get()->result_array();
        $array = array();
        
        foreach ($result as $res){
            $array[] = $res[$param];
        }
        
        return $array;
    }
    
    public function getByOne($param, $value, $fields = '*')
    {
        return  $this->db
                ->select($fields)
                ->from('usuario u')
                ->where($param, $value)
                ->get()
                ->row_object();
    }
    
    public function getUsuarioByGrupo($grupo_id)
    {
        return  $this->db
                ->select('*')
                ->from('usuario u')
                ->join('usuario_grupo ug', 'u.id = ug.usuario_id')
                ->where('ug.grupo_id', $grupo_id)
                ->get()
                ->result();
    }
    
    //Retorna todos os Usuarios que NÃO fazem parte de um grupo!
    public function getUsuarioAvailableForGrupo($grupo_id)
    {
        return  $this->db
                ->query("SELECT * FROM usuario u WHERE u.id NOT IN (SELECT usuario_id FROM usuario_grupo ug WHERE ug.grupo_id = $grupo_id)")
                ->result();
    }
    
    public function getUsuarioByApp($app_id)
    {
        return  $this->db
                ->select('*')
                ->from('usuario u')
                ->join('usuario_app ua', 'u.id = ua.usuario_id')
                ->where('ua.app_id', $app_id)
                ->get()
                ->result();
    }
    
    //Retorna todos os Usuarios que NÃO fazem parte de um grupo!
    public function getUsuarioAvailableForApp($app_id)
    {
        return  $this->db
                ->query("SELECT * FROM usuario u WHERE u.id NOT IN (SELECT usuario_id FROM usuario_app ua WHERE ua.app_id = $app_id)")
                ->result();
    }
    
    public function getAll()
    {
        return $this->db->get('usuario')->result();
    }
    
    public function __toString() {
        return $this->nome;
    }
}
