// Pagina ativa
const links = document.querySelectorAll(".menu a");
const currentPath = window.location.pathname;

// Remove a classe 'ativo' de todos os links antes de definir o correto
links.forEach(link => link.classList.remove("ativo"));

links.forEach(link => {
    const linkPath = new URL(link.href).pathname; // Obtém apenas o caminho do link

    if (linkPath === currentPath) {
        link.classList.add("ativo"); // Ativa o link correto
    }
    // Se estiver em /sarafashion/public/, ativa a home
    else if (currentPath === "/sarafashion/public/" && linkPath.endsWith("/home")) {
        link.classList.add("ativo");
    }
});
// fim Pagina ativa

// preloader
(function ($) {
    "use strict";

    $(window).on('load', function () {
        // Garante que o VLibras continue escondido, se existir
        if ($('.enabled').length) {
            $('.enabled').hide();
        }

        // Oculta o botão "Back to Top", se existir
        if ($('#backtop').length) {
            $('#backtop').hide();
        }

        // Remove o preloader e inicia animações suavemente
        if ($('.preloader').length) {
            $(".preloader").delay(800).fadeOut(600, function () {
                // Desativa scroll e muda cor de fundo temporariamente
                $('html, body').css({
                    'overflow': 'hidden',
                    'height': '100%',
                    'background-color': '#f0f0f0'
                });

                // Após pequena pausa, libera o scroll e aplica fade-in
                setTimeout(function () {
                    $('html, body').css({
                        'overflow': 'visible',
                        'height': 'auto',
                        'background-color': '#fff'
                    });

                    $('body').fadeIn(800);

                    // Faz o VLibras aparecer suavemente, se existir
                    if ($('.enabled').length) {
                        setTimeout(function () {
                            $('.enabled').fadeIn(800);
                        }, 1000);
                    }

                    // Exibe o botão "Back to Top", se existir
                    if ($('#backtop').length) {
                        $('#backtop').fadeIn(800);
                    }

                }, 500);
            });
        }

        // Torna o slider visível, se existir
        const $slideBanner = $('.slide-banner');
        if ($slideBanner.length) {
            $slideBanner.css({ visibility: 'visible' });

            // Inicializa o slick
            $slideBanner.slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: false,
                dots: false,
                autoplaySpeed: 10000,
                speed: 800,
                pauseOnHover: false,
            });

            // Aplica animações no slide inicial
            const initialElements = $slideBanner.find('.slick-current [data-animation]');
            initialElements.each(function () {
                const animationName = $(this).data('animation');
                $(this).css({ opacity: 1 }).addClass(`animate__animated ${animationName}`);
            });

            // Remove animação antes de mudar
            $slideBanner.on('beforeChange', function (event, slick, currentSlide, nextSlide) {
                const currentElements = $(slick.$slides[currentSlide]).find('[data-animation]');
                currentElements.each(function () {
                    const animationName = $(this).data('animation');
                    $(this).css({ opacity: 0 }).removeClass(`animate__animated ${animationName}`);
                });
            });

            // Aplica animação depois de mudar
            $slideBanner.on('afterChange', function (event, slick, currentSlide) {
                const nextElements = $(slick.$slides[currentSlide]).find('[data-animation]');
                nextElements.each(function (index) {
                    const animationName = $(this).data('animation');
                    setTimeout(() => {
                        $(this).css({ opacity: 1 }).addClass(`animate__animated ${animationName}`);
                    }, index * 300);
                });
            });
        }
    });

})(jQuery);



//slider - marcas
$(function () {
    const $slider = $('.marcas-slider');

    // Verifica se o elemento existe antes de continuar
    if ($slider.length === 0) return;

    const initSlider = () => {
        if (!$slider.hasClass('slick-initialized')) {
            $slider.slick({
                slidesToShow: 4,
                slidesToScroll: 1,
                autoplay: true,
                dots: false,
                arrows: false,
                autoplaySpeed: 2000,
                responsive: [
                    {
                        breakpoint: 780,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1,
                        },
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1,
                        },
                    },
                    {
                        breakpoint: 330,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1,
                        },
                    },
                ],
            });
        }
    };

    const destroySlider = () => {
        if ($slider.hasClass('slick-initialized')) {
            $slider.slick('unslick');
        }
    };

    const updateSlider = () => {
        destroySlider();
        initSlider();
    };

    initSlider();

    $(window).on('resize', updateSlider);
});



//Menu mobile + scrollbar fixo topo loja
const menuToggle = document.querySelector(".menu-toggle");
const menu = document.querySelector(".menu");

if (menuToggle && menu) {
    menuToggle.addEventListener("click", () => {
        menuToggle.classList.toggle("active");
        menu.classList.toggle("active");
    });
}

window.addEventListener("scroll", function () {
    const topo = document.querySelector(".topo"); // Seleciona o elemento .topo
    const topoLoja = document.querySelector(".topo-loja"); // Seleciona o elemento .topo-loja
    const logo = document.querySelector(".topo-loja .logo img"); // Seleciona a logo dentro do .topo-loja

    // Lógica para .topo
    if (topo && window.innerWidth <= 1024) {
        if (window.scrollY > 300) {
            topo.classList.add("fixo");
        } else {
            topo.classList.remove("fixo");
        }
    }

    //.topo-loja
    if (topoLoja && window.innerWidth <= 1024) {
        if (window.scrollY > 250) {
            topoLoja.classList.add("fixo");

            // Troca a logo somente no .topo-loja
            if (logo) {
                logo.src = "https://sarafashion.webdevsolutions.com.br/public/assets/img/logoInicial.png";
            }
        } else {
            topoLoja.classList.remove("fixo");

            // Volta para a logo Inicial somente no .topo-loja
            if (logo) {
                logo.src = "https://sarafashion.webdevsolutions.com.br/public/assets/img/logoDark.png";
            }
        }
    }
});


//Depoimento
$(function () {
    const $slideCard = $('.slide-card');

    // Verifica se o elemento existe antes de tentar iniciar o slick
    if ($slideCard.length === 0) return;

    // Inicializa o slick slider com as configurações desejadas
    $slideCard.slick({
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
            },
            {
                breakpoint: 330,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            }
        ]
    });
});



// counterUp - Contador
$(function () {
    const elements = document.querySelectorAll('.counter');

    // Só executa se houver pelo menos um .counter
    if (elements.length > 0 && window.counterUp && window.counterUp.default) {
        const counterUp = window.counterUp.default;

        const callback = (entries) => {
            entries.forEach((entry) => {
                const el = entry.target;
                if (entry.isIntersecting && !el.classList.contains('is-visible')) {
                    counterUp(el, {
                        duration: 2000,
                        delay: 16,
                    });
                    el.classList.add('is-visible');
                }
            });
        };

        const IO = new IntersectionObserver(callback, { threshold: 1 });

        elements.forEach((el) => IO.observe(el));
    }
});
// fim counterUp - Contador



// drop down
(function () {
    const dropdown = document.querySelector('.userIcon .dropdown');
    const content = dropdown.querySelector('.dropdownContent');
    let closeTimeout;

    dropdown.addEventListener('mouseenter', () => {
        clearTimeout(closeTimeout);
        content.classList.add('active');
    });

    dropdown.addEventListener('mouseleave', () => {
        closeTimeout = setTimeout(() => {
            content.classList.remove('active');
        }, 200);
    });
})();