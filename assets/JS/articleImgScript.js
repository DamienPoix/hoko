//déclaration des variables 
var articleImage = $('#postArticle');

$('#articlePicture1').on('change', function () {
    $("#postArticle").submit();
});

$('#articlePicture2').on('change', function () {
    $("#postArticle").submit();
});

$('#articlePicture3').on('change', function () {
    $("#postArticle").submit();
});

$('#articlePicture4').on('change', function () {
    $("#postArticle").submit();
});

$('#articlePicture5').on('change', function () {
    $("#postArticle").submit();
});
$('#postArticle').on('submit', function (e) {
    //ajax
    $.ajax({
        type: "POST",
        url: "../ajax/ProfilImg.php",
        data: {
            articlePicture1: $('#articlePicture1').val(),
            articlePicture2: $('#articlePicture2').val(),
            articlePicture3: $('#articlePicture3').val(),
            articlePicture4: $('#articlePicture4').val(),
            articlePicture5: $('#articlePicture5').val()
        },
        contentType: false,
        cache: false,
        processData: false,
        dataType: 'json',
        success: function(data){
            if(data['success']){
                var file = $('#articlePicture1, articlePicture2, articlePicture3, articlePicture4, articlePicture5')[0].files[0];
            }
        }
    });
});