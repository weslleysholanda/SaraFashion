primeira versão
<section class="formulario-contato">
        <div class="site">
            <div class="container-contato">
                <div class="titulo">
                    <div class="textoFundo">Contact</div>
                    <h2>Contate-Nos</h2>
                </div>
                <div class="form-contato">
                    <form class="form-inputs" method="POST">
                        <div class="mb-3">
                            <input type="text" class="form-control" name="nome" placeholder="Nome" required>
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control" name="email" placeholder="Email" required>
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control" name="mensagem" rows="4"
                                placeholder="Escreva uma mensagem..." required></textarea>
                        </div>
                        <button type="submit" class="btn-submit">Enviar</button>
                    </form>

                    <div class="calendar-container">
                        <div class="calendar-header">
                            <span class="calendar-month">Dezembro</span>
                            <div class="calendar-weekdays">
                                <span>Seg</span>
                                <span>Ter</span>
                                <span>Qua</span>
                                <span>Qui</span>
                                <span>Sex</span>
                                <span>Sáb</span>
                                <span>Dom</span>
                            </div>
                        </div>
                        <div class="calendar-days"></div>

                        <!-- Botões para navegação de meses -->
                        <div class="calendar-nav">
                            <button class="prev-month">Anterior</button>
                            <button class="next-month">Próximo</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>



    <script>
    
//calendario - PG Contato
const today = new Date();
let currentYear = today.getFullYear();
let currentMonth = today.getMonth();
let currentDay = today.getDate();

const monthNames = [
    "Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho",
    "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"
];

// Nomes dos dias da semana
const weekDays = ["Seg", "Ter", "Qua", "Qui", "Sex", "Sáb", "Dom"];

const calendarMonthElement = document.querySelector('.calendar-month');
const calendarDaysElement = document.querySelector('.calendar-days');
const calendarWeekdaysElement = document.querySelector('.calendar-weekdays');

// Função para atualizar o calendário
function updateCalendar() {
    // Atualiza o nome do mês no cabeçalho
    calendarMonthElement.textContent = monthNames[currentMonth];

    // Exibe os dias da semana no cabeçalho
    calendarWeekdaysElement.innerHTML = weekDays.map(day => `<span>${day}</span>`).join('');

    // Obtém o número de dias no mês atual
    const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();

    // Encontra o primeiro dia do mês
    const firstDayOfMonth = new Date(currentYear, currentMonth, 1).getDay();

    // Corrige para começar na segunda-feira (Segunda = 1, Domingo = 0)
    const startDay = firstDayOfMonth === 0 ? 6 : firstDayOfMonth - 1; // Ajusta Domingo (0) para 6 (Sábado)

    // Limpa os dias existentes no calendário
    calendarDaysElement.innerHTML = '';

    // Renderiza os dias do mês no calendário
    for (let i = 0; i < startDay; i++) {
        const emptyElement = document.createElement('div');
        calendarDaysElement.appendChild(emptyElement); // Preenche com espaços vazios, sem dias
    }

    // Renderiza os dias reais do mês
    for (let day = 1; day <= daysInMonth; day++) {
        const dayElement = document.createElement('div');
        dayElement.textContent = day;

        // Adiciona a classe para dias passados
        if (day < currentDay) {
            dayElement.classList.add('past-day');
        }

        calendarDaysElement.appendChild(dayElement);
    }
}

// Navegação para o mês anterior
document.querySelector('.prev-month').addEventListener('click', () => {
    if (currentMonth === 0) {
        currentMonth = 11;
        currentYear--;
    } else {
        currentMonth--;
    }
    updateCalendar();
});

// Navegação para o próximo mês
document.querySelector('.next-month').addEventListener('click', () => {
    if (currentMonth === 11) {
        currentMonth = 0;
        currentYear++;
    } else {
        currentMonth++;
    }
    updateCalendar();
});

// Inicializa o calendário
updateCalendar();

//calendario - PG Contato -- FIM
    </script>