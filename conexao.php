<?php
  // ini_set('display_errors', 1);
  // ini_set('display_startup_errors', 1);
  // error_reporting(E_ALL);

  $servername = "DATABASE";
  $username = "USERNAME";
  $password = "PASSWORD";
  $database = "DATABASE";
  $port = "PORT";

  // cria a conexão
  $connection = new mysqli($servername, $username, $password, $database, $port);

  // verifica conexão
  if($connection->connect_error){
    die("Falha na conexão: " . $connection->connect_error);
  }