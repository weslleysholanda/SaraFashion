//Banner
$('.slide-banner').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: true,
    dots: false,
    autoplaySpeed: 2000,
});


$(document).ready(function() {
    $('.marcas-logo').slick({
        infinite: true,
        slidesToShow: 4, 
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        arrows: false, 
        dots: false,   
    });
});

