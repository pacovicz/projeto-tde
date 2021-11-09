<?php

$nome = $_POST["first-name"];
$sobrenome = $_POST["last-name"];
$email = $_POST["email"];
$celular = $_POST["cellphone"];
$senha = $_POST["password"];

$conn = mysqli_connect("localhost:8080", "root", "root", "dbtde");

if ($conn->connect_error) {
  die("Conexão falhou: " . $conn->connect_error);
}

$usuario_existente = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM usuarios 
    WHERE email = '$email';"));

if ($usuario_existente > 0) {
  $error = new stdClass;
  $error->erro = true;
  $error->mensagem = 'Usuário com mesmo email já cadastrado';
  echo json_encode($error);
  return;
}

mysqli_query($conn, "INSERT INTO usuarios (nome, sobrenome, email, celular, senha) 
    VALUES ('$nome', '$sobrenome', '$email', '$celular', '$senha')");

echo json_encode("Sucesso!");
