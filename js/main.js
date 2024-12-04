//MOBILE NAV JS
$('.mobile__button').click(function(){
    $('#page__wrap').addClass('active');
    $('#page__wrap').addClass('fixed');
    $('#page__wrap .overlay').addClass('is-visible');
    $('.mobile__nav').addClass('visible');
    setTimeout(function() {
        $('.mobile__nav').addClass('zindex');
    }, 500);
    $('.mobile__nav .menu-mobile-menu-container').addClass('is-visible');

});

$('#page__wrap .overlay').click(function(){
    $('.mobile__nav .menu-mobile-menu-container').removeClass('is-visible');
    $('.mobile__nav').removeClass('zindex');
    $('#page__wrap').removeClass('active');
    $('#page__wrap .overlay').removeClass('is-visible');
    $('.mobile__nav').removeClass('visible');
    $('.mobile__nav .sub-menu').removeClass('visible');
    $('.mobile__nav__wrap .menu > li').removeClass('hidden');
    setTimeout(function() {
        $('.mobile__nav').removeClass('zindex');
        $('#page__wrap').removeClass('fixed');
    }, 300);
});

$('.mobile__nav .close').click(function(){
    $('.mobile__nav .menu-mobile-menu-container').removeClass('is-visible');
    $('.mobile__nav').removeClass('zindex');
    $('#page__wrap').removeClass('active');
    $('#page__wrap .overlay').removeClass('is-visible');
    $('.mobile__nav').removeClass('visible');
    $('.mobile__nav .sub-menu').removeClass('visible');
    $('.mobile__nav__wrap .menu > li').removeClass('hidden');
    setTimeout(function() {
        $('.mobile__nav').removeClass('zindex');
        $('#page__wrap').removeClass('fixed');
    }, 300);
});

$('.mobile__nav .menu-item-has-children > a').click(function(e) {
    e.preventDefault();
    $(this).next('.sub-menu').addClass('visible');
    $('.mobile__nav__wrap .menu > li').addClass('hidden');
});

$('.mobile__nav .nav__back').click(function(e) {
    e.preventDefault();
    $(this).parent().removeClass('visible');
    $('.mobile__nav__wrap .menu > li').removeClass('hidden');
});

//END MOBILE NAV JS

var isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ? true : false;
if(!isMobile) {
    $('body').addClass('is__desktop');
    //alert('is desktop');
} else {
    $('body').addClass('is__device');
    //alert('is device');
}

//remove p tags that surounded the shortcodes
$('p:empty').not('.wpcf7 p').remove();

//remove p tag around image tag
$("p > img").unwrap();

//remove p tag around iframe tag
$("p > iframe").unwrap();

//remove p tag around button
$("p > a.button").unwrap();

//remove p tag around faux h5
$("p > .faux-h5").unwrap();

//removes width and height attributes from images
$('img').each(function(){
    $(this).removeAttr('width');
    $(this).removeAttr('height');
});


/*============================ *\
 ACCORDION SCRIPT
* ============================ */
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

/*============================ *\
 STICKY HEADER SCRIPT
* ============================ */

$(document).ready(function() {
    // Function to update the height of .header__placeholder
    function updatePlaceholderHeight() {
        var mainHeaderHeight = $('.main__header').outerHeight();
        $('.header__placeholder').css('height', mainHeaderHeight + 'px');
    }

    // Update height immediately on DOM-ready
    updatePlaceholderHeight();

    // Update height on window load to handle any delayed content
    $(window).on('load', function() {
        updatePlaceholderHeight();
    });

    // Update height on window resize
    $(window).on('resize', function() {
        updatePlaceholderHeight();
    });

    // Add sticky class based on scroll position
    $(window).on('scroll', function() {
		var scroll = $(window).scrollTop();
		
		if (scroll >= 250) {
          $('.main__header').addClass("sticky");
        } else {
          $('.main__header').removeClass("sticky");
        }
    });
});

/* ------------------------------------------- *\
---> HTML:
    <div class="header__placeholder"></div>
    <header class="main__header" role="banner"></header>

---> CSS:
    @-webkit-keyframes smoothScroll {
        0% {
            -webkit-transform: translateY(-40px);
                    transform: translateY(-40px);
        }
        100% {
            -webkit-transform: translateY(0px);
                    transform: translateY(0px);
        }
    }
    
    @keyframes smoothScroll {
        0% {
            -webkit-transform: translateY(-40px);
                    transform: translateY(-40px);
        }
        100% {
            -webkit-transform: translateY(0px);
                    transform: translateY(0px);
        }
    }
    
    .main__header {
        display: block;
        position: absolute;
        top: 0;
        z-index: 999;
        left: 0;
        right: 0;
    }

    .main__header.sticky {
        position: fixed;
        -webkit-animation: smoothScroll .5s forwards;
                animation: smoothScroll .5s forwards;
    }

\* ------------------------------------------- */

/* ============================ *\
    SCROLL TO TOP
\* ============================ */
$(window).scroll(function() {
	if ($(this).scrollTop() >= 50) {       
		$('#return-to-top').fadeIn(200);
	} else {
		$('#return-to-top').fadeOut(200);
	}
});
$('#return-to-top').click(function() { 
	$('body,html').animate({
		scrollTop : 0  
	}, 500);
});

/* <div class="return-to-top">
    <a href="javascript:" id="return-to-top">
        <i class="fa-regular fa-chevron-up"></i>
    </a>
</div> */

/* ============================ *\
    HIDE SLICK SLIDE DOTS
\* ============================ */
$(document).ready(function() {
    $('.slick-dots').each(function() {
        if ($(this).find('li').length === 1) {
            $(this).hide();
        }
    });
});

/* ============================ *\
    WRAP CONSECUTIVE .button 
    ELEMENTS WITH 
    <div class="button-group"></div>
\* ============================ */
$(document).ready(function () {
    // Find all consecutive .button elements
    $('a.button').each(function() {
        // Check if this element is not already wrapped in a .button-group
        if (!$(this).parent().hasClass('button-group')) {
            // Collect consecutive .button elements
            var $buttons = $(this).nextUntil(':not(.button)').addBack();
            // Wrap in .button-group if there is more than one button
            if ($buttons.length > 1) {
                $buttons.wrapAll('<div class="button-group"></div>');
            }
        }
    });
});
