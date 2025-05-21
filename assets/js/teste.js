document.addEventListener('DOMContentLoaded', function () {
  // Inicialize o Tempus Dominus no campo de tempo
  const picker = new tempusDominus.TempusDominus(document.getElementById('tempoEstimado'), {
    display: {
      viewMode: 'clock',
      components: {
        calendar: false, // Remove o calendário
        hours: true,
        minutes: true,
        seconds: true,
      },
    },
    localization: {
      locale: 'pt-BR', // Define o idioma para português
      hourCycle: 'h23', // Define o ciclo de 24 horas (h23)
      format: 'HH:mm:ss', // Formato para exibição
    },
  });
});

// Funcionario / Fornecedor
const picker = new tempusDominus.TempusDominus(document.getElementById('dataCadastroPicker'), {
  display: {
      components: {
          calendar: true,
          date: true,
          month: true,
          year: true,
          decades: true,
          clock: false,
      },
      buttons: {
          today: false,
          clear: true,
          close: true,
      },
  },
  localization: {
      locale: 'pt-BR',
      format: 'dd/MM/yyyy',
  }
});