<?php
require_once 'model_conexion.php';

class model_usu extends conexion_nueva
{

    public function VerificarUsuario($dni, $pass)
    {

        $c = conexion_nueva::conectarBD();

        $sql = "SELECT * FROM  sp_verificar_usuario(?)";

        $arreglo = array();
        $query = $c->prepare($sql);
        $query->bindParam(1, $dni); /// para que la primer entrada de la setencia sql reciba un dato
        $query->execute();

        $resultado = $query->fetchAll();

        foreach ($resultado as $resu) {

            if (password_verify($pass, $resu['usua_password'])) { // PHP brinda una funcion para poder verificar contraseñas ncriptadas ya que siempre estan cambiando
                $arreglo[] = $resu;
            }
        }

        return $arreglo;

        conexion_nueva::cerrar_conexion();
    }

    function listar_usuario()
    {
        $c = conexion_nueva::conectarBD();

        $sql = "SELECT * FROM  sp_listar_usuarios()";

        $arreglo = array();
        $query = $c->prepare($sql);
        $query->execute();

        $resultado = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($resultado as $resu) {
            $arreglo["data"][] = $resu;
        }
        return $arreglo;

        conexion_nueva::cerrar_conexion();
    }

    function listar_areas_usuario(){
        $c = conexion_nueva::conectarBD();

        $sql = "SELECT * FROM  sp_listar_areas()";

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


    function registrar_usuario($dni, $nombre, $telefono, $contra, $sector, $tipo, $area)
    {
        $c = conexion_nueva::conectarBD();

        $sql = "SELECT *FROM  sp_registrar_usuario(?,?,?,?,?,?,?)";

        $query = $c->prepare($sql);
        $query->bindParam(1, $nombre);
        $query->bindParam(2, $telefono);
        $query->bindParam(3, $dni);
        $query->bindParam(4, $contra);
        $query->bindParam(5, $sector);
        $query->bindParam(6, $tipo);
        $query->bindParam(7, $area);
        $query->execute();
        //solo se utiliza cuando no retornas un valor en el procedure

        if ($row = $query->fetchColumn()) {
            return $row;
        }
        conexion_nueva::cerrar_conexion();
    }

    function modificar_usuario($id, $dni, $nombre, $telefono, $sector, $tipo, $area)
    {
        $c = conexion_nueva::conectarBD();

        $sql = "SELECT *FROM  sp_modificar_usuario(?,?,?,?,?,?,?) ";

        $query = $c->prepare($sql);
        $query->bindParam(1, $id);
        $query->bindParam(2, $nombre);
        $query->bindParam(3, $telefono);
        $query->bindParam(4, $dni);
        $query->bindParam(5, $sector);
        $query->bindParam(6, $tipo);
        $query->bindParam(7, $area);
        $query->execute();
        if ($row = $query->fetchColumn()) {
            return $row;
        }

        conexion_nueva::cerrar_conexion();
    }

    function modificar_contra_usuario($id, $contra){
        $c = conexion_nueva::conectarBD();

        $sql = "SELECT *FROM  sp_modificar_contra(?,?) ";

        $query = $c->prepare($sql);
        $query->bindParam(1, $id);
        $query->bindParam(2, $contra);
        $query->execute();

        if ($row = $query->fetchColumn()) {
            return $row;
        }
        conexion_nueva::cerrar_conexion();
    }

    public function Modificar_Usuario_Estatus($id, $estatus)
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
