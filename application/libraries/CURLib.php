<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CURLib Class
 *
 * Easy HTTP Requests
 *
 * @author          Rafael W. Pinheiro
 */
class Curlib {
    
    private $_url;
    private $_type; 
    private $_data;
    
    public function __construct() 
    {
        $this->_type = 'get';
    }
    
    public function setUrl($url)
    {
        $this->_url = $url;
    }
    
    public function setType($type)
    {
        $this->_type = strtolower($type);
    }
    
    public function setPostParams($data = array())
    {
        $this->_data = $data;
    }
    
    public function execute()
    {
        $ch   = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, $this->_url);
        
        if($this->_type == 'post'){
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $this->_data);
        }
        
        $result = curl_exec($ch);

        curl_close($ch);
        
        return $result;
    }
    
}
