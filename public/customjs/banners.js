/**untuk tampil data */
function tampilData(){
    $.ajax({
        url: 'banners/getData', 
        dataType: 'json', 
        success: function(response) { 
            $('.viewcard').html(response.data);
        },
        error: function(xhr, ajaxOptions, thrownError){
            alert(xhr.status + '\n' + xhr.responseText + '\n' + thrownError);
        }
    });
}

$(document).ready(function(e){

    tampilData();


});