<?php

/* Vai ler o arquivo CSV $file e retornar um array para ser inserido por batch no DB
 * Nome | Email | Usuario | Senha
 * 
*/
function importar($file)
{    
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
            'email'   => $data[1],
            'usuario' => $data[2],
            'senha'   => md5($data[3]),
            'token'   => md5($data[2] . date('YmdHis') . microtime(true))
        );
        $list[] = $reg;
        usleep(50);//delay para que seja gerado um token diferente
    }
    fclose($pont);
    return $list;
}
