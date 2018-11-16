$(document).ready(function () {
    var key = '';
    $('#passwordConnexion').keypress(function (e) {
        e.preventDefault();
        console.log(e.key);
        if (e.key.length == 1) {
            key = key + e.key;
            $(this).val($(this).val() + '•');
        } else if (e.key == 'Backspace') {
            key = key.slice(0, -1);
            $(this).val($(this).val().slice(0, -1));
        }
    });
    //
    $('#errorMessage').hide();
    $('#loginForm').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: '../ajax/loginAjax.php',
            type: 'POST',
            data: {
                passwordConnexion: key,
                usernameConnexion: $('#usernameConnexion').val()
            },
            dataType: 'json', //le type de donnée a recevoir
            success: function (data) {
                if (data['success'] === true) { //il n'y a pas d'erreur
                    $('#modalAccount').modal('close');
                    M.toast({html: 'connexion réussi!!'});
                    $('#errorMessage').hide();
                    //redirection vers la page d'accueil
                    document.location.href = 'home';
                } else {
                    $('#errorMessage').show();
                }
            }
        });
    });


    $('#loginForm').on('submit', function (e) {
        $.ajax({
            url: '../ajax/loginAjax.php',
            type: 'GET',
            data: new FormData(this),
//            contentType: false,
//            cache: false,
//            processData: false,
            dataType: 'json', //le type de donnée a recevoir
            success: function (data) {
                if (data['disconnect'] === true) { //il n'y a pas d'erreur
                    M.toast({html: 'connexion réussi!!'});
                    $('#modalAccount').modal('close');
                } else {
                    $('#errorMessage').show();
                }
            }
        });
    });
});
