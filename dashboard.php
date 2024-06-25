<?php

if (isset($_COOKIE["user"])) {
  if (str_contains($_COOKIE["user"],"admin")) {
    $status = "administrator";
  }
  else {
    $status="";
  }
}  
$array = explode("-",$_COOKIE["user"]);
$admin = $array[1];
$user_id = $array[2];

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard Financeiro</title>
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script>
<link rel="icon" href="img/favicon.svg" title="YRprey">
</head>
<body>
  <?php
    include("navbar.php");
  ?>
  <div class="container">
    <h1 class="mt-5">Dashboard Financeiro</h1>

    <!-- Resumo Financeiro -->
    <div class="card mt-3">
      <div class="card-body">
        <h5 class="card-title">Resumo Financeiro</h5>
        <p id="saldoAtual">Saldo Atual: R$ --</p>
        <p id="receitasMes">Receitas no Mês: R$ --</p>
        <p id="despesasMes">Despesas no Mês: R$ --</p>
      </div>
    </div>

    <!-- Lista de Últimas Transações -->
    <div class="card mt-3">
      <div class="card-body">
        <h5 class="card-title">Últimas Transações</h5>
        <ul id="transactionsList" class="list-group">
          <!-- As transações serão inseridas aqui via AJAX -->
        </ul>
      </div>
    </div>

    <!-- Gráfico de Receitas e Despesas -->
    <div class="card mt-3">
      <div class="card-body">
        <h5 class="card-title">Gráfico de Receitas e Despesas</h5>
        <canvas id="myChart"></canvas>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Script para AJAX e Gráfico -->
  <script>
    $(document).ready(function() {
      // Função para atualizar o resumo financeiro
      function atualizarResumo() {
        $.ajax({
          url: 'atualizar_resumo.php',
          type: 'GET',
          dataType: 'json',
          success: function(response) {
            $('#saldoAtual').text('Saldo Atual: R$ ' + response.saldo);
            $('#receitasMes').text('Receitas no Mês: R$ ' + response.receitas);
            $('#despesasMes').text('Despesas no Mês: R$ ' + response.despesas);
          },
          error: function(jqXHR, textStatus, errorThrown) {
            console.log('Erro ao atualizar resumo financeiro:', errorThrown);
          }
        });
      }

      // Função para atualizar a lista de últimas transações
      function atualizarTransacoes() {
        $.ajax({
          url: 'atualizar_transacoes.php',
          type: 'GET',
          dataType: 'json',
          success: function(response) {
            $('#transactionsList').empty();
            response.forEach(function(item) {
              $('#transactionsList').append('<li class="list-group-item">' + item.descricao + ' - R$ ' + item.valor + ' - Data: ' + item.data + '</li>');
            });
          },
          error: function(jqXHR, textStatus, errorThrown) {
            console.log('Erro ao atualizar lista de transações:', errorThrown);
          }
        });
      }

      // Função para inicializar o gráfico
      function inicializarGrafico() {
  const ctx = document.getElementById('myChart').getContext('2d');
  const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Receitas', 'Despesas'],
      datasets: [{
        label: 'Valores em R$',
        data: [0, 0], // Dados iniciais
        backgroundColor: [
          'rgba(54, 162, 235, 0.2)',
          'rgba(255, 99, 132, 0.2)',
        ],
        borderColor: [
          'rgba(54, 162, 235, 1)',
          'rgba(255, 99, 132, 1)',
        ],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });

  // Função para atualizar os dados do gráfico via AJAX
  function atualizarDadosGrafico() {
    $.ajax({
      url: 'seu_arquivo_php.php', // Substitua pelo seu arquivo PHP que retorna os dados do gráfico
      type: 'GET', // Ou 'POST' dependendo da sua implementação no servidor
      dataType: 'json',
      success: function(response) {
        // Atualizar os dados do gráfico com base na resposta do servidor
        myChart.data.datasets[0].data = [response.receitas, response.despesas];
        myChart.update(); // Atualizar o gráfico após alterar os dados
      },
      error: function(jqXHR, textStatus, errorThrown) {
        console.error('Erro ao atualizar dados do gráfico:', errorThrown);
      }
    });
  }

  // Chamar a função para atualizar os dados do gráfico inicialmente e a cada intervalo de tempo desejado
  atualizarDadosGrafico();
  setInterval(atualizarDadosGrafico, 5000); // Atualizar a cada 5 segundos (5000 milissegundos)

  return myChart;
}


      // Chamar as funções de atualização ao carregar a página
      const myChart = inicializarGrafico();
      atualizarResumo();
      atualizarTransacoes();

      // Atualizar a página a cada 5 segundos
      setInterval(function() {
        atualizarResumo();
        atualizarTransacoes();
      }, 5000); // 5000 milissegundos = 5 segundos
    });
  </script>
</body>
</html>
