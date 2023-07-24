<?php

require '../../model/model_usuario.php';



$MU = new model_usu; //Instaciamos
$usu = htmlspecialchars($_POST['u'], ENT_QUOTES, 'UTF-8'); // ENT:QUOTE .. para saltar codigo o innyecciones js
$pass = htmlspecialchars($_POST['p'], ENT_QUOTES, 'UTF-8');

$consultar = $MU->VerificarUsuario($usu, $pass);

if (count($consultar) > 0) {
   echo json_encode($consultar);
} else {
   echo 0;
}
