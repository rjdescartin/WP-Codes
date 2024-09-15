/*============================ *\
 ACCORDION SCRIPT
* ============================ */
$("p > .accordion").unwrap();
$(".accordion + .panel + br").remove();

$(".accordion").click(function(){
    $(".accordion").removeClass("active"); // remove active class from all accordions
    $(".accordion").next().css('max-height', '0'); // set max-height to 0 for all accordions
    $(this).addClass("active"); // add active class to clicked accordion
    var content = $(this).next();
    if(content.css("max-height") == "0px"){ // check if the max-height is 0, then open it
        content.css('max-height', content.prop('scrollHeight'));
    } else { // if the max-height is not 0 then close it
        content.css('max-height', '0');
        $(".accordion").removeClass("active");
    }
});
