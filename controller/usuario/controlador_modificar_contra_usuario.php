<?php
require_once "../../model/model_usuario.php";

$MU = new model_usu(); //Instaciamos

$id =  htmlspecialchars($_POST['idusu'], ENT_QUOTES, 'UTF-8');

$contra =  password_hash($_POST['contran'], PASSWORD_DEFAULT, ['cost' => 12]);

$consultar = $MU->modificar_contra_usuario($id, $contra);
echo $consultar;
