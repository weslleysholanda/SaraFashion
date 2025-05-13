<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="http://localhost/sarafashion/public/vendors/css/reset.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <title><?php echo isset($titulo) ? $titulo : 'Esqueceu a senha?' ?></title>
</head>

<body>
  <!-- Esqueci a senha -->
  <?php require_once('templates/esqueceuSenha.php') ?>

</body>

</html>