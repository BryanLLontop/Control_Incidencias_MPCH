<script src="../js/usuario.js?rev=<?php echo time() ///para recgar el js 
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
    .modal-title {
        color: white;
        font-weight: bold;
        text-align: center;
        margin-left: auto;
    }
</style>
<!-- Content Header (Page header) -->

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><b>MANTENIMIENTO DE USUARIO</b></h1>
            </div><!-- /.col -->

        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<div class="col-lg-12">
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title"><b>LISTADO DE USUARIO</b></h3>
            <button class="btn btn-danger btn-sm float-right " style="margin:5px;" 
                onclick="abrirModalRegistroUsuario()"><i class="nav-icon fa fa-address-book" 
                aria-hidden="true"></i> Nuevo Registro</button>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 table -responsive">
                    <table id="tabla_usuario" class="display" width="100%" style="text-align: center;">
                        <style>
                            #tabla_usuario {
                                text-align: center;
                                width: 100%;
                                font-size: 14px;
                            }
                        </style>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>DNI</th>
                                <th>NOMBRE</th>
                                <th>TELEFONO</th>
                                <th>TIPO</th>
                                <th>SECTOR</th>
                                <th>AREA</th>
                                <th>ACCION</th>

                            </tr>
                        </thead>

                    </table>
                </div>


            </div>
        </div>

    </div>
</div>
<!-- INICIO MODAL REGISTRAR -->
    <div class="modal fade" id="modal_registro_usu" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Registro Usuario</h5>
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
                        <div class="col-3">
                            <label for="">DNI</label>
                            <input type="text" id="txt_dni" placeholder="Ingresar DNI" class="form-control" onkeypress="return soloNumeros(event,8);" maxlength="8">
                            <div id="valid_dni">
                            </div>
                        </div>
                        <div class="col-1" style="text-align: right; flex: 0 0 3%;">
                            <!--boton para buscar-->
                            <label for="">&nbsp;</label><br>
                            <button type="button" class="btn btn-dark" onclick="buscarpersona()">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                </svg>
                            </button>
                        </div>
                        <div class="col-5">
                            <label for="">NOMBRE</label>
                            <input type="text" id="txt_nombre" placeholder="Ingresar Nombre" class="form-control" onkeypress=" return soloLetras(event);">
                            <div id="valid_nombre">
                            </div>
                        </div>
                        <div class="col-3">
                            <label for="">TELEFONO</label>
                            <input type="text" id="txt_telefono" placeholder="Ingresar Telefono" class="form-control" onkeypress=" return soloNumeros(event,9); "maxlength="9">
                            <div id="valid_telefono">
                            </div>
                        </div>
                        <div class="col-4">
                            <label for="">SECTOR</label>
                            <input type="text" id="txt_sector" placeholder="Ingresar Sector" class="form-control" onkeypress=" return soloLetras(event);">
                            <div id="valid_sector">
                            </div>
                        </div>
                        <div class="col-4">
                            <label for="">AREA</label>
                            <select class="js-example-basic-single " id="select_area" style="width:100%">
                                <option value="">SELECCIONE UN AREA</option>
                                
                            </select>
                            <div id="valid_area">
                            </div>
                        </div>
                        <div class="col-4">
                            <label for="">NIVEL</label>
                            <select class="js-example-basic-single " id="select_tipo" style="width:100%">
                                <option value="">SELECCIONE UN NIVEL</option>
                                <option value="1">ADMIN</option>
                                <option value="2">OPERARIO</option>
                                <option value="3">CIUDADANO</option>
                                <option value="4">VISITANTE</option>
                            </select>
                            <div id="valid_tipo">
                            </div>
                        </div>
                        
                        <div class="col-4">
                            <label for="">CONTRASEÑA </label>
                            <input type="password" id="txt_contraseña" placeholder="Ingresar Contraseña" class="form-control">
                            <div id="valid_contrasena">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="registrar_usuario()">REGISTRAR</button>
                </div>
            </div>
        </div>
    </div>
    <!-- FINAL MODAL REGISTRAR -->

    <!-- INICIO MODAL EDITAR -->
            <div class="modal fade" id="modal_editar_usuario" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Editar Usuarios</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-4">
                                    <label for="">DNI</label>
                                    <input type="text" id="txt_idUsu_editar" hidden>
                                    <input type="text" id="txt_dni_editar" placeholder="Ingresar DNI" 
                                        class="form-control" readonly onkeypress="return soloNumeros(event);" maxlength="8">
                                    <div id="valid_dni_editar">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <label for="">NOMBRE</label>
                                    <input type="text" id="txt_nombre_editar" placeholder="Ingresar Nombre Completo" 
                                        class="form-control" readonly onkeypress=" return soloLetras(event);">
                                    <div id="valid_nombre_editar">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <label for="">TELEFONO</label>
                                    <input type="text" id="txt_telefono_editar" placeholder="Ingresar Telefono" 
                                        class="form-control" onkeypress=" return soloNumeros(event,9);">
                                    <div id="valid_telefono_editar">
                                    </div>
                                </div>

                                <div class="col-4">
                                    <label for="">SECTOR</label>
                                    <input type="text" id="txt_sector_editar" placeholder="Ingresar Sector" 
                                        class="form-control" onkeypress=" return soloLetras(event);">
                                    <div id="valid_sector_editar">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <label for="">AREA</label>
                                    <select class="js-example-basic-single " id="select_areas_editar" style="width:100%">
                                        
                                    </select>
                                    <div id="valid_areas_editar">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <label for="">NIVEL</label>
                                    <select class="js-example-basic-single " id="select_tipo_editar" style="width:100%">
                                        <option value="1">ADMIN</option>
                                        <option value="2">OPERARIO</option>
                                        <option value="3">CIUDADANO</option>
                                    </select>
                                    <div id="valid_tipo_editar">
                                    </div>
                                </div>
                                <div class="col-9">
                                    <label for="">CONTRASEÑA </label>
                                    <input type="password" id="txt_contra_editar" placeholder="Ingresar Contraseña" disabled class="form-control">
                                    <div id="valid_contra_editar">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <label for="">&nbsp;</label>
                                    <button class='btn btn-primary' style="width:100%" onclick="abrirmodal_modificarcontra()"><i class='fa fa-edit'></i>
                                        EDIT PASSWORD
                                    </button>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="modificar_usuario()">MODIFICAR</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- FINAL MODAL -->
                <!-- INICIO MODAL -->
                    <!-- FINAL MODAL -->
                        <div class="modal fade" id="modal_editar_contra" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Editar Contraseña del usuario
                                            <label for="" id="lbl_usuario_contra"></label>
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <input type="text" id="idUsuarioContra" hidden>

                                                <label for="">CONTRASEÑA NUEVA </label>
                                                <input type="password" id="txt_contra_nueva" class="form-control">
                                            </div>
                                            <div class="col-12">

                                                <label for="">REPETIR CONTRASEÑA </label>
                                                <input type="password" id="txt_contra_repetir" class="form-control">
                                            </div>


                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" onclick="modificar_contra_usuario()">MODIFICAR</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                            listado_usu();
                            $(document).ready(function() {
                                $('.js-example-basic-single').select2();

                            });
                            
                        </script>