<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of Api
 *
 * @author Rafael W. Pinheiro
 */

require_once APPPATH . '/libraries/REST_Controller.php';

class Api extends REST_Controller {
    
    public function __construct() {
        parent::__construct();

        $this->load->model('docente_model', 'docente');
    }
    
    public function docentes_get($slug = NULL)
    {
        $fields = 'nome, email, foto, curriculo, titulacao, descricao';
        $resp = $this->docente->getByOne('slug', $slug, $fields);
        
        if(count($resp) > 0){
            $resp->foto = (!is_null($resp->foto) && file_exists('./assets/fotos/' . $resp->foto) ? base_url('assets/fotos/' . $resp->foto) : base_url('assets/img/profile-default.png'));        
        }
    
        $this->display($resp);
    }
    
    protected function display($resp)
    {
        $data = array();
        if(count($resp) > 0){
            $data['code'] = 200;
            $data['status'] = 'success';
            $data['data'] = $resp;
        }
        $this->response($data);
    }
}
