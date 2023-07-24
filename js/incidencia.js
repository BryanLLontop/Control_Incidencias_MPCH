//::::::FORMATO_TABLA_INCIDENCIAS:::://
var tbl_incidencias;
function listado_incidencias(roltp,estado) {
    //console.log(roltp);
///::::MUESTRA LOS DATOS PARA ADMIN::://///
    if(roltp=="ADMIN" || roltp=="VISITANTE"){
        tbl_incidencias = $("#tabla_incidencias").DataTable({
            "ordering": false,
            "bLengthChange": true,
            "searching": { "regex": false },
            "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
            "pageLength": 10,
            "destroy": true,
            "async": false,
            "processing": true,
            "ajax": {
                "url": "../controller/incidencia/controlador_listar_inci.php",
                type: 'POST',
                data: {
                    estatus: estado
                }
            },
            
            "columns": [
                { "defaultContent": "" },
                { "data": "inci_usuario" },
                { "data": "sector_nombre"},
                {
                    "data": "inci_descripcion",
                    render: function (data, type, row) {
                            return '<span class="d-inline-block text-truncate" style="max-width: 100px;">'+data+'</span>';
                    }
                },
                { "data": "tiin_nombre" },
                { "data": "area_nombre" },
                { "data": "inci_ubicacion" },
                { "data": "inci_fecha" },
                {
                    "data": "inci_hora",
                    render: function (data, type, row) {
                        var fecha = data;
                        var hora = new Date(fecha).toLocaleTimeString('en-US', {hour12: false});
                        return hora;
                    }
                },
                {
                    "data": "inci_estado",
                    render: function (data, type, row) {
    
                        if (data == "0") {
                            return "<span class='badge bg-warning'> En Espera </span>";
                        }
                        else if (data == "1"){
                            return '<span class="badge bg-success"> Atendiendo </span>';
                        } else if (data == "2"){
                            return '<span class="badge bg-primary"> Solucionado </span>';
                        }else{
                            return '<span class="badge bg-danger"> Sin Solucionar </span>';
                        }
                    }
                },
                {
                    "data": "inci_estado",
                    render: function (data, type, row) {    
                            return "<button class='view btn btn-info btn-sm'><i class='fa fa-eye'></i></button>&nbsp;";
                        
                    }
                }
    
            ],
            "language": idioma_espanol,
            select: true
        });
///::::MUESTRA LOS DATOS PARA OPERARIO::://///        
    }else if(roltp=="OPERARIO"){
        tbl_incidencias = $("#tabla_incidencias").DataTable({
            "ordering": false,
            "bLengthChange": true,
            "searching": { "regex": false },
            "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
            "pageLength": 10,
            "destroy": true,
            "async": false,
            "processing": true,
            "ajax": {
                "url": "../controller/incidencia/controlador_listar_inci.php",
                type: 'POST',
                data: {
                    estatus: estado
                }
            },
            
            "columns": [
                { "defaultContent": "" },
                { "data": "inci_usuario" },
                { "data": "sector_nombre"},
                {
                    "data": "inci_descripcion",
                    render: function (data, type, row) {
                            return '<span class="d-inline-block text-truncate" style="max-width: 100px;">'+data+'</span>';
                    }
                },
                { "data": "tiin_nombre" },
                { "data": "area_nombre" , 
                "visible": false },
                { "data": "inci_ubicacion" },
                { "data": "inci_fecha" },
                //{ "data": "inci_hora" },
                {
                    "data": "inci_hora",
                    render: function (data, type, row) {
                        var fecha = data;
                        var hora = new Date(fecha).toLocaleTimeString('en-US', {hour12: false});
                        return hora;
                    }
                },
                {
                    "data": "inci_estado",
                    render: function (data, type, row) {
    
                        if (data == "0") {
                            return "<span class='badge bg-warning'> En Espera </span>";
                        }
                        else if (data == "1"){
                            return '<span class="badge bg-success"> Atendiendo </span>';
                        } else if (data == "2"){
                            return '<span class="badge bg-primay"> Solucionado </span>';
                        }else{
                            return '<span class="badge bg-danger"> Sin Solucionar </span>';
                        }
                    }
                },
                {
                    "data": "inci_estado",
                    render: function (data, type, row) {
                        if (data == '0'|| data == '1') {
                            return "<button class='view btn btn-info btn-sm'><i class='fa fa-eye'></i></button>&nbsp;" +
                            '<button class="accion btn btn-primary btn-sm"><i class="fa fa-plus-square"></i> Accion</button>&nbsp;';
                        } else {
                            return "<button class='view btn btn-info btn-sm'><i class='fa fa-eye'></i></button>&nbsp;" +
                            "<button class='btn btn-primary btn-sm' disabled><i class='fa fa-plus-square'></i> Accion</button>&nbsp;";
                        }
                    }
                }
    
            ],
            "language": idioma_espanol,
            select: true
        });
///::::MUESTRA LOS DATOS PARA CIUDADANO::://///        
    } else {
        tbl_incidencias = $("#tabla_incidencias").DataTable({
            "ordering": false,
            "bLengthChange": true,
            "searching": { "regex": false },
            "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
            "pageLength": 10,
            "destroy": true,
            "async": false,
            "processing": true,
            "ajax": {
                "url": "../controller/incidencia/controlador_listar_inci.php",
                type: 'POST',
                data: {
                    estatus: estado
                }
            },
            
            "columns": [
                { "defaultContent": "" },
                { "data": "inci_usuario" },
                { "data": "sector_nombre", "visible":false},
                {
                    "data": "inci_descripcion",
                    render: function (data, type, row) {
                            return '<span class="d-inline-block text-truncate" style="max-width: 100px;">'+data+'</span>';
                    }
                },
                { "data": "tiin_nombre" },
                { "data": "area_nombre" },
                { "data": "inci_ubicacion" },
                { "data": "inci_fecha" },
                {
                    "data": "inci_hora",
                    render: function (data, type, row) {
                        var fecha = data;
                        var hora = new Date(fecha).toLocaleTimeString('en-US', {hour12: false});
                        return hora;
                    }
                },
                {
                    "data": "inci_estado",
                    render: function (data, type, row) {
    
                        if (data == "0") {
                            return "<span class='badge bg-warning'> En Espera </span>";
                        }
                        else if (data == "1"){
                            return '<span class="badge bg-success"> Atendiendo </span>';
                        } else if (data == "2"){
                            return '<span class="badge bg-primary"> Solucionado </span>';
                        }else{
                            return '<span class="badge bg-danger"> Sin Solucionar </span>';
                        }
                    }
                },
                {
                    "data": "inci_estado",
                    render: function (data, type, row) {
                        if (data == '0' || data == '1') {
                            return "<button class='view btn btn-info btn-sm'><i class='fa fa-eye'></i></button>&nbsp;" +
                            '<button class="accion btn btn-primary btn-sm"><i class="fa fa-plus-square"></i> Accion</button>&nbsp;' +
                            "<button class='desactivar btn btn-danger btn-sm'><i class = 'fa fa-power-off'></i> Fin</button>";
                        } else {
                            return "<button class='view btn btn-info btn-sm'><i class='fa fa-eye'></i></button>&nbsp;" +
                            "<button class='btn btn-primary btn-sm' disabled><i class='fa fa-plus-square'></i> Accion</button>&nbsp;" +
                            "<button class = 'btn btn-danger btn-sm' disabled><i class = 'fa fa-power-off'></i> Fin</button>";
                        }
                    }
                }
    
            ],
            "language": idioma_espanol,
            select: true
        });
    }
    
    tbl_incidencias.on('draw.td', function () {
        var PageInfo = $("#tabla_incidencias").DataTable().page.info();
        tbl_incidencias.column(0, { page: 'current' }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
        });

    });
}

