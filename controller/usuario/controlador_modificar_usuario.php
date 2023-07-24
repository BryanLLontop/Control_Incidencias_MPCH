<?php
require '../../model/model_usuario.php';
$ruta = "";
$MU = new model_usu();
$id = intval(htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8'));
$dni =  htmlspecialchars($_POST['dni'], ENT_QUOTES, 'UTF-8');
$nombre =  mb_strtoupper(htmlspecialchars($_POST['nombre'], ENT_QUOTES, 'UTF-8'));
$telefono = htmlspecialchars($_POST['telefono'], ENT_QUOTES, 'UTF-8');
//$contra =  htmlspecialchars($_POST['password'], PASSWORD_DEFAULT, ['cost' => 12]);
$sector =  mb_strtoupper(htmlspecialchars($_POST['sector'], ENT_QUOTES, 'UTF-8'));

$tipo = intval(htmlspecialchars($_POST['tipo'], ENT_QUOTES, 'UTF-8'));
$area = intval(htmlspecialchars($_POST['area'], ENT_QUOTES, 'UTF-8'));

$consulta = $MU->modificar_usuario($id,$dni, $nombre, $telefono, $sector, $tipo, $area);
echo $consulta;
