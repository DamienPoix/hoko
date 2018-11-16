//script pour initialiser la sidnav pour la version mobile
$(document).ready(function () {
    $('.sidenav').sidenav();
});
//script pour initier la modal d'inscription
$(document).ready(function () {
    $('.modal').modal();
});
//script pour les select 
$(document).ready(function () {
    $('select').formSelect();
});
//script pour le dropdown
$(document).ready(function () {
    $('.dropdown-trigger').dropdown();
    var elem = document.querySelector('.menu_trigger');
    var instance = M.Dropdown.init(elem, {
        constrainWidth: false,
    });
});
//script pour les formulaire pour les faire apparaitre et disparaitre
$(document).ready(function () {
    $("#registerForm").hide();
    $(".formVisibilty").click(function () {
        if ($("#registerForm").is(":visible")) {
            $("#registerForm").hide();
            $("#connectForm").show();
        } else {
            $("#registerForm").show();
            $("#connectForm").hide();
        }
    });
});