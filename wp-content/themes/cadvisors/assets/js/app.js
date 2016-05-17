jQuery(document).foundation();
jQuery('.slick').slick({
    autoplay: true,
    infinite: true,
    speed: 500,
    fade: true,
    cssEase: 'linear',
    arrows: false,
    pauseOnHover: false
});

if(jQuery('body.home').length) {
    var progress = false;
    jQuery('.home-slider__bullets__bullet').on('click', function(){
        if(progress) {
            return false;
        }

        var id = '#' + jQuery(this).attr('data-slide');
        var list = jQuery(this).parent('li');

        if(jQuery(this).hasClass('active')) {
            console.log("is current slide. doing nothing");
            return false;
        }

        progress = true;

        jQuery('.home-slider__bullets__bullet.active').removeClass('active');
        jQuery(this).addClass('active');
        jQuery(id).addClass('next');

        jQuery('.home-slider__slide.active').fadeOut(250, function(){
            jQuery('.home-slider__slide.active').removeClass('active').addClass('background').show();
            jQuery(id).removeClass('next').addClass('active');
            progress = false;
        });
        return false;
    });
}