$(document).ready(function(){
    $('#add_item_form').submit(function(e) {
        e.preventDefault();
        const url =  '/items' 
       const fd = new FormData(this);
       $.ajax({
        url: url ,
        method: 'post',
        data: fd,
        cache: false,
        contentType: false,
        processData:false,
        dataType: 'json',
        success: function (response) {
         console.log(response.status)
        }
       });
    })
})