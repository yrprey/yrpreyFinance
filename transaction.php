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
  <title>Gerenciamento Financeiro - Transações</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="icon" href="/assets/img/favicon.svg" title="YRprey">
</head>
<body>
  <?php
    include("navbar.php");
  ?>
  <div class="container">
    <h1 class="mt-5">Transações</h1>
    
    <!-- Formulário para adicionar transações -->
    <div class="card mt-3">
      <div class="card-body">
        <h5 class="card-title">Adicionar Nova Transação</h5>
        <form id="transactionForm">
          <div class="mb-3">
            <label for="tipoTransacao" class="form-label">Tipo de Transação</label>
            <select class="form-select" id="tipoTransacao" name="tipoTransacao">
              <option selected>Escolha o tipo...</option>
              <option value="receita">Receita</option>
              <option value="despesa">Despesa</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="valorTransacao" class="form-label">Valor (R$)</label>
            <input type="number" class="form-control" id="valorTransacao" name="valorTransacao">
          </div>
          <div class="mb-3">
            <label for="descricaoTransacao" class="form-label">Descrição</label>
            <textarea class="form-control" id="descricaoTransacao" name="descricaoTransacao" rows="3"></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Adicionar Transação</button>
        </form>
      </div>
    </div>
    
    <!-- Tabela de transações -->
    <div class="card mt-3">
      <div class="card-body">
        <h5 class="card-title">Lista de Transações</h5>
        <div class="input-group mb-3">
          <input type="text" class="form-control" id="search" placeholder="Pesquisar por descrição..." aria-label="Pesquisar por descrição...">
          <button class="btn btn-outline-secondary" type="button" id="searchButton">Pesquisar</button>
        </div>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Data</th>
              <th scope="col">Tipo</th>
              <th scope="col">Valor</th>
              <th scope="col">Descrição</th>
              <th scope="col">Ações</th>
            </tr>
          </thead>
          <tbody id="transactionsTableBody">
            <!-- Linhas de transações serão adicionadas aqui -->
          </tbody>
        </table>
      </div>
    </div>
  </div>
  
  <!-- Bootstrap JS Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Script para AJAX -->
  <script>
    $(document).ready(function() {
      function listarTransacoes(query = '') {
        $.ajax({
          url: 'listar_transacoes.php',
          method: 'GET',
          data: { query: query },
          success: function(response) {
            $('#transactionsTableBody').html(response);
          }
        });
      }

      // Carregar transações ao carregar a página
      listarTransacoes();

      $('#transactionForm').submit(function(event) {
        event.preventDefault();

        const transactionData = {
          tipoTransacao: $('#tipoTransacao').val(),
          valorTransacao: $('#valorTransacao').val(),
          descricaoTransacao: $('#descricaoTransacao').val()
        };

        $.ajax({
          type: 'POST',
          url: 'add_transaction.php',
          data: JSON.stringify(transactionData),
          contentType: 'application/json',
          success: function(response) {
            if (response == "OK") {
              alert('Transação adicionada com sucesso!');
              listarTransacoes();
            } else {
              alert('Erro ao adicionar transação: ' + response.error);
            }
          }
        });
      });

      $('#searchButton').click(function() {
        var query = $('#search').val();
        listarTransacoes(query);
      });

      $('#search').on('keyup', function() {
        var query = $(this).val();
        listarTransacoes(query);
      });

      // Função para excluir transação
      $(document).on('click', '.delete-btn', function() {
        var id = $(this).data('id');
        if (confirm('Tem certeza de que deseja excluir esta transação?')) {
          $.ajax({
            url: 'delete_transaction.php',
            method: 'POST',
            data: { id: id },
            success: function(response) {
              if (response == "OK") {
                alert('Transação excluída com sucesso!');
                listarTransacoes();
              } else {
                alert('Erro ao excluir transação: ' + response.error);
              }
            }
          });
        }
      });

      // Função para editar transação
      $(document).on('click', '.edit-btn', function() {
        var id = $(this).data('id');
        var tipo = $(this).data('tipo');
        var valor = $(this).data('valor');
        var descricao = $(this).data('descricao');

        var newTipo = prompt('Editar Tipo de Transação:', tipo);
        var newValor = prompt('Editar Valor (R$):', valor);
        var newDescricao = prompt('Editar Descrição:', descricao);

        if (newTipo && newValor && newDescricao) {
          $.ajax({
            url: 'edit_transaction.php',
            method: 'POST',
            data: {
              id: id,
              tipo: newTipo,
              valor: newValor,
              descricao: newDescricao
            },
            success: function(response) {
              if (response == "OK") {
                alert('Transação editada com sucesso!');
                listarTransacoes();
              } else {
                alert('Erro ao editar transação: ' + response.error);
              }
            }
          });
        }
      });
    });
  </script>
</body>
</html>
