function sendFile(file) {

    if (window.FormData === undefined) {
        alert('FormData не оддерживаетя!');
    }

    var uri = "http://partcom.adv/stock/upl";
    /*var xhr = new XMLHttpRequest();
    var fd = new FormData(document.getElementById("frm"));
    fd.append("myF", file,'111');
    console.log(file,fd);
    xhr.open("POST", uri, true);
    xhr.onreadystatechange = function ()
    {
        if (xhr.readyState == 4 && xhr.status == 200)
        {
            alert(xhr.responseText); // handle response.
        }
        else
        {
           // alert(xhr.responseText);
        }
    };
    xhr.send(fd);*/

    var http = new XMLHttpRequest(); // Создаем объект XHR, через который далее скинем файлы на сервер.

    // Процесс загрузки
    if (http.upload && http.upload.addEventListener) {

        http.upload.addEventListener( // Создаем обработчик события в процессе загрузки.
            'progress',
            function(e) {
                if (e.lengthComputable) {
                    // e.loaded — сколько байтов загружено.
                    // e.total — общее количество байтов загружаемых файлов.
                    // Кто не понял — можно сделать прогресс-бар :-)
                }
            },
            false
        );

        http.onreadystatechange = function () {
            // Действия после загрузки файлов
            if (this.readyState == 4) { // Считываем только 4 результат, так как их 4 штуки и полная инфа о загрузке находится
                if(this.status == 200) { // Если все прошло гладко

                    // Действия после успешной загрузки.
                    // Например, так
                    alert($.parseJSON(this.response));
                    // можно получить ответ с сервера после загрузки.
                    //alert(xhr.responseText); // handle response.
                } else {
                    // Сообщаем об ошибке загрузки либо предпринимаем меры.
                }
            }
        };

        http.upload.addEventListener(
            'load',
            function(e) {
                // Событие после которого также можно сообщить о загрузке файлов.
                // Но ответа с сервера уже не будет.
                // Можно удалить.
            });

        http.upload.addEventListener(
            'error',
            function(e) {
                // Паникуем, если возникла ошибка!
            });
    }

    var form = new FormData(); // Создаем объект формы.
    //form.append('path', '/'); // Определяем корневой путь.
    //for (var i = 0; i < files.length; i++) {
        form.append('file', file); // Прикрепляем к форме все загружаемые файлы.
    console.log(file,form);
    http.open('POST', "http://partcom.adv/stock/upl"); // Открываем коннект до сервера.
    http.send(form);// И отправляем форму, в которой наши файлы. Через XHR.

}


function drop_handler(ev) {
    //console.log("Drop");
    ev.stopPropagation();
    ev.preventDefault();
    // If dropped items aren't files, reject them
    var files = ev.dataTransfer.files;

        // Use DataTransferItemList interface to access the file(s)
        for (var i = 0,f; f=files[i]; i++) {
            //console.log(f);
                //var f = dt.items[i].getAsFile();
                //console.log("... file[" + i + "].name = " + f.name);
                sendFile(f);

        }
    /*} else {
        // Use DataTransfer interface to access the file(s)
        for (var i = 0; i < dt.files.length; i++) {
            //console.log("... file[" + i + "].name = " + dt.files[i].name);
            sendFile(dt.files[i]);
        }
    }*/
}

/*
 *
 * В первой строке задан возможный тип перетаскивания — move, во второй — устанавливаются данные процесса — тип (Text) и ID. В третьей строке setDragImage определяет положение курсора, в данном случае в середине квадрата 200х200 пикселей.
 *
 * */


function dragStart(ev) {
    ev.dataTransfer.effectAllowed = 'move';
    ev.dataTransfer.setData("Text", ev.target.getAttribute('id'));
    ev.dataTransfer.setDragImage(ev.target, 100, 100);
    return true;
}
function dragover_handler(ev) {
    //console.log("dragOver");
    // Prevent default select and drag behavior
    ev.preventDefault();
}
function dragend_handler(ev) {
    //console.log("dragEnd");
    // Remove all of the drag data
    var dt = ev.dataTransfer;
    if (dt.items) {
        // Use DataTransferItemList interface to remove the drag data
        for (var i = 0; i < dt.items.length; i++) {
            dt.items.remove(i);
        }
    } else {
        // Use DataTransfer interface to remove the drag data
        ev.dataTransfer.clearData();
    }
}
target = document.getElementById('foo')
$(document).on('pjax:send', function() {

    var opts = {
        lines: 15 // The number of lines to draw
        , length: 33 // The length of each line
        , width: 5 // The line thickness
        , radius: 21 // The radius of the inner circle
        , scale: 1 // Scales overall size of the spinner
        , corners: 0.2 // Corner roundness (0..1)
        , color: '#000' // #rgb or #rrggbb or array of colors
        , opacity: 0 // Opacity of the lines
        , rotate: 48 // The rotation offset
        , direction: 1 // 1: clockwise, -1: counterclockwise
        , speed: 1 // Rounds per second
        , trail: 56 // Afterglow percentage
        , fps: 20 // Frames per second when using setTimeout() as a fallback for CSS
        , zIndex: 2e9 // The z-index (defaults to 2000000000)
        , className: 'spinner' // The CSS class to assign to the spinner
        , top: '54%' // Top position relative to parent
        , left: '50%' // Left position relative to parent
        , shadow: false // Whether to render a shadow
        , hwaccel: false // Whether to use hardware acceleration
        , position: 'absolute' // Element positioning
    }

    spinner = new Spinner(opts).spin(target);
})
$(document).on('pjax:complete', function() {
    $(target).empty();
});

