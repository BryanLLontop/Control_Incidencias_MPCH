<?php
require '../../model/model_incidencia.php';
session_start();
$MU = new model_inci(); //Instaciamos
$descripcion = $_POST['descripcion'];
$ubicacion = $_POST['ubicacion'];
$hora = $_POST['hora'];
$hora_ruta = str_replace(':', '-', $hora);
$fecha = $_POST['fecha'];
$tipo_inci = $_POST['tipo'];
$nom=$_SESSION['S_DNI_TP'];
$idusua = $_SESSION['S_IDUSUARIO_TP'];
$ruta_imagenes = null;
    if (isset($_FILES['fotos'])) {
        // Los archivos se han enviado correctamente
        $numArchivos = count($_FILES['fotos']['name']);
        try {
            for ($i = 0; $i < $numArchivos; $i++) {
            $nombreArchivo = $_FILES['fotos']['name'][$i]; // Obtener el nombre del archivo
            $extensionArchivo = pathinfo($nombreArchivo, PATHINFO_EXTENSION); // Obtener la extensión del archivo
            $nombreArchivoNuevo = ($i+1).'_' .$hora_ruta .'_' .$nom .'.' .$extensionArchivo; // Definir el nuevo nombre del archivo
            $rutaArchivo = __DIR__ . '/../../img/fotos_incidencias/' . $nombreArchivoNuevo; // Definir la ruta donde se guardará el archivo
                // Código que puede lanzar una excepción
                if (move_uploaded_file($_FILES['fotos']['tmp_name'][$i], $rutaArchivo)) {

                    
                    // El archivo se movió correctamente
                    $ruta_imagenes .= $nombreArchivoNuevo;
                    if ($i != $numArchivos - 1) {
                        $ruta_imagenes .= ',';
                    }
                } else {
                    // El archivo no se pudo mover
                    echo "Error al mover el archivo " . $_FILES['fotos']['name'][$i];
                  // Código que se ejecuta si la condición es falsa
                    throw new Exception('Error: la condición es falsa');
                }
            }
            $consultar = $MU->registrar_incidencia($descripcion, $ubicacion, $hora, $fecha, $tipo_inci, $ruta_imagenes, $idusua);
            } catch (Exception $e) {
                // Manejo de la excepción
            }
        
    }

echo $consultar;

