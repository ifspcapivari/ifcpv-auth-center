<?php

function generate_table($result, $atribs, $table_open, $heading = null, $extras = null)
{
    $ci =& get_instance();
    $ci->load->library('table');
    
    $ci->table->set_template(array('table_open' => $table_open));
    
    if(!is_null($heading)){
        $ci->table->set_heading($heading);
    }
}
