<?php
require '../../model/model_usuario.php';

$MU = new model_usu(); //Instaciamos
$dni =  htmlspecialchars($_POST['dni'], ENT_QUOTES, 'UTF-8');
$nombre =  mb_strtoupper(htmlspecialchars($_POST['nombre'], ENT_QUOTES, 'UTF-8'));
$telefono = htmlspecialchars($_POST['telefono'], ENT_QUOTES, 'UTF-8');
$contra =  password_hash($_POST['contra'], PASSWORD_DEFAULT, ['cost' => 12]);;
$sector =  mb_strtoupper(htmlspecialchars($_POST['sector'], ENT_QUOTES, 'UTF-8'));

$tipo = intval(htmlspecialchars($_POST['tipo'], ENT_QUOTES, 'UTF-8'));
$area = intval(htmlspecialchars($_POST['area'], ENT_QUOTES, 'UTF-8'));

$consultar = $MU->registrar_usuario($dni, $nombre, $telefono, $contra, $sector, $tipo, $area);
echo $consultar;
