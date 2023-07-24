<?php
require_once 'model_conexion.php';

class model_inci extends conexion_nueva
{

    function listar_incidencias($sector,$valor,$estado)
    {
        $c = conexion_nueva::conectarBD();
        $sql="";
        if($sector=="ADMIN" ){
            if($estado=="4" ){
                $sql = "SELECT * FROM  sp_listar_incidencias_all()";
                $query = $c->prepare($sql);
            } else{
                $sql = "SELECT * FROM  sp_listar_incidencias_estado(?)";
                $query = $c->prepare($sql);
                $query->bindParam(1, $estado);
            } 
        }else if($sector=="OPERARIO"){
            if($estado=="4" ){
                $sql = "SELECT * FROM  sp_listar_incidencias_area(?)";
                $query = $c->prepare($sql);
                $query->bindParam(1, $valor);
            } else{
                $sql = "SELECT * FROM  sp_listar_inci_area_estado(?,?)";
                $query = $c->prepare($sql);
                $query->bindParam(1, $valor);
                $query->bindParam(2, $estado);                
            } 
        }else if($sector=="CIUDADANO"){
            if($estado=="4" ){
                $sql = "SELECT * FROM  sp_listar_incidencias_sector(?)";
                $query = $c->prepare($sql);
                $query->bindParam(1, $valor);
            } else{
                $sql = "SELECT * FROM  sp_listar_inci_sector_estado(?,?)";
                $query = $c->prepare($sql);
                $query->bindParam(1, $valor);
                $query->bindParam(2, $estado);                
            }
        };
        
        $arreglo = array();
        $query->execute();

        $resultado = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($resultado as $resu) {
            $arreglo["data"][] = $resu;
        }
        return $arreglo;

        conexion_nueva::cerrar_conexion();
    }

    function listar_tipos_incidencia(){
        $c = conexion_nueva::conectarBD();

        $sql = "SELECT * FROM  sp_listar_tipos_inci()";

        $arreglo = array();
        $query = $c->prepare($sql);
        $query->execute();

        $resultado = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($resultado as $resu) {
            $arreglo[] = $resu;
        }
        return $arreglo;

        conexion_nueva::cerrar_conexion();
    }


    function registrar_incidencia($descripcion, $ubicacion, $hora, $fecha, $tipo_inci, $ruta_imagenes, $idusua)
    {
        $c = conexion_nueva::conectarBD();

        $sql = "SELECT *FROM  sp_registrar_incidencia(?,?,?,?,?,?,?)";

        $query = $c->prepare($sql);
        $query->bindParam(1, $descripcion);
        $query->bindParam(2, $ubicacion);
        $query->bindParam(3, $hora);
        $query->bindParam(4, $fecha);
        $query->bindParam(5, $tipo_inci);
        $query->bindParam(6, $ruta_imagenes);
        $query->bindParam(7, $idusua);
        $query->execute();
        //solo se utiliza cuando no retornas un valor en el procedure

        if ($row = $query->fetchColumn()) {
            return $row;
        }
        conexion_nueva::cerrar_conexion();
    }
    
    public function Modificar_Incidencia_Estatus($id,$valor)
    {
        $con = conexion_nueva::conectarBD();
        $sql = "SELECT sp_modificar_inci_estado(?,?)";
        $query = $con->prepare($sql);
        $query->bindParam(1, $id);
        $query->bindParam(2, $valor);

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
