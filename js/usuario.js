///FUNCION PARA LOGEARSE EN EL SISTEMA////
function iniciar_Sesion() {
    let usu = document.getElementById("txtUsu").value;
    let pass = document.getElementById("txtPass").value;
    if (usu.length == 0 || pass.length == 0) {

        return Swal.fire({
            icon: 'error',
            title: 'Campos sin llenar ',
        });
    }

    $.ajax({
        url: 'controller/usuario/iniciar_sesion.php',
        type: 'POST',
        data: {
            u: usu,
            p: pass,
        }

    }).done(function (resp) {
        // alert(resp);
        let data = JSON.parse(resp);// Lo convierto a un objeto el json_encode
        if (data.length > 0) {
            if (data[0]['tipo_usu'] == ' ') {
                return Swal.fire('OOPSS...', 'Lo sentimos el usuario <b>' + data[0]["usua_nombre"] + "</b> se encuentra <b>" + data[0]["tipo_usu"] + "</b>, comuniquese con el administrador", 'warning');
            }
            $.ajax({
                url: 'controller/usuario/crear_sesion.php',
                type: 'POST',
                data: {
                    id_usu: data[0][0],
                    nombre_usu: data[0][1],
                    telefono: data[0][2],
                    dni: data[0][3],
                    usua_clave: data[0][4],
                    sector: data[0][5],
                    rol: data[0][6],
                    area: data[0][7]                    
                },

            }).done(function (r) {
                let timerInterval
                Swal.fire({
                    title: 'BIENVENIDO AL SISTEMA',
                    html: 'Sera redireccionado en <b></b> milliseconds.',
                    timer: 400,
                    heightAuto: false,// para que el login no se mueva hacia arriba
                    timerProgressBar: false,
                    didOpen: () => {
                        Swal.showLoading()
                        const b = Swal.getHtmlContainer().querySelector('b')
                        timerInterval = setInterval(() => {
                            b.textContent = Swal.getTimerLeft()
                        }, 100)
                    },
                    willClose: () => {
                        clearInterval(timerInterval)
                    }
                }).then((result) => {
                    /* Read more about handling dismissals below */
                    if (result.dismiss === Swal.DismissReason.timer) {
                        location.reload();
                    }
                })
            })
        } else {
            Swal.fire('INCORRECTO', 'Usuario o Contraseña incorrectos', 'error');
        }
    })
}
///::::::FORMATO_TABLA_USUARIOS::::///
var tbl_usuario;
function listado_usu() {
    
    tbl_usuario = $("#tabla_usuario").DataTable({
        "ordering": false,
        "bLengthChange": true,
        "searching": { "regex": false },
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        "pageLength": 10,
        "destroy": true,
        "async": false,
        "processing": true,
        "ajax": {
            "url": "../controller/usuario/controlador_listar_usu.php",
            type: 'POST'
        },
        "columns": [
            { "defaultContent": "" },
            { "data": "usua_dni" },
            { "data": "usua_nombre" },
            { "data": "usua_telefono" },
            {
                "data": "usua_tipo",
                render: function (data, type, row) {

                    if (data == "ADMIN") {
                        return "<span class='badge bg-warning'>" + data + "</span>";
                    } if (data == "OPERARIO") {
                        return "<span class='badge bg-info'>" + data + "</span>";
                    }
                    else {
                        return '<span class="badge bg-secondary">' + data + '</span>';
                    }
                }

            },
            { "data": "usua_sector" },
            { "data": "usua_area" },
            {
                "data": "usua_tipo",
                render: function (data, type, row) {
                    if (data != 'ADMIN') {
                        return "<button class='editar btn btn-primary btn-sm'><i class='fa fa-edit'></i></button>&nbsp;" +
                            "<button class = 'desactivar btn btn-danger btn-sm'><i class = 'fa fa-ban'></i></button>";
                    } else {
                        return "<button class='editar btn btn-primary btn-sm'><i class='fa fa-edit'></i></button>&nbsp;" +
                            "<button class = 'btn btn-danger btn-sm' disabled><i class = 'fa fa-ban'></i></button>";
                    }
                }
            }

        ],
        "language": idioma_espanol,
        select: true
    });
    tbl_usuario.on('draw.td', function () {
        var PageInfo = $("#tabla_usuario").DataTable().page.info();
        tbl_usuario.column(0, { page: 'current' }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
        });

    });
}

