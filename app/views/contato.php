<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php  echo isset($titulo)?$titulo: 'Contato - Sara Fashion' ?></title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="http://localhost/sarafashion/public/vendors/css/reset.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <!-- Preloader -->
    <?php require_once('templates/preloader.php')?>

    <!-- Cabecalho -->
    <?php  require_once('templates/topo.php')?>
    <!-- Banner Contato -->
    <?php  require_once('templates/banner-map.php')?>
    
    <!-- Formulario Contato -->
    <?php  require_once('templates/formulario-contato.php')?>

    <!-- footer -->
    <?php  require_once('templates/footer.php')?>

    <script>
        const today = new Date(); // Data de hoje
        const currentDay = today.getDate(); // Dia atual
        const currentMonth = today.getMonth() + 1; // Mês atual (1 para janeiro, 12 para dezembro)

        // Seleciona o título ou elemento onde o mês do calendário está definido (exemplo: "Dezembro")
        const calendarMonthName = document.querySelector('.calendar-title').textContent.trim();

        // Mapeia os nomes dos meses para números
        const monthMap = {
            Janeiro: 1,
            Fevereiro: 2,
            Março: 3,
            Abril: 4,
            Maio: 5,
            Junho: 6,
            Julho: 7,
            Agosto: 8,
            Setembro: 9,
            Outubro: 10,
            Novembro: 11,
            Dezembro: 12,
        };

        // Obtém o número do mês exibido no calendário dinamicamente
        const calendarMonth = monthMap[calendarMonthName];

        // Seleciona todos os dias do calendário
        const calendarDays = document.querySelectorAll('.calendar-days div');

        calendarDays.forEach(day => {
            const dayNumber = parseInt(day.textContent.trim()); // Número do dia no calendário

            if (!isNaN(dayNumber)) {
                // Se o calendário está mostrando o mês atual
                if (calendarMonth === currentMonth) {
                    if (dayNumber < currentDay) {
                        day.classList.add('past-day'); // Marca os dias passados
                    }
                }
                // Se o calendário está mostrando um mês anterior
                else if (calendarMonth < currentMonth) {
                    day.classList.add('past-day'); // Marca todos os dias do mês anterior
                }
                // Caso contrário (mês futuro), não faz nada
            }
        });

    </script>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://kit.fontawesome.com/89bd08d7e0.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="assets/js/maps.js"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>