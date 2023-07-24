<?php
require_once 'model_conexion.php';

class model_acci extends conexion_nueva
{

    function listar_acciones_inci($id)
    {    
        $c = conexion_nueva::conectarBD();

        $sql = "SELECT * FROM  sp_listar_acciones_inci(?)";

        $arreglo = array();
        $query = $c->prepare($sql);
        $query->bindParam(1, $id);
        $query->execute();

        $resultado = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($resultado as $resu) {
            $arreglo[] = $resu;
        }
        return $arreglo;

        conexion_nueva::cerrar_conexion();
    }


    function registrar_accion($descripcion, $hora, $fecha, $ruta_imagenes, $idinci, $idusua)
    {
        $c = conexion_nueva::conectarBD();

        $sql = "SELECT * FROM sp_registrar_accion(?,?,?,?,?,?)";

        $query = $c->prepare($sql);
        $query->bindParam(1, $descripcion);
        $query->bindParam(2, $hora);
        $query->bindParam(3, $fecha);
        $query->bindParam(4, $ruta_imagenes);
        $query->bindParam(5, $idinci);
        $query->bindParam(6, $idusua);
        $query->execute();
        //solo se utiliza cuando no retornas un valor en el procedure

        if ($row = $query->fetchColumn()) {
            return $row;
        }
        conexion_nueva::cerrar_conexion();
    }
    
    public function Modificar_Incidencia_Estatus($id, $estatus)
    {
        $con = conexion_nueva::conectarBD();
        $sql = "select sp_modificar_usuario_estatus(?,?)";
        $query = $con->prepare($sql);
        $query->bindParam(1, $id);
        $query->bindParam(2, $estatus);

        $resultado = $query->execute();
        //Se utiliza cuando no retornas un valor en el procedure
        if ($resultado) {
            return 1;
        } else {
            return 0;
        }
        conexion_nueva::cerrar_conexion();
    }
}
