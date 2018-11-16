//
$(document).ready(function () {
    //
    var keyp = '';
    $('#password').keypress(function (e) {
        e.preventDefault();
        console.log(e.key);
        if (e.key.length == 1) {
            keyp = keyp + e.key;
            $(this).val($(this).val() + '•');
        } else if (e.key == 'Backspace') {
            keyp = keyp.slice(0, -1);
            $(this).val($(this).val().slice(0, -1));
        }
    });
    //
    $("#formRegister").on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: '../ajax/registerAjax.php', // La ressource ciblée
            type: 'POST', //le type de la requete
             data: {
                password: keyp,
                lastname: $('#lastname').val(),
                firstname: $('#firstname').val(),
                birthdate: $('#birthdate').val(),
                idCivility: $('#idCivility').val(),
                mail: $('#mail').val(),
                phone: $('#phone').val(),
                username: $('#username').val(),
                userType: $('#userType').val()
            },
//            contentType: false,
//            cache: false,
//            processData: false,
            dataType: 'json', //le type de donnée a recevoir
            success: function (data) {
                console.log(data['success']);
                if (data['success'] == 1){ //inscription réussi
                    $('#modalAccount').modal('close');
                    M.toast({html: 'Inscription validée!!'});
                    document.location.href = 'home';
                } else {
                    M.toast({html: 'une erreur s\'est produite à l\'envoi du formulaire'});
                }
            }
        });
    });
    $('#formRegister input').each(function (index) {
        $(this).focusout(function () {
            var name = $(this).attr('name');
            $.ajax({
                url: '../ajax/verifRegister.php', // La ressource ciblée
                type: 'POST', //le type de la requete
                data: {
                    value: $(this).val(),
                    name: name
                },
                dataType: 'json', //le type de donnée a recevoir
                success: function (formError) {
                    if (formError[name]) {
                        //
                        $('label[for=\'' + name +'\']').next().html(formError[name]);
                        //
                    } else {
                        //
                        $('label[for=\'' + name +'\']').next().html('');
                        //
                    }
                }
            });
        });
    });



});