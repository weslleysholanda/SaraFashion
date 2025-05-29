<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/vendors/css/reset.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <title><?php echo isset($titulo) ? $titulo : 'Esqueceu a senha?' ?></title>
</head>

<body>
  <!-- Esqueci a senha -->
  <?php require_once('templates/esqueceuSenha.php') ?>

  <script>
    document.getElementById('formRecuperarSenha').addEventListener('submit', async function(e) {
      e.preventDefault();

      const email = document.getElementById('email_cliente').value;
      const mensagemErro = document.getElementById('mensagemErro');

      mensagemErro.style.display = 'none';
      mensagemErro.textContent = '';

      try {
        const response = await fetch(this.action, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
          },
          body: new URLSearchParams({
            email_cliente: email
          })
        });

        const data = await response.json();

        if (response.ok) {
          // Sucesso: redireciona direto sem mostrar mensagem
          window.location.href = data.redirect;
        } else {
          
          mensagemErro.textContent = data.erro || 'Erro inesperado';
          mensagemErro.style.display = 'block';
        }
      } catch (error) {
        mensagemErro.textContent = 'Erro na requisição: ' + error.message;
        mensagemErro.style.display = 'block';
      }
    });
  </script>



</body>

</html>