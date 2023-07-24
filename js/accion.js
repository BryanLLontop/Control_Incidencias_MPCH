///::::CARGAR ACCIONES:::::
function cargar_acciones_incidencia(id, fechainci) {
    $.ajax({
        url: '../controller/acciones/controlador_listar_acciones.php',
        type: 'POST',
        data: {
            id: id
        }
        }).done(function (resp) {
        let data = JSON.parse(resp);
        let fechan=fechainci; 
        let hora;
        let miDiv;
        let contenido;
        let fotos;
        let rutasacci;
        if (data.length > 0) {
            // Recorrer los datos utilizando un bucle for
            for (let i = 0; i < data.length; i++) {
                hora = data[i]["acci_hora"];
                if(data[i]["acci_fecha"]!=fechan){
                    miDiv=document.getElementById("acciones");
                    contenido = miDiv.innerHTML;
                    document.getElementById("acciones").innerHTML = contenido + 
                    '<div class="time-label" bis_skin_checked="1">'+
                    '<span class="bg-red">'+data[i]["acci_fecha"]+'</span>'+
                    '</div>';
                    fechan=data[i]["acci_fecha"];
                }
                miDiv=document.getElementById("acciones");
                contenido = miDiv.innerHTML;
                fotos = "";
                rutasacci = data[i]["acci_imagen"];
                if(rutasacci!=null){
                let rutasSeparadas = rutasacci.split(',');
                // Trabajar con cada ruta de imagen por separado
                    for (let i = 0; i < rutasSeparadas.length; i++) {
                    // Imprimir cada ruta de imagen en la consola -- https://www.munichiclayo.gob.pe/IncidenciasMPCH/img/fotos_acciones/
                        fotos = fotos + ' <img src="http://localhost:3000/img/fotos_acciones/'+rutasSeparadas[i]+'"'+' width="150" height="100" alt=""> ';
                    }
                } 
                    document.getElementById("acciones").innerHTML = contenido + 
                    '<div bis_skin_checked="1"> <i class="fas fa-user bg-green"></i> <div class="timeline-item" bis_skin_checked="1">'+
                    '<span class="time"><i class="fas fa-clock"></i> '+hora.substring(hora.length - 8)+' </span>'+
                    '<h3 class="timeline-header"><a href="#">'+data[i]["usua"] +
                    '</a> - registró acción</h3>'+ 
                    '<div class="timeline-body" bis_skin_checked="1">'+ fotos
                    +'<div bis_skin_checked="1">'+data[i]["acci_descripcion"]+'</div>'
                    +'</div></div></div>';
                fotos="";
            }
        } else {
            console.log("La variable data está vacía");
        }
        //Fin de las acciones
        miDiv=document.getElementById("acciones");
        contenido = miDiv.innerHTML;
        document.getElementById("acciones").innerHTML = contenido + 
        '<div bis_skin_checked="1">'+
        '<i class="fas fa-clock bg-gray"></i>'+
        '</div>';
        });
    }
