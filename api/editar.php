<?php
  // ini_set('display_errors', 1);
  // ini_set('display_startup_errors', 1);
  // error_reporting(E_ALL);

  include("./conexao.php");

  $id = "";
  $titulo = "";
  $descricao = "";
  $status_tarefa = "";

  $errorMessage = "";
  $successMessage = "";

  if($_SERVER['REQUEST_METHOD'] == 'GET'){
    // Método GET: Mostra os dados da tarefa

    if(!isset($_GET["id"])){
      header("location: ./index.php");
      exit;
    }

    $id = $_GET["id"];

    // exibe a linha da tarefa selecionada na tabela do banco de dados
    $sql = "SELECT * FROM tarefas WHERE id=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if(!$row){
      header("location: ./index.php");
      exit;
    }

    $titulo = $row["titulo"];
    $descricao = $row["descricao"];
    $status_tarefa = $row["status_tarefa"];

  }else{
    // Método POST: Atualiza os dados da tarefa

    $id = $_POST["id"];
    $titulo = $_POST["titulo"];
    $descricao = $_POST["descricao"];
    $status_tarefa = $_POST["status_tarefa"];

    do{
      if(empty($id) || empty($titulo) || empty($descricao) || empty($status_tarefa)){
        $errorMessage = "Todos os campos são obrigatórios";
        break;
      }

      $sql = "UPDATE tarefas SET titulo = ?, descricao = ?, status_tarefa = ? WHERE id = ?";
      $stmt = $connection->prepare($sql);
      $stmt->bind_param("sssi", $titulo, $descricao, $status_tarefa, $id);


      if(!$stmt->execute()){
        $errorMessage = "Consulta inválida: " . $connection->error;
        break;
      }

      $successMessage = "Cliente atualizado corretamente";

      header("location: ./index.php");
      exit;

    }while(false);

  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>My Shop</title>
  </head>
  <body>
    <div class="container my-5">
      <h2>Atualizar Tarefa</h2>

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
        <input type="hidden" name="id" value="<?php echo $id; ?>">
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
              <option value="pendente" <?php if ($status_tarefa == 'pendente') echo 'selected'; ?>>Pendente</option>
              <option value="concluida" <?php if ($status_tarefa == 'concluida') echo 'selected'; ?>>Concluída</option>
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
            <button type="submit" class="btn btn-primary">Atualizar</button>
          </div>
          <div class="col-sm-3 d-grid">
            <a href="./index.php" class="btn btn-outline-primary" role="button">Cancelar</a>
          </div>
        </div>
      </form>
    </div>
  </body>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</html>