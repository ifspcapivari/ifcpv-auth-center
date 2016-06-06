<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of Grupo_model
 *
 * @author Rafael W. Pinheiro
 */
class Grupo_model extends CI_Model {
    
    public $id;
    public $nome_grupo;
    public $descricao_grupo;
    
    public function __construct() {
        parent::__construct();
    }
    
    public function insert()
    {
        return $this->db->insert('grupo', $this);
    }
    
    public function delete($id)
    {
        /* Verificar se não há usuários associados ao grupo */
        $ci =& get_instance();
        $ci->load->model('usuario_model', 'usuario');
        
        if(count($ci->usuario->getUsuarioByGrupo($id))){
            throw new Exception("Esse grupo não pode ser excluído pois "
                    . "existem usuários associados a ele");
        }
        
        if(!$this->db->delete('grupo', array('id' => $id))){
            throw new Exception("Erro ao excluir grupo");
        } 
    }
    
    public function getAll($with_count = false)
    {
        if($with_count == false){
            return $this->db->get('grupo')->result();
        }
        else{
            return  $this->db->select('id, nome_grupo, descricao_grupo, count(ug.usuario_id) as num_usuarios')
                    ->from('grupo g')
                    ->join('usuario_grupo ug', 'g.id = ug.grupo_id')
                    ->group_by('id')
                    ->get()
                    ->result();
        }
    }
    
    public function getByOne($param, $value, $fields = '*')
    {
        return  $this->db
                ->select($fields)
                ->from('grupo g')
                ->where($param, $value)
                ->get()
                ->row_object();
    }
        
}
