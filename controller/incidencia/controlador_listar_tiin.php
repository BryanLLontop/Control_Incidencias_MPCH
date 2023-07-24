<?php
require '../../model/model_incidencia.php';

$MU = new model_inci(); //Instaciamos

$consultar = $MU->listar_tipos_incidencia();

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

