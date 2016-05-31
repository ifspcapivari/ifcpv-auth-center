<?php

/* Vai ler o arquivo CSV $file e retornar um array para ser inserido por batch no DB*/
function importar($file)
{
    //Requer o slug_helper
    $ci =& get_instance();
    $ci->load->helper('slug');
    
    $pont = fopen($file, 'r');
    $list = array();
    $cont = 0;
    
    while($data = fgetcsv($pont, 1000, ";")){
        if($cont == 0){
            $cont++;
            continue;
        }
        $reg = array(
            'nome'    => $data[0],
            'slug'    => url_slug($data[0]),
            'email'   => $data[1],
            'perfil'  => 'Docente',
            'usuario' => $data[2],
            'senha'   => md5('123456'),
            'token'   => md5(date('YmdHis') . microtime(true))
        );
        $list[] = $reg;
        usleep(10);//delay para que seja gerado um token diferente
    }
    fclose($pont);
    return $list;
}
