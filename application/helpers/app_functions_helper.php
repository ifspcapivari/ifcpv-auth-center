<?php

function display_flash_var($var, $display = '')
{
    $ci =& get_instance();
    
    $ci->load->library('session');
    
    if(isset($ci->session->$var)){
        $data = $ci->session->flashdata($var);
        return ($display == '' ? $data : str_replace('{{$var}}', $data, $display));
    }    
}

function get_actual_controller()
{
    $ci =& get_instance();
    return $ci->router->fetch_class();
}

function multi_select_obj($name, $result, $option, $value, $selected, $extra)
{
    $array = array();
    
    if(count($result)){
        foreach ($result as $res){
            $array[$res->$option] =  $res->$value;
        }
    }
    
    $ci =& get_instance();
    $ci->load->helper('form');
    
    return form_multiselect($name, $array, $selected, $extra);
}
