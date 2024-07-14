<?php
  // ini_set('display_errors', 1);
  // ini_set('display_startup_errors', 1);
  // error_reporting(E_ALL);

  $servername = getenv("MYSQLHOST");
  $username = getenv("MYSQLUSER");
  $password = getenv("MYSQLPASSWORD");
  $database = getenv("MYSQLDATABASE");
  $port = getenv("MYSQLPORT");

  // cria a conexão
  $connection = new mysqli($servername, $username, $password, $database, $port);
  // $conn = "mysql://$username:$password@$servername:$port/$database";
  // $connection = new mysqli($conn);

  // verifica conexão
  if($connection->connect_error){
    die("Falha na conexão: " . $connection->connect_error);
  }