<?php
require '../../model/model_usuario.php';

$MU = new model_usu(); //Instaciamos

$consultar = $MU->listar_usuario();

if (count($consultar) > 0) {
    echo json_encode($consultar);
} else {
    echo '{
       "sEcho": 1,
       "iTotalRecords":"0",
       "iTotalDisplayRecords":"0",
       "aaData":[]
   }';
}
