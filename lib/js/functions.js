function generateAlertRequired(input,grouped)
{
    input.addClass(field_required_class);
    if(grouped == true)
    {
        if(input.parents('.input-group').siblings('.'+container_required_class).length == 0)
            input.parents('.input-group').after(field_required_alert);
    }
        
    else
    {
        if(input.parents('.x').siblings('.'+container_required_class).length == 0)
            input.parents('.x').after(field_required_alert);
    }
        
}

function kickAlertStatus(input,grouped)
{
    if(input.val() != "")
    {
        input.removeClass(field_required_class);
        if(grouped == true)
            input.parents('.input-group').siblings('.'+container_required_class).remove();
        else 
            input.parents('.x').siblings('.'+container_required_class).remove();
    }
}

var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = window.location.search.substring(1),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
        }
    }
};

$(document).ready(function(){

    $('a.actLoader').click(function(){
        var href = $(this).attr('href');

        // Don't follow the link
        event.preventDefault();
    
        // Do the async thing
        $('.loadingOFV').removeClass('d-none');
        window.location = href;
        
    });

    $('#btnLogValidate').click(function(){
        
        var fielduser = $('.fielduser');
        var fieldpass = $('.fieldpass');
        var responseCaptcha = grecaptcha.getResponse();

        if(fielduser.val() == "") generateAlertRequired(fielduser,true);
        if(fieldpass.val() == "") generateAlertRequired(fieldpass,true);
        if(responseCaptcha.length == 0) generateAlertRequired(true);
        
        if($('.'+field_required_class).length == 0)
        {
            $('#btnLogValidate').prop('disabled', true);
            $("#btnLogValidate").html('Cargando <i class="fas fa-spinner"></i>');
            var data = {"user":fielduser.val(),"pass":fieldpass.val()};
            $.post( global_url+"authLoginRequest",data, function(response) {
                $('#btnLogValidate').prop('disabled', false);
                $("#btnLogValidate").html("Ingresar");
                var statusAuth = response;                    
                if(statusAuth.result == "errorAccess") alertify.alert('<span class="text-danger"><i class="fas fa-exclamation-circle"></i> Aviso!</span>', 'Usuario y/o contraseña incorrectas!');
                if(statusAuth.result == "noFoundUser") alertify.alert('<span class="text-danger"><i class="fas fa-exclamation-circle"></i> Aviso!</span>', 'usuario invalido, Contacta al Administrador!');
                if(statusAuth.result == "offUserAccess") alertify.alert('<span class="text-danger"><i class="fas fa-exclamation-circle"></i> Aviso!</span>', 'El usuario se encuentra Inactivo, Contacta al Administrador!');
                if(statusAuth.result == "errorDuringAccess" || statusAuth.result == "empty") alertify.alert('<span class="text-danger"><i class="fas fa-exclamation-circle"></i> Aviso!</span>', 'Error en el servidor, Contacta al Administrador!');
                console.log(statusAuth);
                if(statusAuth.result == "successAccess") window.location.reload();
                fieldpass.val('');
            });
        }
    });

    $('#btnLogChangePsw').click(function(){
        
        var fieldactual = $('.fieldactual');
        var fieldnew = $('.fieldnew');
        var fieldconfirm = $('.fieldconfirm');

        if(fieldactual.val() == "") generateAlertRequired(fieldactual,true);
        if(fieldnew.val() == "") generateAlertRequired(fieldnew,true);
        if(fieldconfirm.val() == "") generateAlertRequired(fieldconfirm,true);

        if($('.'+field_required_class).length == 0)
        {
            if(fieldconfirm.val() == fieldnew.val())
            {
                var data = {"fieldactual":fieldactual.val(),"fieldnew":fieldnew.val()};
                $.post( global_url+"authChangePswRequest",data, function(response) {
                    
                    var statusAuth = response;                    
                    if(statusAuth.result == "fatal error") alertify.alert('<span class="text-danger"><i class="fas fa-exclamation-circle"></i> Aviso!</span>', 'Hubo un fatal error en el proceso de cambiar contraseña, code: CC98');
                    else if(statusAuth.result == "error"){
                        alertify.alert('<span class="text-danger"><i class="fas fa-exclamation-circle"></i> ERROR!</span>', 'Error: No puede ser la misma clave!');
                        fieldnew.val("");
                        fieldconfirm.val("");
                    }
                    else if(statusAuth.result == "not equals found"){
                        fieldactual.val("");
                        changeTextFieldAlert("Clave actual incorrecta!");
                        generateAlertRequired(fieldactual,true);
                        restoreTextFieldAlert();
                    }
                    else if(statusAuth.result == "success")
                    {
                        alertify.alert('<span class="text-success"><i class="fas fa-success"></i> Felicidades!</span>', 'Se ha actualizado la clave de acceso correctamente').set({ onclose:function(){ window.location.reload();}}); 
                        
                    }
                    else console.log("empty");
                });
            }
            else
            {
                changeTextFieldAlert("Las Contraseñas no coinciden!");
                generateAlertRequired(fieldconfirm,true);
                restoreTextFieldAlert();
            }            
        }
    });
    
    $('.kickerror').keyup(function(){
        var field = $(this);
        kickAlertStatus(field,true);
    });

    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });

    $('.list-item-sidemenu').click(function(){
        $(".dataload").load($(this).attr('target'));
    });

    $(".btnActiveButton").keypress(function(event) { 
        if (event.keyCode === 13) { 
            $('button.pressActive').click(); 
        } 
    });
});