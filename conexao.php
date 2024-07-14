<?php
  // ini_set('display_errors', 1);
  // ini_set('display_startup_errors', 1);
  // error_reporting(E_ALL);
  
  // $servername = "localhost";
  // $username = "henrique";
  // $password = "slipknot1994";
  // $database = "todos";

  $servername = "MYSQLHOST";
  $username = "MYSQLUSER";
  $password = "MYSQLPASSWORD";
  $database = "MYSQLDATABASE";
  $port = "MYSQLPORT";

  // cria a conexão
  $connection = new mysqli($servername, $username, $password, $database, $port);

  // verifica conexão
  if($connection->connect_error){
    die("Falha na conexão: " . $connection->connect_error);
  }