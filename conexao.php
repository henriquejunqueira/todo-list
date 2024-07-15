<?php
  // ini_set('display_errors', 1);
  // ini_set('display_startup_errors', 1);
  // error_reporting(E_ALL);

  $servername = getenv("SERVERNAME");
  $username = getenv("USERNAME");
  $password = getenv("PASSWORD");
  $database = getenv("DATABASE");
  $port = getenv("PORT");

  // cria a conexão
  $connection = new mysqli($servername, $username, $password, $database, $port);

  // verifica conexão
  if($connection->connect_error){
    die("Falha na conexão: " . $connection->connect_error);
  }

  // Teste simples de consulta ao banco de dados (opcional)
  $result = $mysqli->query("SELECT NOW()");
  $row = $result->fetch_assoc();
  echo "Current time: " . $row['NOW()'];