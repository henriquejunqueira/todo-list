<?php
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);

  include("./conexao.php");
  
  $id = "";
  $titulo = "";
  $descricao = "";
  $status_tarefa = "";

  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $titulo = $_POST["titulo"];
    $descricao = $_POST["descricao"];
    $status_tarefa = $_POST["status_tarefa"];

    $errorMessage = "";
    $successMessage = "";

    do{
      if(empty($titulo) || empty($descricao)){
        $errorMessage = "Todos os campos são obrigatórios";
        break;
      }

      // verifica se o título já existe
      $stmt = $connection->prepare("SELECT * FROM tarefas WHERE titulo = ?");
      $stmt->bind_param("s", $titulo);
      $stmt->execute();
      $result = $stmt->get_result();
      
      if ($result->num_rows > 0) {
          $errorMessage = "Já existe uma tarefa com esse nome.";
          break;
      }
      
      $stmt->close();

      // adiciona uma nova tarefa ao banco de dados
      $stmt = $connection->prepare("INSERT INTO tarefas (titulo, descricao, status_tarefa) VALUES (?, ?, ?)");
      $stmt->bind_param("sss", $titulo, $descricao, $status_tarefa);

      if ($stmt->execute()) {
          $successMessage = "Tarefa adicionada corretamente";
      } else {
          $errorMessage = "Erro: " . $stmt->error;
      }

      $stmt->close();

      $titulo = "";
      $descricao = "";
      $status_tarefa = "";

      if (empty($errorMessage)) {
        header("location: ./index.php");
        exit;
      }

    }while(false);

  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Todo List</title>
  </head>
  <body>
    <div class="container my-5">
      <h2>Nova Tarefa</h2>

      <?php
        if(!empty($errorMessage)){
          echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
              <strong>$errorMessage</strong>
              <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
          ";
        }
      ?>

      <form method="post">
        <div class="row mb-3">
          <label class="col-sm-3 col-form-label">Título</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" name="titulo" value="<?php echo $titulo ?>">
          </div>
        </div>
        <div class="row mb-3">
          <label class="col-sm-3 col-form-label">Descrição</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" name="descricao" value="<?php echo $descricao ?>">
          </div>
        </div>
        
        <div class="row mb-3">
          <label class="col-sm-3 col-form-label">Status</label>
          <div class="col-sm-6">
            <select class="form-control" name="status_tarefa" id="status_tarefa">
              <option value="pendente">Pendente</option>
              <option value="concluida">Concluída</option>
            </select>
          </div>
        </div>

        <?php
          if(!empty($successMessage)){
            echo "
              <div class='row mb-3'>
                <div class='offset-sm-3 col-sm-6'>
                  <div class='alert alert-success alert-dismissible fade show' role='alert'>
                    <strong>$successMessage</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                  </div>
                </div>
              </div>
            ";
          }
        ?>

        <div class="row mb-3">
          <div class="offset-sm-3 col-sm-3 d-grid">
            <button type="submit" class="btn btn-success"><i class="bi bi-check-circle"></i> Cadastrar</button>
          </div>
          <div class="col-sm-3 d-grid">
            <a href="./index.php" class="btn btn-outline-primary" role="button"><i class="bi bi-x-circle"></i> Cancelar</a>
          </div>
        </div>
      </form>
    </div>
  </body>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</html>