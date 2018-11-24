//script pour initialiser la sidnav pour la version mobile
$(document).ready(function () {
    $('.sidenav').sidenav();
//script pour initier la modal d'inscription
    $('.modal').modal();
//script pour les select 
    $('select').formSelect();
//script pour le dropdown
    $('.dropdown-trigger').dropdown();
//script pour le calculer le nombre de caractères
    $('textarea#descArticle').characterCounter();
//script pour les formulaire pour les faire apparaitre et disparaitre
    $("#registerForm").hide();
    $("#errorNotConnect").hide();
    $(".formVisibilty").click(function () {
        if ($("#registerForm").is(":visible")) {
            $("#registerForm").hide();
            $("#connectForm").show();
        } else {
            $("#registerForm").show();
            $("#connectForm").hide();
        }
    });
    //permet de switch sur la modal et d'afficher le message d'erreur quand on est pas connecter et qu'on clique sur le bouton ajouter un article
    $('#addArticleNotConnected').click(function () {
        $('#modalAccount').modal('open');
        $("#errorNotConnect").show();
    });
});