////::::EDITAR ESTADO INCIDENCIA::::.////
$('#tabla_incidencias').on('click', '.desactivar', async function () {
    var data = tbl_incidencias.row($(this).parents('tr')).data();//Lenar datos en tamanño escritorio
    if (tbl_incidencias.row(this).child.isShown()) {
        var data = tbl_incidencias.row(this).data();
    }// Permite llenar los datos cuando es tamaño celular y usas el responsive de datable
    let opc=null;
    const { value } = await Swal.fire({
        title: 'Estas seguro de dar por finalizado la Incidencia? ',
        text: "Una vez realizado esto NO tendrá acceso a registrar acciones!",
        icon: 'warning',
        input: 'radio',
        inputOptions: {
            '2': 'Solucionado',
            '3': 'Sin Solucionar'
            },
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Confirmar',
        inputValidator: (value) => {
        if (!value) {
            return 'Seleccione una opción!'
        }
        }
    });
    opc = value; // Asignamos el valor del input seleccionado a la variable opc
    if (opc) {
        console.log(opc);
        Modificar_Incidencia_Estado(data["inci_id"], opc);
    }
});

function Modificar_Incidencia_Estado(id,valor) {
    $.ajax({
        url: '../controller/incidencia/controlador_incidencia_estatus.php',
        type: 'POST',
        data: {
            id: id,
            valor:valor
        }
    }).done(function (resp) {
        // alert(resp);
        if (resp > 0) {
            Swal.fire("Mensaje de Confirmacion", "Incidencia Finalizada", "success").
                then((value) => {
                    tbl_incidencias.ajax.reload();                                                                                                                                    
                });
        } else {
            Swal.fire("Mensaje de Error", "No se pudo cambiar el estado", "error");
        }
    });
}