///::::CARGAR AREAS:::::///
function cargar_areas_editar(){
    
    $.ajax({
        url: '../controller/usuario/controlador_listar_areas.php',
        type: 'POST',
    }).done(function (resp) {
        let data = JSON.parse(resp);
        if (data.length > 0) {
            // Obtener el elemento select
            var select = document.getElementById("select_areas_editar");
    
            // Recorrer los datos y crear las opciones del select
            for (var i = 0; i < data.length; i++) {
                var noption = document.createElement("option");
                noption.value = data[i]['area_id'];
                noption.text = data[i]['area_nombre'];
                select.appendChild(noption);
            };
        }   
    });
    }

function cargar_areas(){
        $.ajax({
            url: '../controller/usuario/controlador_listar_areas.php',
            type: 'POST',
        }).done(function (resp) {
            let data = JSON.parse(resp);
            if (data.length > 0) {
                // Obtener el elemento select
                var select = document.getElementById("select_area");
        
                // Recorrer los datos y crear las opciones del select
                for (var i = 0; i < data.length; i++) {
                    var noption = document.createElement("option");
                    noption.value = data[i]['area_id'];
                    noption.text = data[i]['area_nombre'];
                    select.appendChild(noption);
                };
            }   
        });
    }

////:::::ABRIR MODAL REGISTRO:::::://///
function abrirModalRegistroUsuario() {
    $('.form-control').removeClass("is-invalid").removeClass("is-valid");
    $("#modal_registro_usu").modal({ backdrop: 'static', keyboard: false });//cuando de clip al costado no se cierra
    $("#modal_registro_usu").modal('show');//abirir modal
    cargar_areas();
    document.getElementById("valid_tipo").innerHTML = '';
    document.getElementById("valid_area").innerHTML = '';
    $('.modal-title').css('color', 'white');
    $('.modal-header').css('background', '#154170');
}

///////:::::REGISTRAR USUARIO :::////////
function registrar_usuario() {

    let dni = document.getElementById("txt_dni").value;
    let nombre = document.getElementById("txt_nombre").value;
    let telefono = document.getElementById("txt_telefono").value;
    let sector = document.getElementById("txt_sector").value;
    let contraseña = document.getElementById("txt_contraseña").value;
    let nivel = document.getElementById("select_tipo").value;
    let area = document.getElementById("select_area").value;

    //document.getElementById("valid_dni").value;
    if (dni.length == 0 || dni.length < 8 || telefono.length == 0 || telefono.length < 9 || contraseña.length == 0 || contraseña.length < 8 || nombre.length == 0 || sector.length == 0) {
        ValidarInputRegisUsuario("txt_dni", "txt_nombre", "txt_telefono", "txt_sector", "txt_contraseña",
            "valid_dni", "valid_nombre", "valid_telefono", "valid_sector", "valid_contrasena");/// para que se me muesree lo rojo
        return Swal.fire("!Mensaje de Advertencia!", "<b>Llene todo los campos</b>", "warning");
    }

    if (nivel.length == 0) {
        document.getElementById("valid_tipo").innerHTML = '<font size=2 color="red"><b>SELECCIONE UN NIVEL PARA CONTINUAR</b></font>';
        return Swal.fire("!Mensaje de Advertencia!", "<b>El campo nivel, no se ecuentra seleccionado, por favor seleccione un nivel</b>", "warning");
    }
    document.getElementById("valid_tipo").innerHTML = '<font size=2 color="green"><b>CORRECTO</b></font>';
    if (area.length == 0) {
        document.getElementById("valid_area").innerHTML = '<font size=2 color="red"><b>SELECCIONE UN AREA PARA CONTINUAR</b></font>';
        return Swal.fire("!Mensaje de Advertencia!", "<b>El campo area, no se ecuentra seleccionado, por favor seleccione un nivel</b>", "warning");
    }
    document.getElementById("valid_area").innerHTML = '<font size=2 color="green"><b>CORRECTO</b></font>';

    $.ajax({

        url: '../controller/usuario/controlador_registrar_usuario.php',
        type: 'POST',
        data: {
            dni: dni,
            nombre: nombre,
            telefono: telefono,
            sector: sector,
            contra: contraseña,
            tipo: nivel,
            area: area
        }
    }).done(function (resp) {
        //return alert(resp);
        if (resp > 0) {
            if (resp == 1) {
                limpiar_modalUsuarioRegistrado();
                return Swal.fire("Mensaje de Confirmacion", "Nuevo Usuario Registrado", "success").then((value) => {
                    $("#modal_registro_usu").modal('hide');
                    tbl_usuario.ajax.reload();

                });
            }
            return Swal.fire("Mensaje de Advertencia", "Este usuario ya esta Registrado", "warning");

        } else {
            return Swal.fire("Mensaje de Advertencia", "No se pudor registrar el Usuario ", "error");

        }
    })
}

