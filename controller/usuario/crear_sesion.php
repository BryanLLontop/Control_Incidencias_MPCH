<?php

$id_usu = htmlspecialchars($_POST['id_usu'], ENT_QUOTES, 'UTF-8'); // ENT:QUOTE .. para saltar codigo o innyecciones js
$dni = htmlspecialchars($_POST['dni'], ENT_QUOTES, 'UTF-8');
$tipo = htmlspecialchars($_POST['rol'], ENT_QUOTES, 'UTF-8'); // ENT:QUOTE .. para saltar codigo o innyecciones js
$area = htmlspecialchars($_POST['area'], ENT_QUOTES, 'UTF-8');
$sector = htmlspecialchars($_POST['sector'], ENT_QUOTES, 'UTF-8');
$telefono = htmlspecialchars($_POST['telefono'], ENT_QUOTES, 'UTF-8');

$snombre = htmlspecialchars($_POST['nombre_usu'], ENT_QUOTES, 'UTF-8');
$pass = htmlspecialchars($_POST['usua_clave'], ENT_QUOTES, 'UTF-8'); 



session_start();
$_SESSION['S_IDUSUARIO_TP'] = $id_usu;
$_SESSION['S_DNI_TP'] = $dni;
$_SESSION['S_USUARIO_TP'] = $snombre;
$_SESSION['S_ROL_TP'] = $tipo;
$_SESSION['S_AREA_TP'] = $area;
$_SESSION['S_TELEFONO_TP'] = $telefono;
$_SESSION['S_SECTOR_TP'] = $sector;

$_SESSION['S_SNOMBRE_TP'] = $snombre;
$_SESSION['S_PASS_TP'] = $pass;