////:::::VER ACCIONES DE INCIDENCIA:::::////
$('#tabla_incidencias').on('click', '.view', function () {
    var data = tbl_incidencias.row($(this).parents('tr')).data();//Lenar datos en tamanño escritorio
    if (tbl_incidencias.row(this).child.isShown()) {
        var data = tbl_incidencias.row(this).data();
    }// Permite llenar los datos cuando es tamaño celular y usas el responsive de datable
    var data = tbl_incidencias.row($(this).parents('tr')).data(); //Obtener datos de la fila

    //Crear un objeto FormData y agregar los datos de la incidencia
    var formData = new FormData();
    //Agregar los demás campos que quieras enviar
    formData.append('id', data['inci_id']);
    formData.append('descripcion', data['inci_descripcion']);
    formData.append('name_usuario', data['inci_usuario']);
    formData.append('ubicacion', data['inci_ubicacion']);
    formData.append('estado', data['inci_estado']);
    formData.append('fecha', data['inci_fecha']);
    formData.append('hora', data['inci_hora']);
    formData.append('imagen', data['inci_imagen']);
    formData.append('tipo', data['tiin_nombre']);


    //Enviar los datos al servidor y obtener el contenido HTML
    $.ajax({
        url: '../view/incidencia/mantenimiento_accion.php',
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (html) {
            //Cargar el contenido HTML en el elemento con ID "contenido_principal"
            $("#" + 'contenido_principal').html(html);
        }
    });
});
///::::CARGAR AREAS:::::
function cargar_tipo_incidencia(){
    $.ajax({
        url: '../controller/incidencia/controlador_listar_tiin.php',
        type: 'POST',
    }).done(function (resp) {
        let data = JSON.parse(resp);
        if (data.length > 0) {
            // Obtener el elemento select
            var select = document.getElementById("select_tipo_inci");
    
            // Recorrer los datos y crear las opciones del select
            for (var i = 0; i < data.length; i++) {
                var noption = document.createElement("option");
                noption.value = data[i]['tiin_id'];
                noption.text = data[i]['tiin_nombre'];
                select.appendChild(noption);
            };
        }   
    });
    }

///:::::ABRIR MODAL REGISTRO:::::://///
function abrirModalRegistroIncidencia() {
    $('.form-control').removeClass("is-invalid").removeClass("is-valid");
    $("#modal_registro_inci").modal({ backdrop: 'static', keyboard: false });//cuando de clip al costado no se cierra
    $("#modal_registro_inci").modal('show');//abirir modal
    cargar_tipo_incidencia();
    document.getElementById("valid_tipo_inci").innerHTML = '';
    let fecha_actual = moment().format('YYYY-MM-DD'); // obtener la fecha actual en formato dd-mm-yyyy
    let hora_actual = moment().format('YYYY-MM-DD HH:mm:ss'); // obtener la hora actual en formato yyyy-mm-dd hh:mm:ss
    document.getElementById("txt_fecha").value = fecha_actual;
    document.getElementById("txt_hora").value = hora_actual;
    $('.modal-title').css('color', 'white');
    $('.modal-header').css('background', '#154170');
}

