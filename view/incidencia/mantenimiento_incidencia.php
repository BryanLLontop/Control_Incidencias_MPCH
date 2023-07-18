<script src="../js/incidencia.js?rev=<?php echo time() ///para recgar el js 
                                    ?>"></script>
<style>
    .select2-container .select2-selection--single {
        height: 38px !important;
    }

    .select2-selection__arrow {
        height: 38px !important;
    }
</style>
<style>
    .truncated-text {
    display: inline-block;
    max-width: 100px; /* Ajusta el ancho máximo según tus necesidades */
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    }
    .modal-title {
        color: white;
        font-weight: bold;
        text-align: center;
        margin-left: auto;
    }
</style>
<?php
session_start();
//Definir zona horaria
$sector_area='';
if($_SESSION['S_ROL_TP']=="CIUDADANO"){
    $sector_area=$_SESSION['S_SECTOR_TP'];
} else if($_SESSION['S_ROL_TP']=="OPERARIO"){
    $sector_area=$_SESSION['S_AREA_TP'];
} else $sector_area="GENERAL ";
date_default_timezone_set("America/Lima");
?>


<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><b>CONTROL DE INCIDENCIAS</b></h1>
            </div><!-- /.col -->

        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<div class="col-lg-12">
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title"><b>LISTADO DE INCIDENCIAS - <?php echo $sector_area; ?></b></h3>
            <?php if($_SESSION['S_ROL_TP'] == "CIUDADANO") { ?>
                <button class="btn btn-danger btn-sm float-right " style="margin:5px;" 
                onclick="abrirModalRegistroIncidencia()"><i class="nav-icon fa fa-address-book" 
                aria-hidden="true"></i> Nueva Incidencia</button>
            <?php } ?>
            

        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 table -responsive">
                    <table id="tabla_incidencias" class="display" width="100%" style="text-align: center;">
                        <style>
                            #tabla_incidencias {
                                text-align: center;
                                width: 100%;
                                font-size: 14px;
                            }
                        </style>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>NOMBRE</th>
                                <th>SECTOR</th>
                                <th>DESCRIPCION</th>
                                <th>TIPO</th>
                                <th>AREA</th>
                                <th>UBICACION</th>
                                <th>FECHA</th>
                                <th>HORA</th>
                                <th>ESTADO</th>
                                <th>ACCION</th>

                            </tr>
                        </thead>

                    </table>
                </div>


            </div>
        </div>

    </div>
</div>
<!-- INICIO MODAL REGISTRAR INCIDENCIA-->
    <div class="modal fade" id="modal_registro_inci" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Registro de Incidencia</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <style>
                    .form-control {
                        margin-bottom: 1rem;
                    }
                </style>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-4">
                            <label for="">TIPO</label>
                            <select class="js-example-basic-single " id="select_tipo_inci" style="width:100%">
                                <option value="">SELECCIONE UN TIPO</option>
                                
                            </select>
                            <div id="valid_tipo_inci">
                            </div>
                        </div>
                        <div class="col-5">
                            <label for="">DESCRIPCION</label>
                            <input type="texarea" id="txt_descripcion" placeholder="Ingresar Descripcion" class="form-control">
                            <div id="valid_descripcion">
                            </div>
                        </div>
                        
                        <div class="col-3">
                            <label for="">DIRECCION</label>
                            <input type="text" id="txt_ubicacion" placeholder="Ingresar Direccion" class="form-control" onkeypress=" return soloLetras(event);">
                            <div id="valid_ubicacion">
                            </div>
                        </div>
                        <div class="col-3">
                            <label for="">FECHA</label>
                            <input type="text" id="txt_fecha" readonly placeholder="Ingresar Fecha" class="form-control" ">
                            <div id="valid_fecha">
                            </div>
                        </div>
                        <div class="col-3">
                            <label for="">HORA</label>
                            <input type="text" id="txt_hora" readonly placeholder="Ingresar Hora" class="form-control">
                            <div id="valid_hora">
                            </div>
                        </div>
                        
                        <div class="col-4">
                        <label for="">FOTOS</label>
                            <input type="file" id="txt_fotos" name="fotos[]" multiple class="form-control" accept=".png, .jpg, .jpeg">
                            <div id="valid_fotos">
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="registrar_incidencia()">REGISTRAR</button>
                </div>
            </div>
        </div>
    </div>
    <!-- FINAL MODAL REGISTRAR INCIDENCIA-->

    <!-- INICIO MODAL REGISTRAR ACCION -->
    <div class="modal fade" id="modal_registro_accion" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Registrar Nueva Accion</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-5">
                                    <label for="">DESCRIPCION</label>
                                    <input type="text" id="txt_id_inci_accion" hidden>
                                    <input  type="texarea" id="txt_descripcion_accion" placeholder="Ingresar Descripcion" class="form-control">
                                        <div id="valid_descripcion_accion">
                                        </div>
                                </div>
                                <div class="col-3">
                                    <label for="">FECHA</label>
                                    <input type="text" id="txt_fecha_accion" readonly placeholder="Ingresar Fecha" class="form-control" ">
                                        <div id="valid_fecha_accion">
                                        </div>
                                </div>
                                <div class="col-3">
                                    <label for="">HORA</label>
                                    <input type="text" id="txt_hora_accion" readonly placeholder="Ingresar Hora" class="form-control">
                                        <div id="valid_hora_accion">
                                        </div>
                                </div>
                                <div class="col-4">
                                    <label for="">FOTOS</label>
                                    <input type="file" id="txt_fotos_accion" name="fotosaccion[]" multiple class="form-control" accept=".png, .jpg, .jpeg">
                                        <div id="valid_fotos_accion">
                                        </div>
                                </div>
                                <div class="col-3">
                                    <input class="form-check-input" type="checkbox" value="" id="check_fotos">
                                    <label  for="check_fotos">
                                    No enviar fotos
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="registrar_accion()">Registrar</button>
                        </div>
                    </div>
                </div>
            </div>
<!-- FINAL MODAL -->
                        <script>
                            
                            listado_incidencias('<?php echo $_SESSION['S_ROL_TP']; ?>',estatus);
                            $(document).ready(function() {
                                $('.js-example-basic-single').select2();

                            });
                            
                        </script>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
