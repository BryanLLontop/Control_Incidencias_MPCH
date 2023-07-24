<?php
session_start();
if (!isset($_SESSION['S_IDUSUARIO_TP'])) {
    header('Location:../index.php'); /// si mi inicion esta creada me manda a la pagina
}
$admi = "";
$visitante = "";
$operador = "";
/* if($_SESSION['S_ROL']=="ADMIN"){
    $admi="display:none;";
}*/
?>

<?php
//Definir zona horaria
date_default_timezone_set("America/Lima");
$diassemana = array("Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sábado");
$meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
//$fechHoraActual = $diassemana[date('w')] . " " . date('d') . " de " . $meses[date('n') - 1] . " del " . date('Y') . " " . date("h:i a");
$fechahoy = date('d-m-Y');
$hora_actual =  date('Y-m-d H:i:s');

//$fechaActual = [date('w')] . "-" . [date('d')] . [date('Y')];
?>

<!DOCTYPE html>

<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SISTEMA - Control de Incidencias</title>
    <link rel="icon" type="image" href="../utilitario/login/Escudo_de_Chiclayo.png">
    <!-- Google Font: Source Sans Pro -->

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!--OTROS TIPOS DE ICONOS -->
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="../template/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../template/dist/css/adminlte.min.css">
    <link rel="stylesheet" type="text/css" href="../utilitario/DataTables/datatables.min.css" />
    <!-- Ekko Lightbox -->
    <link rel="stylesheet" href="../template/plugins/ekko-lightbox/ekko-lightbox.css">

    <link rel="stylesheet" type="text/css" href="../template/plugins/select2/css/select2.min.css" />
    <link rel="stylesheet" type="text/css" href="../template/plugins/select2-bootstrap4-theme/select2-bootstrap4.css" />

</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->

                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <b> <?php echo $_SESSION['S_USUARIO_TP']; ?></b>
                        <i class="fa fa-chevron-circle-down" aria-hidden="true"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item" style="font-size: large;" onclick="cargar_contenido('contenido_principal','usuario/mantenimiento_usuario.php')">
                            <i class="fas fa-user-cog mr-2"></i>
                            <span class="text-muted text-sm"><b>PERFIL</b></span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="../controller/usuario/cerrar_sesion.php" class="dropdown-item" style="font-size: large;">
                            <i class="fas fa-sign-out-alt"></i>
                            <span class="text-muted text-sm"><b>CERRAR SESION</b></span>
                        </a>
                        <div class="dropdown-divider"></div>

                    </div>
                </li>

            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-secondary elevation-4">
            <!-- Brand Logo -->
            <div class="text-center">
                <a href="home.php" class="brand-link">
                    <span class="text-center">
                        <b>
                            <p style="color:FFFFFF"><?php echo $_SESSION['S_ROL_TP']; ?></p>
                        </b>
                    </span>
                </a>
            </div>
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item ">
                            <a href="#" class="nav-link ">
                                <div class="text-center">
                                    <img src="../img/defaultM.png" class="profile-user-img img-fluid img-circle "><br>
                                </div>
                                <div class="txt-center">
                                    <p>
                                        <font size=3>
                                            <?php echo $_SESSION['S_USUARIO_TP']; ?>
                                        </font>
                                    </p>

                                </div>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- SidebarSearch Form -->

                <div class="form-inline">

                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                        with font-awesome or any other icon font library 
                        reemplazar: https://www.munichiclayo.gob.pe/IncidenciasMPCH/
                        -->
                        <li class="nav-item ">

                            <a href="http://localhost:3000/view/home.php" class="nav-link active">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    INICIO
                                </p>
                            </a>

                        </li>
                            <li class="nav-header">PRINCIPAL</li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-address-card"></i>
                                <p> Incidencias 
                                <i class="right fas fa-angle-left"></i>
                                </p>
                                
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="#" class="nav-link" onclick="cargar_contenido('contenido_principal','incidencia/mantenimiento_incidencia.php','0')">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>En Espera</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link" onclick="cargar_contenido('contenido_principal','incidencia/mantenimiento_incidencia.php','1')">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Atendiendo</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link" onclick="cargar_contenido('contenido_principal','incidencia/mantenimiento_incidencia.php','2')">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Solucionadas</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link" onclick="cargar_contenido('contenido_principal','incidencia/mantenimiento_incidencia.php','3')">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Sin Solucionar</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link" onclick="cargar_contenido('contenido_principal','incidencia/mantenimiento_incidencia.php','4')">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Todas</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <?php if ( $_SESSION['S_ROL_TP'] == "ADMIN") {
                        ?>
                            <li class="nav-header">CONFIGURACION</li>

                            <li class="nav-item ">
                                <a href="#" class="nav-link" onclick="cargar_contenido('contenido_principal','usuario/mantenimiento_usuario.php')">
                                    <i class="nav-icon fas fa-user"></i>
                                    <p>
                                        Usuarios
                                    </p>
                                </a>
                            </li>
                            
                        <?php    } ?>
                        
                        <?php if (("ROL" == "ADMIN")) { ?>

                        <?php } ?>
                        
                    </ul>
                    <div style="display: none   ;">
                        <input type="text" value="<?php echo $_SESSION['S_IDUSUARIO_TP']; ?>" id="txt_idPrincipal">
                    </div>
                    <input type="text" value="<?php echo $_SESSION['S_ROL_TP']; ?>" id="txt_rolPrincipal" hidden>
                    <p id="n_fechactual" class="fecha" hidden><?php echo $fechahoy ?></p>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
