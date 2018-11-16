//on cache de base l'error

//déclaration des variables 
var imageForm = $('#uploadImage'),
        imageErrors = $('.errorProfil', imageForm);

$('#userImage').on('change', function () {
    $("#uploadImage").submit();
    console.log('banana');
});

$('#uploadImage').on('submit', function (e) {
    e.preventDefault();
    //L'instruction let permet de déclarer une variable dont la portée est celle du bloc courant, éventuellement en initialisant sa valeur.
    let formData = new FormData(this);
//ajax
    $.ajax({
        type: "POST",
        url: "../ajax/ProfilImg.php",
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        dataType: 'json',
        success: function (data) {
            imageErrors.html('');
            imageErrors.hide();
            if (data['success']) {
                var file = $('#userImage')[0].files[0];
                var imagefile = file.type;
                var match = 'image/png';
                if (imagefile == match) {
                    var reader = new FileReader();
                    reader.onload = imageIsLoaded;
                    reader.readAsDataURL($('#userImage')[0].files[0]);
                }
            } else { //error
                imageErrors.show();
                $.each(data['errors'], function (id, error) {
                    imageErrors.append('<p>' + error + '</p>');
                });
            }
        }
    });
});
function imageIsLoaded(e) {
    $('label[for="userImage"]>img').attr('src', e.target.result);
}