/*function validar_email(email) {
    var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email) ? true : false;
}*/

////:::::Validar los datos al registrar:::::////
function ValidarInputRegisUsuario(dni, nombre, telefono, sector, pass, val_dni, val_nombre, val_telefono, val_sector, val_pass) {
    if (dni != "") {
        if (document.getElementById(dni).value.length > 0 && document.getElementById(dni).value.length == 8) {
            $("#" + dni).removeClass("is-invalid").addClass("is-valid");
            $("#" + val_dni).removeClass("invalid-feedback").addClass("valid-feedback");
            document.getElementById(val_dni).innerHTML = '<b>DNI CORRECTO<b>';
        }
        else {
            $("#" + dni).removeClass("is-valid").addClass("is-invalid");
            $("#" + val_dni).removeClass("valid-feedback").addClass("invalid-feedback");
            document.getElementById(val_dni).innerHTML = '<b>COMPLETE EL CAMPO DNI"DEBE CONTENER 8 CARACTERRES"</b>';
        }
    }
    if (nombre != "") {
        if (document.getElementById(nombre).value.length > 0) {
            $("#" + nombre).removeClass("is-invalid").addClass("is-valid");
            $("#" + val_nombre).removeClass("invalid-feedback").addClass("valid-feedback");
            document.getElementById(val_nombre).innerHTML = '<b>NOMBRE CORRECTO</b>';
        }
        else {
            $("#" + nombre).removeClass("is-valid").addClass("is-invalid");
            $("#" + val_nombre).removeClass("valid-feedback").addClass("invalid-feedback");
            document.getElementById(val_nombre).innerHTML = '<b>LLENE ESTE CAMPO</b>';
        }
    }
    if (sector != "") {
        if (document.getElementById(sector).value.length > 0) {
            $("#" + sector).removeClass("is-invalid").addClass("is-valid");
            $("#" + val_sector).removeClass("invalid-feedback").addClass("valid-feedback")
            document.getElementById(val_sector).innerHTML = '<b>CORRECTO<b>';
        }
        else {
            $("#" + apepat).removeClass("is-valid").addClass("is-invalid");
            $("#" + val_apepat).removeClass("valid-feedback").addClass("invalid-feedback");
            document.getElementById(val_apepat).innerHTML = '<b>LLENE ESTE CAMPO</b>';
        }
    }
    if (telefono != "") {
        if (document.getElementById(telefono).value.length > 0 && document.getElementById(telefono).value.length == 9) {
            $("#" + telefono).removeClass("is-invalid").addClass("is-valid");
            $("#" + val_telefono).removeClass("invalid-feedback").addClass("valid-feedback");
            document.getElementById(val_telefono).innerHTML = '<b>TELEFONO CORRECTO<b>';
        }
        else {
            $("#" + telefono).removeClass("is-valid").addClass("is-invalid");
            $("#" + val_telefono).removeClass("valid-feedback").addClass("invalid-feedback");
            document.getElementById(val_telefono).innerHTML = '<b>COMPLETE EL CAMPO TELEFONO "DEBE CONTENE 9 CARACTERRES"</b>';
        }
    }
    if (pass != "") {
        if (document.getElementById(pass).value.length > 0 && document.getElementById(pass).value.length >= 8) {
            $("#" + pass).removeClass("is-invalid").addClass("is-valid");
            $("#" + val_pass).removeClass("invalid-feedback").addClass("valid-feedback")
            document.getElementById(val_pass).innerHTML = '<b>CORRECTO</b>';
        }
        else {
            $("#" + pass).removeClass("is-valid").addClass("is-invalid");
            $("#" + val_pass).removeClass("valid-feedback").addClass("invalid-feedback");
            document.getElementById(val_pass).innerHTML = '<b>LA CONTRASEÑA DEBE TENER MAS DE 8 CARACTERES</b>';
        }
    }
}

