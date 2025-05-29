<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Resetar Senha</title>
  <link rel="stylesheet" href="/vendors/css/reset.css">
  <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
  <?php require_once('templates/recuperar.php') ?>


  <script>
    const senhaInput = document.getElementById('senha');
    const senha2Input = document.getElementById('senha2');
    const forcaSpans = document.querySelectorAll('.forca-senha span');
    const erroSenha = document.getElementById('erro-senha');
    const erroConfirmacao = document.getElementById('erro-confirmacao');
    const btnSubmit = document.getElementById('btn-submit');
    const form = document.querySelector('.form-recuperar');

    function verificarForca(senha) {
      let forca = 0;
      if (senha.length >= 8) forca++;
      if (/[A-Z]/.test(senha)) forca++;
      if (/[0-9]/.test(senha)) forca++;
      if (/[\W_]/.test(senha)) forca++;
      return forca;
    }

    function atualizarIndicadores(forca) {
      let mensagem = '';
      let corMensagem = '';

      forcaSpans.forEach((span, index) => {
        if (index < forca) {
          if (forca <= 1) {
            span.style.backgroundColor = '#ff0000';
            mensagem = 'Senha muito fraca. Use mais caracteres.';
            corMensagem = '#ff0000';
          } else if (forca <= 3) {
            span.style.backgroundColor = '#ffa500';
            mensagem = 'Senha fraca. Use letras maiúsculas, números e símbolos.';
            corMensagem = '#ffa500';
          } else {
            span.style.backgroundColor = '#008000';
            mensagem = 'Boa senha!';
            corMensagem = '#008000';
          }
        } else {
          span.style.backgroundColor = '#ccc';
        }
      });

      if (senhaInput.value) {
        erroSenha.textContent = mensagem;
        erroSenha.style.color = corMensagem;
      } else {
        erroSenha.textContent = '';
      }
    }

    function validar() {
      const senha = senhaInput.value;
      const confirmacao = senha2Input.value;
      const forca = verificarForca(senha);

      atualizarIndicadores(forca);

      // Validação da confirmação
      if (!confirmacao) {
        erroConfirmacao.textContent = '';
      } else if (senha !== confirmacao) {
        erroConfirmacao.textContent = 'As senhas não coincidem.';
      } else {
        erroConfirmacao.textContent = '';
      }

      // Libera botão só se senha for forte e confirmação bater
      btnSubmit.disabled = !(forca >= 3 && senha === confirmacao);
    }

    senhaInput.addEventListener('input', validar);
    senha2Input.addEventListener('input', validar);

    form.addEventListener('submit', async function(e) {
      e.preventDefault();

      const formData = new FormData(form);

      const response = await fetch(form.action, {
        method: 'POST',
        body: formData
      });

      const resultado = await response.json();

      erroSenha.textContent = '';
      erroConfirmacao.textContent = '';

      if (resultado.erro) {
        erroSenha.textContent = resultado.erro;
        erroSenha.style.color = '#b00020';
      } else if (resultado.sucesso) {
        erroSenha.textContent = resultado.sucesso;
        erroSenha.style.color = '#008000';
        form.reset();
        btnSubmit.disabled = true;
      }
    });
  </script>


</body>

</html>