<?php

  $servername = "localhost";
  $username = "henrique";
  $password = "slipknot1994";
  $database = "todos";

  // cria a conexão
  $connection = new mysqli($servername, $username, $password, $database);

  // verifica conexão
  if($connection->connect_error){
    die("Falha na conexão: " . $connection->connect_error);
  }