function limpiar_modalUsuarioRegistrado() {
    document.getElementById("txt_dni").value = "";
    document.getElementById("txt_nombre").value = "";
    document.getElementById("txt_telefono").value = "";
    document.getElementById("txt_sector").value = "";
    document.getElementById("txt_contraseña").value = "";
    document.getElementById("valid_tipo").innerHTML = '';
    document.getElementById("valid_area").innerHTML = '';
    $('#select_nivel').select2().val("").trigger('change.select2');
}

////:::::::::EDITAR USUSARIO:::::::::::////
var idusuc;
$('#tabla_usuario').on('click', '.editar', function () {
    var data = tbl_usuario.row($(this).parents('tr')).data();//Lenar datos en tamanño escritorio
    if (tbl_usuario.row(this).child.isShown()) {
        var data = tbl_usuario.row(this).data();
    }// Permite llenar los datos cuando es tamaño celular y usas el responsive de datable
    $('.form-control').removeClass("is-invalid").removeClass("is-valid");
    $("#modal_editar_usuario").modal({ backdrop: 'static', keyboard: false });//cuando de clip al costado no se cierra
    $("#modal_editar_usuario").modal('show');
    cargar_areas_editar();
    $('.modal-title').css('color', 'white');
    $('.modal-header').css('background', '#154170');
    document.getElementById('txt_idUsu_editar').value = data["usua_id"];
    document.getElementById('txt_dni_editar').value = data["usua_dni"];
    document.getElementById('txt_nombre_editar').value = data["usua_nombre"];
    document.getElementById('txt_telefono_editar').value = data["usua_telefono"];
    document.getElementById('txt_sector_editar').value = data["usua_sector"];
    document.getElementById('txt_contra_editar').value = data["usua_password"];
    $('#select_tipo_editar').select2().val(data["tipo_id"]).trigger('change.select2');
    $('#select_areas_editar').select2().val(data["area_id"]).trigger('change.select2');
    ///ESTO ES PARA EDITAR LA CONTRA DEBIDO A QUE EL BOTON ESTA DENTRO DEL EDITAR
    idusuc = document.getElementById("txt_idUsu_editar").value;
})

