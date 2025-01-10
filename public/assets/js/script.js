//Inicialização AOS
AOS.init();
//preloader
(function ($) {
    "use strict"; //Ativa o modo estrito do JavaScript dentro da função

    var $window = $(window);

    $window.on('load', function () {
        $(".preloader").delay(800).fadeOut(600);
    });

})(jQuery);

//Banner
$('.slide-banner').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: false,
    dots: false,
    autoplaySpeed: 2000,
});

//slider - marcas
$(function () {
    const $slider = $('.marcas-slider');

    // Função para inicializar o slider, se ainda não estiver ativo
    const initSlider = () => {
        if (!$slider.hasClass('slick-initialized')) {
            $slider.slick({
                slidesToShow: 4, // Configuração inicial para desktop
                slidesToScroll: 1,
                autoplay: true,
                dots: false,
                arrows: false,
                autoplaySpeed: 2000,
                responsive: [
                    {
                        breakpoint: 780, // Configuração para telas menores ou iguais a 768px
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1,
                        },
                    },
                    {
                        breakpoint: 480, // Configuração para telas menores ou iguais a 480px
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1,
                        },
                    },
                ],
            });
        }
    };

    // Função para destruir o slider, se estiver ativo
    const destroySlider = () => {
        if ($slider.hasClass('slick-initialized')) {
            $slider.slick('unslick');
        }
    };

    // Atualizar o slider com base no redimensionamento da janela
    const updateSlider = () => {
        destroySlider();
        initSlider();
    };

    // Inicializa o slider na carga da página
    initSlider();

    // Gerencia o slider ao redimensionar a janela
    $(window).on('resize', updateSlider);
});


//Depoimento
$('.slide-card').slick({
    slidesToShow: 2,
    slidesToScroll: 1,
    dots: true,
    arrows: false,
    responsive: [
        {
            breakpoint: 780,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1,
            },
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
            }
        }

    ]
});

// Contador
$(document).ready(function() {
    const startCount = 0; // Número inicial
    const endCount = 1997; // Número final
    const duration = 50; // Duração de cada passo
    const delay = 5; // Delay de 5 segundos (em milissegundos)

    let current = startCount;
    const stepTime = Math.abs(Math.floor(duration / (endCount - startCount)));

    setTimeout(function() {
        const timer = setInterval(function() {
            current++;
            $('#counter').text(current);
            if (current === endCount) {
                clearInterval(timer);
            }
        }, stepTime);
    }, delay); // O contador será iniciado após 5 segundos
});