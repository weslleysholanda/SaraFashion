<!doctype html>
<html lang="pt-br">
<!--begin::Head-->

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Sarafashion - Dashboard</title>
  <!--begin::Primary Meta Tags-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="title" content="AdminLTE | Dashboard v2" />
  <meta name="author" content="ColorlibHQ" />
  <!--begin::Third Party Plugin(OverlayScrollbars)-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css" integrity="sha256-tZHrRjVqNSRyWg2wbppGnT833E/Ys0DHWGwT04GiqQg=" crossorigin="anonymous">
  <!--begin::Third Party Plugin(Bootstrap Icons)-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI=" crossorigin="anonymous" />

  <!-- Lightbox 2 -->
  <link rel="stylesheet" href="http://localhost/sarafashion/public/vendors/css/lightbox.min.css">
  <!-- css adminlte -->
  <link rel="stylesheet" href="http://localhost/sarafashion/public/vendors/css/adminlte.css" />
  <!-- font awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

  <!-- css dash -->
  <link rel="stylesheet" href="http://localhost/sarafashion/public/assets/css/dash.css" />

  <!-- apexcharts -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css" integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0=" crossorigin="anonymous" />
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
  <!--begin::App Wrapper-->
  <div class="app-wrapper">
    <!--begin::Header-->
    <nav class="app-header navbar navbar-expand bg-body">
      <!--begin::Container-->
      <div class="container-fluid">
        <!--begin::Start Navbar Links-->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
              <i class="bi bi-list"></i>
            </a>
          </li>
          <li class="nav-item d-none d-md-block"><a href="http://localhost/sarafashion/public/dashboard" class="nav-link">Site SaraFashion</a></li>
        </ul>
        <ul class="navbar-nav ms-auto">
          <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
              <?php foreach ($usuario as $usuarioLogado): ?>
                <img src="<?php
                          $caminhoArquivo = $_SERVER['DOCUMENT_ROOT'] . "/sarafashion/public/uploads/" . $usuarioLogado['foto_funcionario'];
                          if ($usuarioLogado['foto_funcionario'] != "") {
                            if (file_exists($caminhoArquivo)) {
                              echo ("http://localhost/sarafashion/public/uploads/" . htmlspecialchars($usuarioLogado['foto_funcionario'], ENT_QUOTES, 'UTF-8'));
                            } else {
                              echo ("http://localhost/sarafashion/public/uploads/funcionario/sem-foto-funcionario.png");
                            }
                          } else {
                            echo ("http://localhost/sarafashion/public/uploads/funcionario/sem-foto-funcionario.png");
                          } ?>" class="user-image rounded-circle shadow" alt="User Image" />
                <span><?php echo htmlspecialchars($usuarioLogado['nome_funcionario'], ENT_QUOTES, 'UTF-8') ?></span>
              <?php endforeach ?>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
              <!--begin::User Image-->
              <li class="user-header text-bg-primary">
                <?php foreach ($usuario as $usuarioLogado): ?>
                  <img src="<?php
                            $caminhoArquivo = $_SERVER['DOCUMENT_ROOT'] . "/sarafashion/public/uploads/" . $usuarioLogado['foto_funcionario'];
                            if ($usuarioLogado['foto_funcionario'] != "") {
                              if (file_exists($caminhoArquivo)) {
                                echo ("http://localhost/sarafashion/public/uploads/" . htmlspecialchars($usuarioLogado['foto_funcionario'], ENT_QUOTES, 'UTF-8'));
                              } else {
                                echo ("http://localhost/sarafashion/public/uploads/funcionario/sem-foto-funcionario.png");
                              }
                            } else {
                              echo ("http://localhost/sarafashion/public/uploads/funcionario/sem-foto-funcionario.png");
                            } ?>" class="rounded-circle shadow" alt="User Image" />
                  <p>
                    <?php echo htmlspecialchars($usuarioLogado['nome_funcionario'], ENT_QUOTES, 'UTF-8'); ?> -
                    <?php echo htmlspecialchars($usuarioLogado['cargo_funcionario'], ENT_QUOTES, 'UTF-8'); ?>
                    <small>
                      <?php $data = new DateTime($usuarioLogado['data_adm_funcionario']);
                      echo htmlspecialchars('Membro desde ' . $data->format('M. Y'), ENT_QUOTES, 'UTF-8');
                      ?>
                    </small>
                  </p>
                <?php endforeach ?>
              </li>
              <!--end::User Image-->
              <!--begin::Menu Footer-->
              <li class="user-footer">
                <a href="#" class="btn btn-default btn-flat">Profile</a>
                <a href="http://localhost/sarafashion/public/auth/sair" class="btn btn-default btn-flat float-end">Logoff</a>
              </li>
              <!--end::Menu Footer-->
            </ul>
          </li>
          <!--end::User Menu Dropdown-->
        </ul>
        <!--end::End Navbar Links-->
      </div>
      <!--end::Container-->
    </nav>
    <!--end::Header-->
    <!--begin::Sidebar-->
    <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
      <!--begin::Sidebar Brand-->
      <div class="sidebar-brand">
        <!--begin::Brand Link-->
        <a href="http://localhost/sarafashion/public/dashboard" class="brand-link">
          <!--begin::Brand Image-->
          <img src="http://localhost/sarafashion/public/assets/img/logoInicial.png" alt="Sara Fashion Logo" class="brand-image" />
          <!--end::Brand Image-->
        </a>
        <!--end::Brand Link-->
      </div>
      <!--end::Sidebar Brand-->
      <!--begin::Sidebar Wrapper-->
      <div class="sidebar-wrapper">
        <nav class="mt-2"> <!--begin::Sidebar Menu-->
          <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark"> <!--begin::Sidebar Brand-->
            <div class="sidebar-wrapper">
              <nav class="mt-2"> <!--begin::Sidebar Menu-->
                <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                  <li class="nav-item menu-open"> <a href="#" class="nav-link active"> <i class="nav-icon bi bi-speedometer"></i>
                      <p>
                        Dashboard

                      </p>
                    </a>

                  </li>


                  </a> </li>
                  <li class="nav-item"> <a href="#" class="nav-link">
                      <i class="bi bi-gear"></i>
                      <p>
                        Gestão de Serviços
                        <i class="nav-arrow bi bi-chevron-right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="http://localhost/sarafashion/public/agendamento/listar" class="nav-link">
                          <p>Agendamento de Serviços</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="http://localhost/sarafashion/public/servico/listar" class="nav-link">
                          <p>Serviços</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="http://localhost/sarafashion/public/especialidade/listar" class="nav-link">
                          <p>Especialidade</p>
                        </a>
                      </li>
                    </ul>
                  </li>

                  <li class="nav-item"> <a href="#" class="nav-link"> <ion-icon name="people-outline"></ion-icon>
                      <p>
                        Gestão de Clientes
                        <i class="nav-arrow bi bi-chevron-right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="http://localhost/sarafashion/public/cliente/listar" class="nav-link">
                          <p>Clientes</p>
                        </a>
                      </li>
                    </ul>
                  </li>

                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="bi bi-briefcase"></i>
                      <p>
                        Recursos Humanos
                        <i class="nav-arrow bi bi-chevron-right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="http://localhost/sarafashion/public/funcionario/listar" class="nav-link">
                          <p>Funcionários</p>
                        </a>
                      </li>
                    </ul>
                  </li>


                  <li class="nav-item"> <a href="#" class="nav-link">
                      <i class="bi bi-truck"></i>
                      <p>
                        Fornecedores
                        <i class="nav-arrow bi bi-chevron-right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="http://localhost/sarafashion/public/fornecedor/listar" class="nav-link">
                          <p>Fornecedores</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="http://localhost/sarafashion/public/produto/listar" class="nav-link">
                          <p>Produtos</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="nav-header">SITE</li>

                  <li class="nav-item">
                    <a href="http://localhost/sarafashion/public/depoimento/listar" class="nav-link">
                      <i class="bi bi-chat-left-text"></i>

                      <p>Depoimentos</p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="http://localhost/sarafashion/public/contato/listar" class="nav-link">
                      <i class="bi bi-envelope"></i>
                      <p>Contato</p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="http://localhost/sarafashion/public/marcas/listar" class="nav-link">
                      <i class="bi bi-tags"></i>
                      <p>Marcas</p>
                    </a>
                  </li>
                </ul> <!--end::Sidebar Menu-->
              </nav>
            </div> <!--end::Sidebar Wrapper-->
          </aside> <!--end::Sidebar--> <!--begin::App Main-->


        </nav>
      </div>
      <!--end::Sidebar Wrapper-->
    </aside>
    <!--end::Sidebar-->
    <!--begin::App Main-->
    <main class="app-main">
      <!--begin::App Content Header-->
      <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
          <!--begin::Row-->
          <div class="row">
            <div class="col-sm-6">
              <h3 class="mb-0">Sara Fashion Dashboard</h3>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="http://localhost/sarafashion/public/">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">SaraFashion</li>
              </ol>
            </div>
          </div>
          <!--end::Row-->
        </div>
        <!--end::Container-->
      </div>
      <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
          <!-- Info boxes -->
          <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box">
                <span class="info-box-icon text-bg-success shadow-sm">
                  <i class="bi bi-cart-fill"></i>
                </span>
                <div class="info-box-content"> <span class="info-box-text">Vendas</span> <span
                    class="info-box-number"><?php echo htmlspecialchars($venda, ENT_QUOTES, "UTF-8"); ?></span> </div> <!-- /.info-box-content -->
              </div>
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box">
                <span class="info-box-icon text-bg-danger shadow-sm">
                  <i class="bi bi-hand-thumbs-up-fill"></i>
                </span>
                <div class="info-box-content">
                  <span class="info-box-text">Depoimentos</span>
                  <span class="info-box-number"><?php echo htmlspecialchars($depoimento, ENT_QUOTES, 'UTF-8'); ?></span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <!-- fix for small devices only -->
            <!-- <div class="clearfix hidden-md-up"></div> -->
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box">
                <span class="info-box-icon text-bg-success shadow-sm" id="cor">
                  <i class="bi bi-people-fill"></i>
                </span>
                <div class="info-box-content">
                  <span class="info-box-text">Usuarios Registrados</span>
                  <span class="info-box-number"><?php echo htmlspecialchars($cadastro, ENT_QUOTES, 'UTF-8'); ?></span>
                </div> <!-- /.info-box-content -->
              </div>
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box"> <span class="info-box-icon text-bg-success shadow-sm" id="cor-primary-nav">
                  <ion-icon name="pie-chart-outline"></ion-icon>
                </span>
                <div class="info-box-content"> <span class="info-box-text">Visitantes Unicos</span> <span
                    class="info-box-number">65</span> </div> <!-- /.info-box-content -->
              </div>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
          <!--begin::Row-->
          <div class="row">
            <?php
            if (isset($conteudo)) {
              $this->carregarViews($conteudo, $dados);
            } else {
              echo '<h2> Bem Vindo ao Dashboard! </h2>';
            }

            ?>
          </div>
        </div>
        <!--end::Container-->
      </div>
      <!--end::App Content-->
    </main>
    <!--end::App Main-->
    <!--begin::Footer-->
    <footer class="app-footer">
      <!--begin::To the end-->
      <!--end::To the end-->
      <!--begin::Copyright-->
      <strong>
        Copyright &copy; 2025&nbsp;
        <a href="https://localhost/sarafashion/public" class="text-decoration-none">SaraFashion</a>.
      </strong>
      All rights reserved.
      <!--end::Copyright-->
    </footer>
    <!--end::Footer-->
  </div>

  <!--end::App Wrapper-->
  <!--begin::Script-->
  <!--begin::Third Party Plugin(OverlayScrollbars)-->
  <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js" integrity="sha256-dghWARbRe2eLlIJ56wNB+b760ywulqK3DzZYEpsg2fQ=" crossorigin="anonymous"></script>
  <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
  <!-- Jquery -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <!-- Tempus Dominus JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/@eonasdan/tempus-dominus@6.9.4/dist/js/tempus-dominus.min.js" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
  <script src="http://localhost/kioficina/public/assets/js/teste.js"></script>


  <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
  <script src="http://localhost/sarafashion/public/vendors/js/adminlte.js"></script>
  <script src="http://localhost/sarafashion/public/vendors/js/lightbox.min.js"></script>


  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

  <script>
    lightbox.option({
      'albumLabel': "Imagem %1 de %2"
    });
  </script>

  <script>
    function abrirModalDesativar(idServico) {

      if ($('#modalDesativar').hasClass('show')) {
        return;
      }

      document.getElementById('idServicoDesativar').value = idServico;

      $('#modalDesativar').modal('show');
    }

    function abrirModalDesativarCliente(idCliente) {
      if ($('#modalDesativarCliente').hasClass('show')) {
        return;
      }

      document.getElementById('idClienteDesativar').value = idCliente;

      $('#modalDesativarCliente').modal('show');
    }

    function abrirModalDesativarFuncionario(idFuncionario) {
      if ($('#modalDesativarFuncionario').hasClass('show')) {
        return;
      }

      document.getElementById('idFuncionarioDesativar').value = idFuncionario;

      $('#modalDesativarFuncionario').modal('show');
    }

    function abrirModalDesativarFornecedor(idFornecedor) {
      if ($('#modalDesativarFornecedor').hasClass('show')) {
        return;
      }

      document.getElementById('idFornecedorDesativar').value = idFornecedor;

      $('#modalDesativarFornecedor').modal('show');
    }

    function abrirModalCancelar(idAgendamento) {
      if ($('#modalCancelar').hasClass('show')) {
        return;
      }

      document.getElementById('idAgendamentoCancelar').value = idAgendamento;

      $('#modalCancelar').modal('show');
    }

    function abrirModalDesativarProduto(idProduto) {
      if ($('#modalDesativarProduto').hasClass('show')) {
        return;
      }

      document.getElementById('idProdutoDesativar').value = idProduto;

      $('#modalDesativarProduto').modal('show');
    }

    //Delegação de Evento: Serviço - Desativar
    document.addEventListener('click', function(event) {
      if (event.target && event.target.id === 'btnConfirmar') {
        const idServico = document.getElementById('idServicoDesativar').value;
        console.log(idServico);

        if (idServico) {
          desativarServico(idServico);
        }
      }
    });

    //Delegação de Evento: Cliente - Desativar
    document.addEventListener('click', function(event) {
      if (event.target && event.target.id === 'btnConfirmar') {
        const idCliente = document.getElementById('idClienteDesativar').value;
        console.log(idCliente);

        if (idCliente) {
          desativarCliente(idCliente);
        }
      }
    });

    //Delegação de Evento: Funcionário - Desativar
    document.addEventListener('click', function(event) {
      if (event.target && event.target.id === 'btnConfirmar') {
        const idFuncionario = document.getElementById('idFuncionarioDesativar').value;
        console.log(idFuncionario);

        if (idFuncionario) {
          desativarFuncionario(idFuncionario);
        }
      }
    });

    //Delegação de Evento: Fornecedor - Desativar
    document.addEventListener('click', function(event) {
      if (event.target && event.target.id === 'btnConfirmar') {
        const idFornecedor = document.getElementById('idFornecedorDesativar').value;
        console.log(idFornecedor);

        if (idFornecedor) {
          desativarFornecedor(idFornecedor);
        }
      }
    });

    //Delegação de Evento: Agendamento - Desativar
    document.addEventListener('click', function(event) {
      if (event.target && event.target.id === 'btnConfirmar') {
        const idAgendamento = document.getElementById('idAgendamentoCancelar').value;
        console.log(idAgendamento);

        if (idAgendamento) {
          cancelarAgendamento(idAgendamento);
        }
      }
    });

    //Delegação de Evento: Produto - Desativar
    document.addEventListener('click', function(event) {
      if (event.target && event.target.id === 'btnConfirmar') {
        const idProduto = document.getElementById('idProdutoDesativar').value;
        console.log(idProduto);

        if (idProduto) {
          desativarProduto(idProduto);
        }
      }
    });

    function desativarServico(idServico) {

      fetch(`http://localhost/sarafashion/public/servico/desativar/${idServico}`, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          }
        })
        .then(response => {
          // Se o código de resposta NÃO for ok, lança um erro
          if (!response.ok) {
            throw new Error(`Erro HTTP: ${response.status}`);
            console.log("ERRO -");
          }
          return response.json();
        })
        .then(data => {
          // Se a resposta do servidor for OK, fecha o modal e carrega e atualiza a lista
          if (data.sucesso) {
            console.log("Serviço desativado com sucesso");
            $('#modalDesativar').modal('hide')
            setTimeout(() => {
              location.reload();
            }), 500;

          } else {
            alert(data.mensagem || "Ocorreu um erro ao desativar o serviço");
          }

        })
        .catch(erro => {
          console.error('Erro', erro);
          alert("Erro na requisição.");
        })

    }

    function desativarCliente(idCliente) {

      fetch(`http://localhost/sarafashion/public/cliente/desativar/${idCliente}`, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          }
        })
        .then(response => {
          // Se o código de resposta NÃO for ok, lança um erro
          if (!response.ok) {
            throw new Error(`Erro HTTP: ${response.status}`);
            console.log("ERRO -");
          }
          return response.json();
        })
        .then(data => {
          // Se a resposta do servidor for OK, fecha o modal e carrega e atualiza a lista
          if (data.sucesso) {
            console.log("Cliente desativado com sucesso");
            $('#modalDesativar').modal('hide')
            setTimeout(() => {
              location.reload();
            }), 500;

          } else {
            alert(data.mensagem || "Ocorreu um erro ao desativar o Cliente");
          }

        })
        .catch(erro => {
          console.error('Erro', erro);
          alert("Erro na requisição.");
        })

    }

    function desativarFuncionario(idFuncionario) {

      fetch(`http://localhost/sarafashion/public/funcionario/desativar/${idFuncionario}`, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          }
        })
        .then(response => {
          // Se o código de resposta NÃO for ok, lança um erro
          if (!response.ok) {
            throw new Error(`Erro HTTP: ${response.status}`);
            console.log("ERRO -");
          }
          return response.json();
        })
        .then(data => {
          // Se a resposta do servidor for OK, fecha o modal e carrega e atualiza a lista
          if (data.sucesso) {
            console.log("Funcionário desativado com sucesso");
            $('#modalDesativarFuncionario').modal('hide')
            setTimeout(() => {
              location.reload();
            }), 500;

          } else {
            alert(data.mensagem || "Ocorreu um erro ao desativar o Funcionário");
          }

        })
        .catch(erro => {
          console.error('Erro', erro);
          alert("Erro na requisição.");
        })

    }

    function desativarFornecedor(idFornecedor) {

      fetch(`http://localhost/sarafashion/public/fornecedor/desativar/${idFornecedor}`, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          }
        })
        .then(response => {
          // Se o código de resposta NÃO for ok, lança um erro
          if (!response.ok) {
            throw new Error(`Erro HTTP: ${response.status}`);
            console.log("ERRO -");
          }
          return response.json();
        })
        .then(data => {
          // Se a resposta do servidor for OK, fecha o modal e carrega e atualiza a lista
          if (data.sucesso) {
            console.log("Fornecedor desativado com sucesso");
            $('#modalDesativarFornecedor').modal('hide')
            setTimeout(() => {
              location.reload();
            }), 500;

          } else {
            alert(data.mensagem || "Ocorreu um erro ao desativar o Fornecedor");
          }

        })
        .catch(erro => {
          console.error('Erro', erro);
          alert("Erro na requisição.");
        })

    }

    function cancelarAgendamento(idAgendamento) {
      fetch(`http://localhost/sarafashion/public/agendamento/desativar/${idAgendamento}`, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          }
        })
        .then(response => {
          // Se o código de resposta NÃO for ok, lança um erro
          if (!response.ok) {
            throw new Error(`Erro HTTP: ${response.status}`);
            console.log("ERRO -");
          }
          return response.json();
        })
        .then(data => {
          // Se a resposta do servidor for OK, fecha o modal e carrega e atualiza a lista
          if (data.sucesso) {
            console.log("Agendamento cancelado com sucesso");
            $('#modalCancelar').modal('hide')
            setTimeout(() => {
              location.reload();
            }), 500;

          } else {
            alert(data.mensagem || "Ocorreu um erro ao cancelar o Agendamento");
          }

        })
        .catch(erro => {
          console.error('Erro', erro);
          alert("Erro na requisição.");
        })
    }

    function desativarProduto(idProduto) {

      fetch(`http://localhost/sarafashion/public/produto/desativar/${idProduto}`, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          }
        })
        .then(response => {
          // Se o código de resposta NÃO for ok, lança um erro
          if (!response.ok) {
            throw new Error(`Erro HTTP: ${response.status}`);
            console.log("ERRO -");
          }
          return response.json();
        })
        .then(data => {
          // Se a resposta do servidor for OK, fecha o modal e carrega e atualiza a lista
          if (data.sucesso) {
            console.log("Produto desativado com sucesso");
            $('#modalDesativarProduto').modal('hide')
            setTimeout(() => {
              location.reload();
            }), 500;

          } else {
            alert(data.mensagem || "Ocorreu um erro ao desativar o Produto");
          }

        })
        .catch(erro => {
          console.error('Erro', erro);
          alert("Erro na requisição.");
        })

    }
  </script>
  <!--end::OverlayScrollbars Configure-->
  <!-- OPTIONAL SCRIPTS -->
  <!-- apexcharts -->
  <!-- <script
    src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js"
    integrity="sha256-+vh8GkaU7C9/wbSLIcwq82tQ2wTf44aOHA8HlBMwRI8="
    crossorigin="anonymous">
  </script> -->

  <!-- <script>
    // NOTICE!! DO NOT USE ANY OF THIS JAVASCRIPT
    // IT'S ALL JUST JUNK FOR DEMO
    // ++++++++++++++++++++++++++++++++++++++++++

    /* apexcharts
     * -------
     * Here we will create a few charts using apexcharts
     */

    //-----------------------
    // - MONTHLY SALES CHART -
    //-----------------------

    const sales_chart_options = {
      series: [{
          name: 'Digital Goods',
          data: [28, 48, 40, 19, 86, 27, 90],
        },
        {
          name: 'Electronics',
          data: [65, 59, 80, 81, 56, 55, 40],
        },
      ],
      chart: {
        height: 180,
        type: 'area',
        toolbar: {
          show: false,
        },
      },
      legend: {
        show: false,
      },
      colors: ['#0d6efd', '#20c997'],
      dataLabels: {
        enabled: false,
      },
      stroke: {
        curve: 'smooth',
      },
      xaxis: {
        type: 'datetime',
        categories: [
          '2023-01-01',
          '2023-02-01',
          '2023-03-01',
          '2023-04-01',
          '2023-05-01',
          '2023-06-01',
          '2023-07-01',
        ],
      },
      tooltip: {
        x: {
          format: 'MMMM yyyy',
        },
      },
    };

    const sales_chart = new ApexCharts(
      document.querySelector('#sales-chart'),
      sales_chart_options,
    );
    sales_chart.render();

    //---------------------------
    // - END MONTHLY SALES CHART -
    //---------------------------

    function createSparklineChart(selector, data) {
      const options = {
        series: [{
          data
        }],
        chart: {
          type: 'line',
          width: 150,
          height: 30,
          sparkline: {
            enabled: true,
          },
        },
        colors: ['var(--bs-primary)'],
        stroke: {
          width: 2,
        },
        tooltip: {
          fixed: {
            enabled: false,
          },
          x: {
            show: false,
          },
          y: {
            title: {
              formatter: function(seriesName) {
                return '';
              },
            },
          },
          marker: {
            show: false,
          },
        },
      };

      const chart = new ApexCharts(document.querySelector(selector), options);
      chart.render();
    }

    const table_sparkline_1_data = [25, 66, 41, 89, 63, 25, 44, 12, 36, 9, 54];
    const table_sparkline_2_data = [12, 56, 21, 39, 73, 45, 64, 52, 36, 59, 44];
    const table_sparkline_3_data = [15, 46, 21, 59, 33, 15, 34, 42, 56, 19, 64];
    const table_sparkline_4_data = [30, 56, 31, 69, 43, 35, 24, 32, 46, 29, 64];
    const table_sparkline_5_data = [20, 76, 51, 79, 53, 35, 54, 22, 36, 49, 64];
    const table_sparkline_6_data = [5, 36, 11, 69, 23, 15, 14, 42, 26, 19, 44];
    const table_sparkline_7_data = [12, 56, 21, 39, 73, 45, 64, 52, 36, 59, 74];

    createSparklineChart('#table-sparkline-1', table_sparkline_1_data);
    createSparklineChart('#table-sparkline-2', table_sparkline_2_data);
    createSparklineChart('#table-sparkline-3', table_sparkline_3_data);
    createSparklineChart('#table-sparkline-4', table_sparkline_4_data);
    createSparklineChart('#table-sparkline-5', table_sparkline_5_data);
    createSparklineChart('#table-sparkline-6', table_sparkline_6_data);
    createSparklineChart('#table-sparkline-7', table_sparkline_7_data);

    //-------------
    // - PIE CHART -
    //-------------

    const pie_chart_options = {
      series: [700, 500, 400, 600, 300, 100],
      chart: {
        type: 'donut',
      },
      labels: ['Chrome', 'Edge', 'FireFox', 'Safari', 'Opera', 'IE'],
      dataLabels: {
        enabled: false,
      },
      colors: ['#0d6efd', '#20c997', '#ffc107', '#d63384', '#6f42c1', '#adb5bd'],
    };

    const pie_chart = new ApexCharts(document.querySelector('#pie-chart'), pie_chart_options);
    pie_chart.render();

    //-----------------
    // - END PIE CHART -
    //-----------------
  </script> -->
  <!--end::Script-->
</body>
<!--end::Body-->

</html>