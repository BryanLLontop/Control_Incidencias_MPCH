        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="col-12">
                <div class="row">
                    <div class="d-none d-sm-inline">
                        <img src="../img/insignia.png" class=" img-fluid " width="300px" height="100%">
                    </div>
                    <!-- Default to the left -->
                    <div class="col-6 mt-5">
                        <!-- <strong>&copy; Copyright MPCH GTIE - Todos los derechos reservados.</strong> All rights reserved.
                            -->
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <!-- ./wrapper -->


    <!-- jQuery -->
    <script src="../template/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="../utilitario/DataTables/datatables.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../template/dist/js/demo.js"></script>
    <script src="../template/plugins/select2/js/select2.full.min.js"></script>
    <script src="../utilitario/sweetalert.js"></script>
    <script src="../template/dist/js/adminlte.min.js"></script>
    

    <script>
        let estatus=0;
        function cargar_contenido(id, vista) {
            $("#" + id).load(vista);
        }
        function cargar_contenido(id, vista,estado) {
            $("#" + id).load(vista);
            estatus=estado;
        }
        var idioma_espanol = {
            select: {
                // rows: "%d fila seleccionada"
                rows: ""
            },
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ning&uacute;n dato disponible en esta tabla",
            "sInfo": "Registros del (_START_ al _END_) total de _TOTAL_ registros",
            "sInfoEmpty": "Registro del (0 al 0) total 0 registros",
            "sInfoFiltered": "(Filtrado de un total de MAX registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "<b> No se encontraron datos </b>",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ":Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ":Activar para ordenar la columna de manera descendente"
            }

        }
        $(function() {
            var menues = $(".nav-link");
            menues.click(function() {
                menues.removeClass("active");
                $(this).addClass("active");
            });
        })

        function soloNumeros(e,num) {
            tecla = (document.all) ? e.keyCode : e.which;
            if (tecla == num) {
                return true;
            }
            // Patron de entrada, en este caso solo acepta numeros
            patron = /[0-9]/;
            tecla_final = String.fromCharCode(tecla);
            return patron.test(tecla_final);
        }

        function soloLetras(e) {
            key = e.keyCode || e.which;
            tecla = String.fromCharCode(key).toLowerCase();
            letras = " áéíóúabcdefghijklmñopnqrstuvwxyz";
            especiales = "8-37-39-46";
            tecla_especial = false
            for (var i in especiales) {
                if (key == especiales[i]) {
                    tecla_especial = true;
                    break;
                }
            }
            if (letras.indexOf(tecla) == -1 && !tecla_especial) {
                return false;
            }
        }

        function filterFloat(evt, input) {
            var key = window.Event ? evt.which : evt.keyCode;
            var chark = String.fromCharCode(key);
            var tempValue = input.value + chark;
            if (key >= 48 && key <= 57) {
                if (filter(tempValue) === false) {
                    return false;
                } else {
                    return true;
                }
            } else {
                if (key == 8 || key == 13 || key == 0) {
                    return true;
                } else if (key == 46) {
                    if (filter(tempValue) === false) {
                        return false;
                    } else {
                        return true;
                    }
                } else {
                    return false;
                }
            }
        }

        function filter(__val__) {
            var preg = /^([0-9]+\.?[0-9]{0,2})$/;
            if (preg.test(__val__) === true) {
                return true;
            } else {
                return false;
            }
        }
    </script>

