<script src="../js/accion.js?rev=<?php echo time() ///para recgar el js 
                                    ?>"></script>
<?php
    // Obtener los datos enviados desde JavaScript
    $id = $_POST['id'];
    $descripcion = $_POST['descripcion'];
    $usuario = $_POST['name_usuario'];
    $ubicacion = $_POST['ubicacion'];
    $estado = $_POST['estado'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];

    $imagen = $_POST['imagen'];
    //Dividir la cadena en un array de cadenas separadas por comas
    $rutas = explode(',', $imagen);
    
    $tipoinci = $_POST['tipo'];

?>
<!-- Content Wrapper. Contains page content -->
<div class="content" id="contenido_principal">
            <!-- Content Header (Page header) -->
            <!-- /.content-header -->            
            
            <div class="col-lg-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h2 class="m-0" style="text-align: center;"><b>INCIDENCIA 00000<?php echo $id; ?> - </b></h12>
                    </div>
                    <div class="card-body row">
                        <section class="content col-md-12">
                            <div class="container-fluid" bis_skin_checked="1">

                                <div class="row" bis_skin_checked="1">
                                    <div class="col-md-12" bis_skin_checked="1">
                                        <div id="acciones" class="timeline" bis_skin_checked="1">

                                            <!-- Fecha 1 con sus item -->
                                            <div class="time-label" bis_skin_checked="1">
                                                <span class="bg-red"><?php echo $fecha; ?></span>
                                            </div>

                                            <div bis_skin_checked="1">
                                                <i class="fas fa-user bg-blue"></i>
                                                <div class="timeline-item" bis_skin_checked="1">
                                                    <span class="time"><i class="fas fa-clock"></i> <?php echo substr($hora, -8)?></span>
                                                    <h3 class="timeline-header"><a href="#"><?php echo $usuario; ?></a> registró incidencia - Tipo: <?php echo $tipoinci; ?></h3>
                                                        <div class="timeline-body" bis_skin_checked="1">
                                                            <?php foreach ($rutas as $ruta){
                                                                    echo '<img src="../../img/fotos_incidencias/' .$ruta .'" width="150" height="100" alt=""> ';
                                                            } ?> 
                                                            <div >
                                                            <?php echo $descripcion; ?>
                                                            </div>    
                                                        </div>
                                                        <!--<div class="timeline-footer" bis_skin_checked="1">
                                                            <a class="btn btn-primary btn-sm">Read more</a>
                                                            <a class="btn btn-danger btn-sm">Delete</a>
                                                        </div> -->
                                                </div>
                                            </div>
                                            

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </section>

                    </div>
                </div>
            </div>
            <!-- Main content -->
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <script>
                            cargar_acciones_incidencia('<?php echo $id ?>','<?php echo $fecha ?>');
                            $(document).ready(function() {
                                $('.js-example-basic-single').select2();

                            });
                            
                        </script>

