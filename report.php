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
<title>Gerenciamento Financeiro - Relatórios</title>
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script>
<link rel="icon" href="/assets/img/favicon.svg" title="YRprey">
</head>
<body>
  <?php
    include("navbar.php");
  ?>
  <div class="container">
    <h1 class="mt-5">Relatórios Financeiros</h1>

    <!-- Filtro de período -->
    <div class="card mt-3">
      <div class="card-body">
        <h5 class="card-title">Filtrar por Período</h5>
        <div class="row">
          <div class="col-md-4">
            <label for="dataInicio" class="form-label">Data Início</label>
            <input type="date" class="form-control" id="dataInicio">
          </div>
          <div class="col-md-4">
            <label for="dataFim" class="form-label">Data Fim</label>
            <input type="date" class="form-control" id="dataFim">
          </div>
          <div class="col-md-4">
            <button type="button" class="btn btn-primary mt-4" id="btnFiltrar">Filtrar</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Gráfico de Barras -->
    <div class="card mt-3">
      <div class="card-body">
        <h5 class="card-title">Despesas por Categoria</h5>
        <canvas id="graficoDespesas"></canvas>
      </div>
    </div>

    <!-- Tabela de Resumo das Transações -->
    <div class="card mt-3">
      <div class="card-body">
        <h5 class="card-title">Resumo das Transações</h5>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Data</th>
              <th scope="col">Descrição</th>
              <th scope="col">Categoria</th>
              <th scope="col">Valor</th>
            </tr>
          </thead>
          <tbody id="tabelaTransacoes">
            <!-- Transações serão adicionadas dinamicamente aqui -->
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <!-- jQuery para funcionalidades interativas -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
  // Função para buscar e atualizar o gráfico e a tabela de transações
function atualizarDados() {
  var dataInicio = $('#dataInicio').val();
  var dataFim = $('#dataFim').val();
    $.ajax({
        url: 'obter_dados_grafico.php',
        type: 'GET',
        dataType: 'json',
        data: {
        dataInicio: dataInicio,
        dataFim: dataFim
        },
        success: function(response) {
            // Atualiza o gráfico de despesas por categoria
            var ctx = document.getElementById('graficoDespesas').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: Object.keys(response),
                    datasets: [{
                        label: 'Despesas por Categoria',
                        data: Object.values(response),
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
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

            // Exibe as transações na tabela
            $.ajax({
                url: 'obter_transacoes.php',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    $('#tabelaTransacoes').empty();
                    response.forEach(transacao => {
                        $('#tabelaTransacoes').append(`
                            <tr>
                                <td>${transacao.data}</td>
                                <td>${transacao.descricao}</td>
                                <td>${transacao.categoria}</td>
                                <td>R$ ${transacao.valor.toFixed(2)}</td>
                            </tr>
                        `);
                    });
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('Erro ao obter transações:', errorThrown);
                }
            });
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('Erro ao obter dados do gráfico:', errorThrown);
        }
    });
}

// Chama a função para buscar e atualizar os dados inicialmente
atualizarDados();

// Define o evento de clique no botão de filtrar
$('#btnFiltrar').click(function() {
    atualizarDados();
});

  </script>
</body>
</html>
