<?php
require '../../model/model_accion.php';

$MU = new model_acci(); //Instaciamos
$id=intval($_POST['id']);

$consultar = $MU->listar_acciones_inci($id);
error_log($id);
if (count($consultar) > 0) {
    error_log("data no vacia");
    echo json_encode($consultar);
} else {
        echo '{
        "sEcho": 1,
        "iTotalRecords":"0",
        "iTotalDisplayRecords":"0",
        "aaData":[]
    }';
    }
