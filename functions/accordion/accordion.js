/*============================ *\
 ACCORDION SCRIPT
* ============================ */
$("p > .accordion").unwrap();
$(".accordion + .panel + br").remove();

$(".accordion.active").each(function(){
    var content = $(this).next();
    content.css('max-height', content.prop('scrollHeight'));
});

$(".accordion").click(function(){
    // close all
    $(".accordion").removeClass("active");
    $(".accordion").next().css('max-height', '0');

    // toggle clicked
    $(this).addClass("active");
    var content = $(this).next();
    if(content.css("max-height") == "0px"){
        content.css('max-height', content.prop('scrollHeight'));
    } else {
        content.css('max-height', '0');
        $(this).removeClass("active");
    }
});
