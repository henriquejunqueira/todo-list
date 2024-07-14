<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>
    <div class="container my-5">
      <h2>Todo List</h2>
      <a class="btn btn-primary" href="./cadastrar.php" role="button">Nova Tarefa</a>
      <br>
      <table class="table">
        <thead>
          <tr>
            <th>Título</th>
            <th>Descrição</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <?php

						include("./conexao.php");

            // lê todas as linhas da tabela do banco de dados
            $sql = "SELECT * FROM tarefas";
            $result = $connection->query($sql);

            if(!$result){
              die("Invalid query: " . $connection->error);
            }

            // lê os dados de cada linha
            while($row = $result->fetch_assoc()){
              echo "
                <tr>
                  <td>$row[titulo]</td>
                  <td>$row[descricao]</td>
                  <td>$row[status_tarefa]</td>
                  <td>
                    <a href='editar.php?id=$row[id]' class='btn btn-primary btn-sm'>Editar</a>
                    <a href='remover.php?id=$row[id]' class='btn btn-danger btn-sm'>Remover</a>
                  </td>
                </tr>
              ";
            }

          ?>
          
        </tbody>
      </table>
    </div>
  </body>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</html>