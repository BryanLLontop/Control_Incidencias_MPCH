<?php
require '../../model/model_incidencia.php';
session_start();
$MU = new model_inci(); //Instaciamos
$estado = $_POST['estatus'];
$tipoinci="";
$valor="";
//$consultar = $MU->listar_incidencias_sector($_SESSION['S_SECTOR_TP']);
if($_SESSION['S_ROL_TP']=="ADMIN" || $_SESSION['S_ROL_TP']=="VISITANTE"){
    $tipoinci="ADMIN";
    $valor="";
}else if($_SESSION['S_ROL_TP']=="OPERARIO"){
    $tipoinci="OPERARIO";
    $valor=$_SESSION['S_AREA_TP'];
}else if($_SESSION['S_ROL_TP']=="CIUDADANO"){
    $tipoinci="CIUDADANO";
    $valor=$_SESSION['S_SECTOR_TP'];
};
$consultar = $MU->listar_incidencias($tipoinci,$valor,$estado);
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
