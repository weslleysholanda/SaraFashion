<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="http://localhost/sarafashion/public/vendors/css/reset.css">
    <link rel="stylesheet" href="http://localhost/sarafashion/public/assets/css/style.css">
</head>
<body>
    <!-- Menu Cliente -->
    <?php  require_once('templates/topo-loja.php')?>
    <!-- Perfil Cliente -->
    <?php require_once('templates/menu-cliente.php') ?>
    
    <script>
        function changeTab(event, tabId) {
            document.querySelectorAll('.tab').forEach(tab => {
                tab.classList.remove('active');
            });
            document.getElementById(tabId).classList.add('active');

            document.querySelectorAll('.sidebar a').forEach(item => {
                item.classList.remove('active');
            });
            event.target.classList.add('active');
        }
    </script>
</body>
</html>