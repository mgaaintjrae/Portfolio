console.log("hello");

// PARALLAX HEADER
const parallax = document.querySelector('.parallax');

window.addEventListener('scroll', () => {
    parallax.style.backgroundPositionY = -window.scrollY / 4 + "px";
});


//ANIMATE PROJECT
$(document).ready(function(){
    $(window).on('scroll', function () {
    
    var elmt   = $('.from-left, .from-right');
    var topImg = $('.from-left, .from-right').offset().top;
    var scroll = $(window).scrollTop();
    
        $(elmt).each(function() {
            
            var topImg = $(this).offset().top - 300;
            
                if ( topImg < scroll ) {
                
                $(this).css("transform", "translate(0,0)");
                $(this).css("opacity", "1");
                
                };
        });
    });
});