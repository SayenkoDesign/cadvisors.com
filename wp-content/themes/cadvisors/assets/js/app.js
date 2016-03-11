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

(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-74873201-1', 'auto');
ga('send', 'pageview');

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