function modificar_usuario() {
    let idusu = document.getElementById("txt_idUsu_editar").value;
    let dni = document.getElementById("txt_dni_editar").value;
    let nombre = document.getElementById("txt_nombre_editar").value;
    let telefono = document.getElementById("txt_telefono_editar").value;
    let sector = document.getElementById("txt_sector_editar").value;
    let contra = document.getElementById("txt_contra_editar").value;
    let nivel = document.getElementById("select_tipo_editar").value;
    let area = document.getElementById("select_areas_editar").value;
    //let estado = document.getElementById('select_estado_editar').value;
    //return alert(contra);
    if (dni.length == 0 || dni.length < 8 || telefono.length == 0 || telefono.length < 9 || contra.length == 0 || contra.length < 8 || nombre.length == 0 || sector.length == 0) {
        ValidarInputRegisUsuario("txt_dni_editar", "txt_nombre_editar", "txt_telefono_editar", "txt_sector_editar", "txt_contra_editar",
            "valid_dni_editar", "valid_nombre_editar", "valid_telefono_editar", "valid_sector_editar", "valid_contra_editar");/// para que se me muesree lo rojo
        return Swal.fire("Mensaje de Advertencia", "tiene algunos campos vacios", "warning");
    }

    $.ajax({
        url: '../controller/usuario/controlador_modificar_usuario.php',
        type: 'POST',
        data: {
            id: idusu,
            dni: dni,
            nombre: nombre,
            telefono: telefono,
            sector: sector,
            tipo: nivel,
            area: area
        }
    }).done(function (resp) {
        //alert(resp);
        if (resp > 0) {
            if (resp == 1) {
                return Swal.fire("Mensaje de Confirmacion", "Usuario editado con éxito", "success").then((value) => {
                    $("#modal_editar_usuario").modal('hide');
                    tbl_usuario.ajax.reload();

                });
            }
            return Swal.fire("Mensaje de Advertencia", "Este DNI ya esta Registrado", "warning");

        } else {
            return Swal.fire("Mensaje de Advertencia", "No se pudo modificar el Usuario ", "error");

        }
    })
}

////::::::MODIFICAR PASSWORD:::::////
function abrirmodal_modificarcontra() {
    /* var data = tbl_usuario_simple.row($(this).parents('tr')).data();//Lenar datos ne tamanño escirtorio
    if (tbl_usuario_simple.row(this).child.isShown()) {
        var data = tbl_usuario_simple.row(this).data();
    }// Permite llear los datos cuando es tamaño celular y usas el responsive de datable*/
    $("#modal_editar_contra").modal({ backdrop: 'static', keyboard: false });//cuando de clip al costado no se cierra
    $("#modal_editar_contra").modal('show');
    document.getElementById('idUsuarioContra').value = idusuc;
    
}

function modificar_contra_usuario() {
    let idusu = document.getElementById('idUsuarioContra').value;
    let contran = document.getElementById('txt_contra_nueva').value;
    let contrar = document.getElementById('txt_contra_repetir').value;
    if (contran.length == 0 || contrar.length == 0) {
        inputvalidarcontra("", "txt_contra_nueva", "txt_contra_repetir");
        return Swal.fire("Mensaje de Advertencia", "llene todos los campos", "warning");
    }
    if (contran != contrar) {
        return Swal.fire("Mensaje de Advertencia", "Las contraseñas no coinciden", "warning");
    }
    $.ajax({
        url: '../controller/usuario/controlador_modificar_contra_usuario.php',
        type: 'POST',
        data: {
            idusu: idusu,
            contran: contran
        }
    }).done(function (resp) {
        //alert(resp);
        if (resp > 0) {
            if (resp == 1) {
                return Swal.fire("Mensaje de Confirmacion", "Contraseña editada con éxito", "success").then((value) => {
                    $("#modal_editar_contra").modal('hide');
                    $("#modal_editar_usuario").modal('hide');
                    tbl_usuario_simple.ajax.reload();

                });
            }
            return Swal.fire("Mensaje de Advertencia", "Este DNI ya esta Registrado", "warning");

        } else {
            return Swal.fire("Mensaje de Advertencia", "No se pudo modificar la contraseña ", "error");

        }
    })
}

function inputvalidarcontra($contrac, $contran, $contrar) {
    if ($contrac != "") {
        if (resp != "" && resp.length == 0) {
            $("#" + $contrac).removeClass("is-invalid").addClass("is-valid");
        }
        else {
            $("#" + $contrac).removeClass("is-valid").addClass("is-invalid");
        }
    }
    if ($contran != "") {
        if (document.getElementById($contran).value.length > 0) {
            $("#" + $contran).removeClass("is-invalid").addClass("is-valid");
        }
        else {
            $("#" + $contran).removeClass("is-valid").addClass("is-invalid");
        }
    }
    if ($contrar != "") {
        if (document.getElementById($contrar).value.length > 0) {
            $("#" + $contrar).removeClass("is-invalid").addClass("is-valid");
        }
        else {
            $("#" + $contrar).removeClass("is-valid").addClass("is-invalid");
        }
    }
}
