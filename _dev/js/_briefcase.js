(function($) {
    $(window).on('load', function() {
        $('.hero__slides').slick({
            infinite: true,
            autoplay: true,
            dots: false,
            autoplaySpeed: 5000,
            arrows: false
        }); 

        $(window).on('scroll', function(event) {    
            if (0 < window.scrollY) {
              $('.major-container--header').addClass('stucky');
            } else {
              $('.major-container--header').removeClass('stucky');
            }
        });
    }) 
})(jQuery);
