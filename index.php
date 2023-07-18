<?php
session_start();
if (isset($_SESSION['S_IDUSUARIO_TP'])) {
    header('Location: view/home.php'); /// si mi sesion esta creada me redirecciona a la pagina
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Google Font: Source Sans Pro -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kdam+Thmor+Pro&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="template/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="template/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="template/dist/css/adminlte.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">

    <!---<script src="utilitario/login/64d58efce2.js" crossorigin="anonymous"></script>-->
    <link rel="stylesheet" href="utilitario/login/sty2.css" />
    <link rel="icon" href="utilitario/login/Escudo_de_Chiclayo.png">
    <title>Municipalidad Provincial de Chiclayo</title>
    
    <style>
    
        input[type="submit"] {
            padding: 0.5em;
            font-size: 1.2em;
        }
    </style>

</head>

<body>
    <div class="containere">
        <div class="forms-containere" style="background-color:white">
            <div class="signin-signup">
                <!-- <div class="signin-signup1"> -->
                
                <div id="loginInicio">
                    <!--<form action="" class="sign-in-form" method="POST" autocomplete="off" id="cuadrado">-->
                    <input type="hidden" name="enviar" class="form-control" value="si">
                    <input type="hidden" name="tab" id="tab" class="form-control" value="1">
                    <h3 class="title"> <img src="utilitario/login/insignia.jpeg" width="350px" style="margin-bottom: 1rem;"> <br>Control de Incidencias</h3><br>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" name="us_nombre" id="txtUsu" placeholder="Usuario" required />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="us_clave" id="txtPass" placeholder="Contraseña" required />
                    </div>
                    <br>
                    <!--  <a href="forgot.php" class="social-text" id="forgot-up-form">Olvidé mi Contraseña</a> -->
                    <input type="submit" value="INGRESAR" id="miBoton" onclick="iniciar_Sesion()" class="btn solid" />
                    
                    <p class="social-text">&copy; MPCH. Todos los derechos reservados.</p>
                    <div class="social-media">
                    </div>
                    <!-- </form>-->
                </div>
                <!-- </div> -->
            </div>
        </div>
        <div class="panels-containere">
            <div class="panel left-panel">
                <div class="content">
                    <h1 style="font-size: xxx-large;">INTRANET</h1>
                    <p style="font-size:xx-large;">
                        Bienvenido a la Plataforma de Control de Incidencias
                        <!-- <button class="btn transparent" id="sign-up-btn">
            Registrarme
            </button> -->
                </div>
                <img src="utilitario/login/logodouments.svg" class="image" alt="" />
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="template/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="template/dist/js/adminlte.min.js"></script>
    <script src="utilitario/sweetalert.js"></script>
    <script src="js/usuario.js?rev=<?php echo time()?>"></script>

</body>

</html>