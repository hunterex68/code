$(document).ready(function(){
$('table').DataTable({

    'bDeferRender': true,
    'iDisplayLength': 5,
    'bRetrieve': true,

    'aaSorting': [[6, 'asc']],
    'sPaginationType': 'full_numbers',
    'oLanguage':
    {
        'sEmptyTable': '',
        'sInfo': 'Показано <b>_START_ - _END_</b> из <b>_TOTAL_</b> строк',
        'sInfoEmpty': 'Показано с 0 по 0 из 0 строк',
        'sInfoFiltered': '(Отобрано <b>_MAX_</b> строк)',
        'sInfoPostFix': '',
        'sSearch': 'Фильтр:',
        'sUrl': '',
        'sLengthMenu': 'Показано строк: _MENU_',
        'oPaginate':
        {
            'sFirst': 'Первая',
            'sLast': 'Последняя',
            'sNext': 'Следующая',
            'sPrevious': 'Предыдущая'
        }
    }//,
    //'info':d<=4?false:true,
    //'paging':d<=4?false:true,
});

    $('.dataTables_filter input').addClass('form-control');
    $('.dataTables_length select').addClass('form-control hidden-xs');
    $('.dataTables_length,.dataTables_filter').addClass('col-md-2 col-lg-2 hidden-xs');
});
$(document).on('click','.basket',function() {
    var info = $(this).attr('data-info');
    var url = $(this).attr('data-url');
    $.ajax({
        url:url,
        method:'post',
        data:'info='+info,
        success:function(res) {
            var bskt = $('#bskt');
            bskt.modal('show');
            bskt.find('.modal-body').html(res);
            calcSum();
        }});
});

function calcSum()
{
    var price = $('#price').text();
    var quan = $('#quan').val();
    var sum = quan*price;
    $('#sum').text(sum);
}

$(document).on('blur','#quan',function(){

    calcSum();

});
$(document).on('change','#quan',function(){

    calcSum();

});

function sort(group,element){

    var $elements = $(element);
    var $target = $(group);
    $elements.sort(function (a, b)
    {
        var an = $(a).attr('data-make'),
            bn = $(b).attr('data-make');

        if (an && bn)
        {
            var value =  an.toUpperCase().localeCompare(bn.toUpperCase(),'us',{
                'numeric':false
            });
            return value;
        }
        else
            return 0;
    });
    $elements.detach().appendTo($target);
}

$(document).on('click','.js-add2basket',function(){

    var url = $(this).data('url');
    var data = $('#addform').serialize();
    $.ajax({

        url:url,
        data:data,
        method:'post',
        success:function(){
            alert('success!');
        }
    })

});

$(document).on('change','#offer,#tel,#name',function() {

    var flag = true;
    var form = $('#addform');
    var name = $(form).find('#name');
    var tel  = $(form).find('#tel');
    if(name && tel)
      if(($(name).val()).length==0 || ($(tel).val()).length==0)
        flag = false;
    if($('#offer').is(':checked') && flag) {
        $('.js-add2basket').removeAttr('disabled');
    }
    else
        {
            $('.js-add2basket').attr('disabled',true);
        }

});

$(document).on('blur','#tel',function(){

    if(!/^[0-9\(\)]{12,14}/.test($(this).val()))
        $(this).val('');

});