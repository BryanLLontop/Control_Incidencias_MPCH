<?php
require '../../model/model_accion.php';
session_start();

$MU = new model_acci(); //Instaciamos
$idinci = $_POST['idinci'];
$descripcion = $_POST['descripcion'];
$hora = $_POST['hora'];
$check = $_POST['check'];
$hora_ruta = str_replace(':', '-', $hora);
$fecha = $_POST['fecha'];
$nom=$_SESSION['S_DNI_TP'];
$ruta_imagenes=null;
$idusua = $_SESSION['S_IDUSUARIO_TP'];
if ($check==1) {
    try {
        // Código que puede lanzar una excepción
        if (isset($_FILES['fotosaccion'])) {
            // Los archivos se han enviado correctamente
            $numArchivos = count($_FILES['fotosaccion']['name']);
            for ($i = 0; $i < $numArchivos; $i++) {
                $nombreArchivo = $_FILES['fotosaccion']['name'][$i]; // Obtener el nombre del archivo
                $extensionArchivo = pathinfo($nombreArchivo, PATHINFO_EXTENSION); // Obtener la extensión del archivo
                $nombreArchivoNuevo = $idinci .'_' .($i+1).'_' .$hora_ruta .'_' .$nom .'.' .$extensionArchivo; // Definir el nuevo nombre del archivo
                $rutaArchivo = __DIR__ . '/../../img/fotos_acciones/' . $nombreArchivoNuevo; // Definir la ruta donde se guardará el archivo
    
                if (move_uploaded_file($_FILES['fotosaccion']['tmp_name'][$i], $rutaArchivo)) {
                    // El archivo se movió correctamente
                    $ruta_imagenes .= $nombreArchivoNuevo;
                    if ($i != $numArchivos - 1) {
                        $ruta_imagenes .= ',';
                    }
                } else {
                    // El archivo no se pudo mover
                    $error = "Error al mover el archivo " . $_FILES['fotosaccion']['name'][$i];
                    error_log($error);
                }
            }
            if(isset($ruta_imagenes)){
                $consultar = $MU->registrar_accion($descripcion, $hora, $fecha, $ruta_imagenes, $idinci, $idusua);
            } else $consultar = $MU->registrar_accion($descripcion, $hora, $fecha, $rutaArchivo, $idinci, $idusua);;
        }
    
    } catch (Exception $e) {
        $consultar=0;
    }
}else {
    $consultar = $MU->registrar_accion($descripcion, $hora, $fecha, $ruta_imagenes, $idinci, $idusua);
}   

error_log($descripcion);
error_log($hora);
error_log($fecha);
error_log($ruta_imagenes);
error_log($idinci);
error_log($idusua);

echo $consultar;

