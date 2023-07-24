<?php
require '../../model/model_incidencia.php';
$ruta = "";
$MU = new model_inci();
$id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
$valor = htmlspecialchars($_POST['valor'], ENT_QUOTES, 'UTF-8');

$consulta = $MU->Modificar_Incidencia_Estatus($id, $valor);
echo $consulta;