///////:::::REGISTRAR INCIDENCIA :::////////
function registrar_incidencia() {
    let tipo = document.getElementById("select_tipo_inci").value;
    let descripcion = document.getElementById("txt_descripcion").value;
    let ubicacion = document.getElementById("txt_ubicacion").value;
    let fecha = document.getElementById("txt_fecha").value;
    let hora = document.getElementById("txt_hora").value;
    var rfotos = document.getElementById("txt_fotos");
    
    //document.getElementById("valid_dni").value;
    if (descripcion.length == 0 || ubicacion.length == 0 ) {
        ValidarInputRegisInci("txt_descripcion", "txt_ubicacion", "valid_descripcion", "valid_ubicacion");/// para que se me muesree lo rojo
        return Swal.fire("!Mensaje de Advertencia!", "<b>Llene todo los campos</b>", "warning");
    }
    if (tipo.length == 0) {
        document.getElementById("valid_tipo_inci").innerHTML = '<font size=2 color="red"><b>SELECCIONE UN TIPO PARA CONTINUAR</b></font>';
        return Swal.fire("!Mensaje de Advertencia!", "<b>El campo Tipo, no se ecuentra seleccionado, por favor seleccione un Tipo</b>", "warning");
    }else
    document.getElementById("valid_tipo_inci").innerHTML = '<font size=2 color="green"><b>CORRECTO</b></font>';

    if (rfotos.files.length == 0 || rfotos.value == '') {
        document.getElementById("valid_fotos").innerHTML = '<font size=2 color="red"><b>SUBA FOTO PARA CONTINUAR</b></font>';
        return Swal.fire("!Mensaje de Advertencia!", "<b>El campo Fotos, se encuentra vacio, por favor suba una o más fotos</b>", "warning");
    }else
    document.getElementById("valid_fotos").innerHTML = '<font size=2 color="green"><b>CORRECTO</b></font>';

    let fotos = document.getElementById("txt_fotos").files;
    
    let formData = new FormData();
    formData.append('descripcion', descripcion);
    formData.append('ubicacion', ubicacion);
    formData.append('hora', hora);
    formData.append('fecha', fecha);
    formData.append('tipo', tipo);

    // Agregar los archivos seleccionados al FormData
    for (var i = 0; i < fotos.length; i++) {
        formData.append('fotos[]', fotos[i]);
    }

    $.ajax({
        url: '../controller/incidencia/controlador_registrar_incidencia.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,        
    }).done(function (resp) {
        //return alert(resp);
        if (resp > 0) {
            if (resp == 1) {
                
                return Swal.fire("Mensaje de Confirmacion", "Nueva Incidencia Registrada", "success").then((value) => {
                    $("#modal_registro_inci").modal('hide');
                    tbl_incidencias.ajax.reload();
                });
            }
            return Swal.fire("Mensaje de Advertencia", "Este incidencia ya esta Registrado", "warning");

        } else {
            return Swal.fire("Mensaje de Advertencia", "No se pudo registrar Incidencia ", "error");

        }
    })
}

//:::::Validar los datos al registrar:::::////
function ValidarInputRegisInci(descrip, ubi, val_descrip, val_ubi) {
    if (descrip != "") {
        if (document.getElementById(descrip).value.length > 0 ) {
            $("#" + descrip).removeClass("is-invalid").addClass("is-valid");
            $("#" + val_descrip).removeClass("invalid-feedback").addClass("valid-feedback");
            document.getElementById(val_descrip).innerHTML = '<b>DESCRIPCION CORRECTO<b>';
        }
        else {
            $("#" + descrip).removeClass("is-valid").addClass("is-invalid");
            $("#" + val_descrip).removeClass("valid-feedback").addClass("invalid-feedback");
            document.getElementById(val_descrip).innerHTML = '<b>COMPLETE EL CAMPO DESCRIPCION"</b>';
        }
    }
    if (ubi != "") {
        if (document.getElementById(ubi).value.length > 0) {
            $("#" + ubi).removeClass("is-invalid").addClass("is-valid");
            $("#" + val_ubi).removeClass("invalid-feedback").addClass("valid-feedback");
            document.getElementById(val_ubi).innerHTML = '<b>UBICACION CORRECTO</b>';
        }
        else {
            $("#" + ubi).removeClass("is-valid").addClass("is-invalid");
            $("#" + val_ubi).removeClass("valid-feedback").addClass("invalid-feedback");
            document.getElementById(val_ubi).innerHTML = '<b>LLENE ESTE CAMPO</b>';
        }
    }
    
}

function limpiar_modalIncidenciaRegistrada() {
    document.getElementById("txt_descripcion").value = "";
    document.getElementById("txt_ubicacion").value = "";
    document.getElementById("txt_fecha").value = "";
    document.getElementById("txt_hora").value = "";
    document.getElementById("txt_fotos").value = "";
    document.getElementById("valid_tipo_inci").innerHTML = '';
    document.getElementById("valid_descripcion").innerHTML = '';
    document.getElementById("valid_ubicacion").innerHTML = '';
    document.getElementById("valid_fotos").innerHTML = '';
    $('#select_tipo_inci').select2().val("").trigger('change.select2');
}

