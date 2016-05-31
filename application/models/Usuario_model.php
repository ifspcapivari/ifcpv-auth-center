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
}
