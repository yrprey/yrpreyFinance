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
    <title>Gerenciar Categorias</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="icon" href="/assets/img/favicon.svg" title="YRprey">
</head>
<body>
<?php include("navbar.php"); ?>
    <div class="container mt-5">
        <h2>Gerenciar Categorias</h2>
        <form id="categoriaForm">
            <div class="form-group">
                <label for="categoria">Nova Categoria</label>
                <input type="text" class="form-control" id="categoria" name="categoria" required>
            </div>
            <button type="submit" class="btn btn-primary">Adicionar Categoria</button>
        </form>
        
        <h3 class="mt-5">Lista de Categorias</h3>
        
        <!-- Campo de Pesquisa -->
        <div class="form-group">
            <input type="text" class="form-control" id="search" placeholder="Buscar Categoria">
        </div>

        <ul id="listaCategorias" class="list-group mt-3">
            <!-- As categorias serão listadas aqui -->
        </ul>
    </div>

    <script>
        $(document).ready(function() {
            // Função para listar categorias
            function listarCategorias(query = '') {
                $.ajax({
                    url: 'listar_categorias.php',
                    method: 'GET',
                    data: { query: query },
                    success: function(response) {
                        $('#listaCategorias').html(response);
                    }
                });
            }

            // Carregar categorias ao carregar a página
            listarCategorias();

            // Função para adicionar categoria
            $('#categoriaForm').submit(function(event) {
                event.preventDefault();
                var categoria = $('#categoria').val();
                
                $.ajax({
                    url: 'adicionar_categoria.php',
                    method: 'POST',
                    data: { categoria: categoria },
                    success: function(response) {
                        $('#categoriaForm')[0].reset();
                        listarCategorias();
                    }
                });
            });

            // Função para excluir categoria
            $(document).on('click', '.delete-btn', function() {
                var id = $(this).data('id');
                $.ajax({
                    url: 'excluir_categoria.php',
                    method: 'POST',
                    data: { id: id },
                    success: function(response) {
                        listarCategorias();
                    }
                });
            });

            // Função para editar categoria
            $(document).on('click', '.edit-btn', function() {
                var id = $(this).data('id');
                var nome = prompt("Editar categoria:", $(this).data('nome'));
                if (nome != null) {
                    $.ajax({
                        url: 'editar_categoria.php',
                        method: 'POST',
                        data: { id: id, nome: nome },
                        success: function(response) {
                            listarCategorias();
                        }
                    });
                }
            });

            // Função para buscar categorias
            $('#search').on('input', function() {
                var query = $(this).val();
                listarCategorias(query);
            });
        });
    </script>
</body>
</html>