///:::::::::REGISTRAR ACCIONES->INCIDENCIA:::::::::::////
var idinci;
$('#tabla_incidencias').on('click', '.accion', function () {
    var data = tbl_incidencias.row($(this).parents('tr')).data();//Lenar datos en tamanño escritorio
    if (tbl_incidencias.row(this).child.isShown()) {
        var data = tbl_incidencias.row(this).data();
    }// Permite llenar los datos cuando es tamaño celular y usas el responsive de datable
    $('.form-control').removeClass("is-invalid").removeClass("is-valid");
    $("#modal_registro_accion").modal({ backdrop: 'static', keyboard: false });//cuando de clip al costado no se cierra
    $("#modal_registro_accion").modal('show');
    $('.modal-title').css('color', 'white');
    $('.modal-header').css('background', '#154170');
    document.getElementById('txt_id_inci_accion').value = data["inci_id"];
    let fecha_hoy = moment().format('YYYY-MM-DD'); // obtener la fecha actual en formato dd-mm-yyyy
    let hora_hoy = moment().format('YYYY-MM-DD HH:mm:ss'); // obtener la hora actual en formato yyyy-mm-dd hh:mm:ss
    document.getElementById("txt_fecha_accion").value = fecha_hoy;
    document.getElementById("txt_hora_accion").value = hora_hoy;
    
    ///ESTO ES PARA EDITAR LA CONTRA DEBIDO A QUE EL BOTON ESTA DENTRO DEL EDITAR
    idinci = document.getElementById("txt_id_inci_accion").value;
})

///:::::::::REGISTRAR ACCION:::::::::::////
function registrar_accion() {
    let id_inci = document.getElementById("txt_id_inci_accion").value;
    let descripcion = document.getElementById("txt_descripcion_accion").value;
    let fecha = document.getElementById("txt_fecha_accion").value;
    let hora = document.getElementById("txt_hora_accion").value;
    var rfotos = document.getElementById("txt_fotos_accion");
    var sin_foto = document.getElementById("check_fotos").checked;
    let fotosaccion;
    let checkf;
    //document.getElementById("valid_dni").value;
    if (descripcion.length == 0 ) {
        document.getElementById("valid_descripcion_accion").innerHTML = '<font size=2 color="red"><b>Ingresar Descripcion</b></font>';
        return Swal.fire("!Mensaje de Advertencia!", "<b>Llene todo los campos</b>", "warning");
    }
    if(sin_foto){
        fotosaccion = null;
        checkf=0;

    }else{
        if (rfotos.files.length == 0 || rfotos.value == '') {
            document.getElementById("valid_fotos_accion").innerHTML = '<font size=2 color="red"><b>SUBA FOTO PARA CONTINUAR</b></font>';
            return Swal.fire("!Mensaje de Advertencia!", "<b>El campo Fotos, se encuentra vacio, por favor suba una o más fotos</b>", "warning");
        }else
        checkf=1;
        document.getElementById("valid_fotos_accion").innerHTML = '<font size=2 color="green"><b>CORRECTO</b></font>';
        fotosaccion= document.getElementById("txt_fotos_accion").files;
    }
    
    let formData = new FormData();
    formData.append('idinci', id_inci);
    formData.append('descripcion', descripcion);
    formData.append('hora', hora);
    formData.append('fecha', fecha);
    formData.append('check', checkf);
    if(fotosaccion != null){
        // Agregar los archivos seleccionados al FormData
        for (var i = 0; i < fotosaccion.length; i++) {
            formData.append('fotosaccion[]', fotosaccion[i]);
        }
    }
    
    $.ajax({
        url: '../controller/acciones/controlador_registrar_accion.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,        
    }).done(function (resp){
        //return alert(resp);
        if (resp > 0) {
            if (resp == 1) {
                return Swal.fire("Mensaje de Confirmacion", "Nueva Incidencia Registrada", "success").then((value) => {
                    $("#modal_registro_accion").modal('hide'); // Cerrar el modal
                    Modificar_Incidencia_Estado(id_inci, 1);
                    tbl_incidencias.ajax.reload();
                });
            }
            if (resp == 2) {
                return Swal.fire("Mensaje de Advertencia", "Error a mover el archivo", "warning");
            }
            
        } else {
            return Swal.fire("Mensaje de Advertencia", "No se pudo registrar Incidencia ", "error");

        }
    })
}

