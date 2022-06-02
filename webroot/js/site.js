$(document).ready(function(){
	$('form#FormUsuarios').submit(function(e){
		e.preventDefault();
		//var _csrfToken = $('input#_csrfToken').val();
		var IdUsuarios = null;
		if(typeof $('form#FormUsuarios input#IdUsuarios').val() !== "undefined"){
			IdUsuarios = $('form#FormUsuarios input#IdUsuarios').val();
		}
		var NumeroDocumentoIdentidad = $('form#FormUsuarios input#NumeroDocumentoIdentidad').val();
		var Nombres = $('form#FormUsuarios input#Nombres').val();
		var Apellidos = $('form#FormUsuarios input#Apellidos').val();
		var CorreoElectronico = $('form#FormUsuarios input#CorreoElectronico').val();
		var IdRoles = $('form#FormUsuarios select#IdRoles').val();
		var Estado = $('form#FormUsuarios select#Estado').val();
		var Password = null;
		if(typeof $('form#FormUsuarios input#Password').val() !== "undefined"){
			Password = $('form#FormUsuarios input#Password').val();
		}

		$.ajax({
			headers: {
		        'X-CSRF-Token': csrfToken
		    },
			type: "POST",
			url: 'guardar',
			dataType: 'json',
			async: false,
			data: {
				//'_csrfToken': _csrfToken, 
				'IdUsuarios': IdUsuarios,
				'NumeroDocumentoIdentidad': NumeroDocumentoIdentidad,
				'Nombres': Nombres,
				'Apellidos': Apellidos,
				'CorreoElectronico': CorreoElectronico,
				'IdRoles': IdRoles,
				'Estado': Estado,
				'Password': Password,
			},
			beforeSend: function () {
			},
			success: function (data) {
				if(data.Estado == 1){
					alert(data.Mensaje);
					//Redirigir al index
					window.location.href = '../usuarios';
				}else{
					alert(data.Mensaje);
				}
			},
			complete: function () {

			}
		});
	});

	$('form#FormCambioContrasena').submit(function(e){
		e.preventDefault();

		var IdUsuarios = $('form#FormCambioContrasena input#IdUsuarios').val();
		var Password = $('form#FormCambioContrasena input#Password').val();
		var Password2 = $('form#FormCambioContrasena input#Password2').val();

		$.ajax({
			headers: {
		        'X-CSRF-Token': csrfToken
		    },
			type: "POST",
			url: 'guardar-contrasena',
			dataType: 'json',
			async: false,
			data: {
				'IdUsuarios': IdUsuarios,
				'Password': Password,
				'Password2': Password2,
			},
			beforeSend: function () {
			},
			success: function (data) {
				if(data.Estado == 1){
					alert(data.Mensaje);
					//Redirigir al index
					window.location.href = '../usuarios';
				}else{
					alert(data.Mensaje);
				}
			},
			complete: function () {

			}
		});

	});
});


function CargarDiv(NombreDiv, TipoCargue, Url, Parametros) {
    $("div#" + NombreDiv).html('');
    if (TipoCargue == 1) {
        $("#loading").show();
        $("div#" + NombreDiv).load($('#urlBase').val() + Url, Parametros, function () {
            $("#loading").hide();
        });
    } else if (TipoCargue == 2) {
        $("div#" + NombreDiv).html(Url);
    }
}

function CargarModal(NombreModal, TipoCargue, Url, Parametros, TituloModal = null, MostrarBotonesFooter = true, MostrarOpcionCerrarSuperior = true, FooterDefecto = false) {
    $("#" + NombreModal).modal({backdrop: 'static', keyboard: false, show: true});
    $("#" + NombreModal + '>.modal-dialog>.modal-content>.modal-header>h4.modal-title').html('');
    if (TituloModal != null) {
        $("#" + NombreModal + '>.modal-dialog>.modal-content>.modal-header>h4.modal-title').html(TituloModal);
    }

    $("#" + NombreModal + '>.modal-dialog>.modal-content>.modal-body').html('');
    if (TipoCargue == 1) {
        $("#loading").show();
        $("#" + NombreModal + '>.modal-dialog>.modal-content>.modal-body').load($('#urlBase').val() + Url, Parametros, function () {
            $("#loading").hide();
        });
    } else if (TipoCargue == 2) {
        $("#" + NombreModal + '>.modal-dialog>.modal-content>.modal-body').html(Url);
    }

    if (!FooterDefecto) {
        if (!MostrarBotonesFooter) {
            $("#" + NombreModal + '>.modal-dialog>.modal-content>.modal-footer').html('');
        } else {
            $("#" + NombreModal + '>.modal-dialog>.modal-content>.modal-footer').html('<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>');
        }
    }

    if (!MostrarOpcionCerrarSuperior) {
        $("#" + NombreModal + '>.modal-dialog>.modal-content>.modal-header>button.close').html('');
    } else {
        $("#" + NombreModal + '>.modal-dialog>.modal-content>.modal-header>button.close').html('x');
    }

    if (TipoCargue == 2) {
        $("#loading").hide();
    }

    $("#" + NombreModal).modal({backdrop: 'static', keyboard: false, show: true});
}

function soloNumeros(e) {
    var keynum = window.event ? window.event.keyCode : e.which;
    if (keynum == 8)
        return true;

    return /\d/.test(String.fromCharCode(keynum));
}

function Mayusculas(e) {
    return e.value = e.value.toUpperCase();
}

function CerrarTodosModals() {
    $("#loading").show();
    $('.modal').each(function () {
        $(this).modal('hide');
    });
    $("#loading").hide();
    $('html>body').css({'padding-right': '0px'});
}

function EliminarUsuario(IdUsuarios){
	eliminar=confirm("¿Deseas eliminar este registro?");

	if(eliminar){
		$.ajax({
			headers: {
		        'X-CSRF-Token': csrfToken
		    },
			type: "POST",
			url: 'usuarios/eliminar',
			dataType: 'json',
			async: false,
			data: {
				'IdUsuarios': IdUsuarios,
			},
			beforeSend: function () {
			},
			success: function (data) {
				console.log(data);

				if(data.Estado == 1){
					alert(data.Mensaje);
					//Redirigir al index
					window.location.reload();
				}else{
					alert(data.Mensaje);
				}
			},
			complete: function () {

			}
		});
	}
}