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
