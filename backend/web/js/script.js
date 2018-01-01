$(document).on('click', '.viewModal', function() {

    var url = $(this).attr('data-url');
    $.get(url, function(r){

        $('#popup').modal('show');
        $('.modal-content').html(r);

    });
    return false;
});

$(document).on('click','.js-exit',function(){

    $.ajax({
            url: 'site/logout',
            method: 'post',
            beforeRequest:function(){},
            complete:function(){},
            success:function(res){
                alert(res);
            },
            error:function(x,err,code){}

        });

})