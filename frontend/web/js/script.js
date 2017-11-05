/**
 * Created by HOME on 14.09.2016.
 */

//$('#uplPrice').on('submit', $.fancybox.showLoading());

$(document).ready( function() {

    $('.r1').on('affix.bs.affix',function(){

        $(this).css('display','none');

    });

    $(document).on('submit','.searchForm2',function(e){

        e.preventDefault();
        var urls = [];
        var data = $('#searchForm').serialize();
        $.ajax({
         url:'/site/suppliers',
            method:'post',
            async:false,
            success:function(res){
                if(res.success)
                    $.each(res.listUrls,function(i,item){
                        urls.push({
                            url: item.Url,
                            data: item.data,
                            res:''
                        });
                    });
            }
        });
        $.each(urls,function(i,item){
            var i = 1;
            $.ajax({

                url:item.Url,
                data:item.data,
                mehod:'post',
                success:function(res){
                    console.log(i++);
                    result.push(res);
            }

            });
            while (result.length<urls.length)
                continue;
            console.log(result);

        });


    });

});

