// Pagina ativa
const links = document.querySelectorAll(".menu a");
const currentPath = window.location.pathname;
links.forEach(link => {
    if (link.getAttribute("href").includes(currentPath)) {
        // Adiciona a classe 'ativo' ao link correspondente
        link.classList.add("ativo");
    }
});
if (!document.querySelector(".menu a.ativo") && currentPath === "/") {
    const homeLink = document.querySelector(".menu a[href$='home']");
    if (homeLink) {
        homeLink.classList.add("ativo");
    }
}
// fim Pagina ativa

// preloader
(function ($) {
    "use strict";

    $(window).on('load', function () {
        // Garante que o VLibras continue escondido
        $('.enabled').hide();

        // Remove o preloader e inicializa as animações suavemente
        $(".preloader").delay(800).fadeOut(600, function () {
            // Primeiro, garante que o scroll está desativado
            $('html, body').css({
                'overflow': 'hidden',
                'height': '100%',
                'background-color': '#f0f0f0' // Cor de fundo alterada durante o preloader
            });

            // Aguarda um pouco antes de liberar o scroll com um fade-in
            setTimeout(function () {
                // Libera o scroll e faz a transição de fundo
                $('html, body').css({
                    'overflow': 'visible',
                    'height': 'auto',
                    'background-color': '#fff' // Cor final após o preloader
                });

                // Aplica o fade-in suavemente ao body (evita o "clarão")
                $('body').fadeIn(800); 

                // Faz o VLibras aparecer suavemente
                $('.enabled').fadeIn(800);
            }, 500); // Aguarda um pequeno tempo antes de liberar o scroll
        });

        // Torna o slider visível imediatamente
        $('.slide-banner').css({ visibility: 'visible' });

        // Inicializa o slider com o tempo ajustado
        $('.slide-banner').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            dots: false,
            autoplaySpeed: 10000, // Tempo de espera antes de mudar o slide
            speed: 800,
            pauseOnHover: false,
        });

        // Aplica animações no slide inicial simultaneamente com o término do preloader
        const initialElements = $('.slide-banner .slick-current [data-animation]');
        initialElements.each(function () {
            const animationName = $(this).data('animation');
            $(this).css({ opacity: 1 }).addClass(`animate__animated ${animationName}`);
        });

        // Evento antes de mudar o slide
        $('.slide-banner').on('beforeChange', function (event, slick, currentSlide, nextSlide) {
            const currentElements = $(slick.$slides[currentSlide]).find('[data-animation]');
            currentElements.each(function () {
                const animationName = $(this).data('animation');
                $(this).css({ opacity: 0 }).removeClass(`animate__animated ${animationName}`);
            });
        });

        // Evento após mudar o slide
        $('.slide-banner').on('afterChange', function (event, slick, currentSlide) {
            const nextElements = $(slick.$slides[currentSlide]).find('[data-animation]');
            nextElements.each(function (index) {
                const animationName = $(this).data('animation');
                setTimeout(() => {
                    $(this).css({ opacity: 1 }).addClass(`animate__animated ${animationName}`);
                }, index * 300); // Ajuste o tempo conforme necessário
            });
        });
    });

})(jQuery);




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
                    {
                        breakpoint: 330, // Configuração para telas menores ou iguais a 480px
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
                logo.src = "http://localhost/sarafashion/public/assets/img/logoInicial.png";
            }
        } else {
            topoLoja.classList.remove("fixo");

            // Volta para a logo Inicial somente no .topo-loja
            if (logo) {
                logo.src = "http://localhost/sarafashion/public/assets/img/logoDark.png";
            }
        }
    }
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

// tippy.js
tippy('#mySpan', {
    content: 'Este é o tooltip!',
    placement: 'bottom',
    arrow: true,
    interactive: true,
    trigger: 'focus',
    theme: 'light',
});

// counterUp - Contador
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
const elements = document.querySelectorAll('.counter');
elements.forEach((el) => IO.observe(el));
//fim counterUp - Contador

// PG - Contato  Calendario
const calendarHeader = document.querySelector(".calendar-header");
const prevMonthButton = document.querySelector("#prev-month-button");
const nextMonthButton = document.querySelector("#next-month-button");
const calendarDaysDiv = document.querySelector(".calendar-days");
const currentMonthSpan = document.querySelector("#current-month");

const today = new Date();
let currentYear = today.getFullYear();
let currentMonth = today.getMonth();

const months = [
    "Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho",
    "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"
];

// Atualiza o calendário na tela
function updateCalendar() {
    const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();
    const firstDayOfMonth = new Date(currentYear, currentMonth, 1).getDay();
    const lastMonthDays = new Date(currentYear, currentMonth, 0).getDate();

    let daysHTML = '';

    // Atualizar o cabeçalho com o mês e o ano atual
    currentMonthSpan.textContent = `${months[currentMonth]} ${currentYear}`;

    // Exibir ou ocultar o botão de voltar
    prevMonthButton.style.display = (currentMonth === today.getMonth() && currentYear === today.getFullYear()) ? 'none' : 'block';

    // Dias do mês anterior (cinza)
    for (let i = firstDayOfMonth === 0 ? 6 : firstDayOfMonth - 1; i > 0; i--) {
        daysHTML += `<div class="prev-month">${lastMonthDays - i + 1}</div>`;
    }

    // Dias do mês atual
    for (let i = 1; i <= daysInMonth; i++) {
        if (currentMonth === today.getMonth() && currentYear === today.getFullYear() && i < today.getDate()) {
            daysHTML += `<div class="past-day">${i}</div>`; // Dias passados
        } else {
            daysHTML += `<div>${i}</div>`;
        }
    }

    // Dias do próximo mês (cinza)
    const nextMonthDays = 7 - (new Date(currentYear, currentMonth + 1, 0).getDay() || 7);
    for (let i = 1; i <= nextMonthDays; i++) {
        daysHTML += `<div class="next-month">${i}</div>`;
    }

    // Atualizar os dias no DOM
    calendarDaysDiv.innerHTML = `
              <div>SEG</div>
              <div>TER</div>
              <div>QUA</div>
              <div>QUI</div>
              <div>SEX</div>
              <div>SAB</div>
              <div>DOM</div>
            ` + daysHTML;
}

// Configurar o botão de próximo mês
nextMonthButton.addEventListener("click", () => {
    currentMonth++;
    if (currentMonth > 11) {
        currentMonth = 0;
        currentYear++;
    }
    updateCalendar();
});

// Configurar o botão de mês anterior
prevMonthButton.addEventListener("click", () => {
    currentMonth--;
    if (currentMonth < 0) {
        currentMonth = 11;
        currentYear--;
    }
    updateCalendar();
});

// Inicializar o calendário ao carregar a página
updateCalendar();
// PG fim - Contato  Calendario

