<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of Docente_model
 *
 * @author Rafael W. Pinheiro
 */
class Docente_model extends CI_Model {
    
    public $iddocente;
    public $nome;
    public $slug;
    public $email;
    public $perfil;
    public $usuario;
    public $senha;
    public $token;
    public $foto;
    public $curriculo;
    public $titulacao;
    public $descricao;
                
    
    public function __construct() 
    {
        parent::__construct();
    }
    
    public function insertBatch($list)
    {
        $verifica = $this->verificarDuplicidade($list, array('usuario'));
        if(is_array($verifica['validos']) && count($verifica['validos']) > 0){
            $this->db->insert_batch('docente', $verifica['validos']);
        }        
        return $verifica;
    }

    public function update($docente)
    {
        return $this->db->update('docente', $docente, array('iddocente' => $docente->iddocente));
    }
    
    public function autenticar()
    {
        return  $this->db
                ->select('nome, perfil, token')
                ->from('docente d')
                ->where('usuario', $this->usuario)
                ->where('senha', $this->senha)
                ->get()
                ->row_object();
    }
    
    public function getAll()
    {
        return $this->db->get('docente')->result();
    }
    
    public function getByOne($param, $value, $fields = '*')
    {
        return  $this->db
                ->select($fields)
                ->from('docente d')
                ->where($param, $value)
                ->get()
                ->row_object();
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
        $result = $this->db->select($param)->from('docente d')->get()->result_array();
        $array = array();
        
        foreach ($result as $res){
            $array[] = $res[$param];
        }
        
        return $array;
    }
}
