/**
 * Created by HOME on 14.09.2016.
 */
$(document).ready(
    function() {

        $("#sandwich, .menu_item").on("click", function () {
            $("#sandwich").toggleClass("active");
        });

        /*$("#title").waypoint(function (direction) {
            
            if (direction == "down") {

                $('#title').addClass('fadeInDown animated');
            }
            else if (direction === "up") {
                $('#title').removeClass('fadeInDown animated');
            }

        }, {offset: 200});

        $("#toptitle").waypoint(function (direction) {

            if (direction == "down") {

                $('#toptitle').addClass('animated fadeInDown');
            }
            else if (direction === "up") {
                $('#toptitle').removeClass('animated fadeInDown');
            }
         }, {offset: "100%"});*/
    });

/*
 function testAnim(x) {
 $('#animationSandbox').removeClass().addClass(x + ' animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
 $(this).removeClass();
 });
 };

 $(document).ready(function(){
 $('.js--triggerAnimation').click(function(e){
 e.preventDefault();
 var anim = $('.js--animations').val();
 testAnim(anim);
 });

 $('.js--animations').change(function(){
 var anim = $(this).val();
 testAnim(anim);
 });
 });*/