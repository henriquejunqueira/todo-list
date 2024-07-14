<?php

  if(isset($_GET["id"])){
    $id = $_GET["id"];

    include('./conexao.php');

    $sql = "DELETE FROM tarefas WHERE id=$id";
    $connection->query($sql);
  }

  header("location: ./index.php");
  exit;

?>