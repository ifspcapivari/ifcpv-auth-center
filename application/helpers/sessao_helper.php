<?php

function validar_sessao(CI_Session $session, $params, $redirect)
{
    if(!is_array($params)){
        return false;
    }
    $validar = true;
    foreach ($params as $param){
        if(is_null($session->$param)){
            $validar = false;
        }
    }
    if($validar === false){
        redirect($redirect);
    }
}

