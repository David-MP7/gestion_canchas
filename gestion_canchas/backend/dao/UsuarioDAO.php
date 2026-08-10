<?php

// Importa la conexión a la base de datos
require_once __DIR__ . '/../config/database.php';

// Obtener todos los usuarios
function getUsuarios() {

  // Se conecta a la base
  $conn = conectar();

  // Ejecuta la consulta
  $res = $conn->query("SELECT * FROM usuarios");

  // Devuelve los datos en formato array
  return $res->fetch_all(MYSQLI_ASSOC);
}

// Obtener un usuario por ID
function getUsuario($id) {

  $conn = conectar();

  // Consulta preparada (más segura)
  $stmt = $conn->prepare("SELECT * FROM usuarios WHERE id = ?");

  // Vincula el parámetro
  $stmt->bind_param("i", $id);

  // Ejecuta la consulta
  $stmt->execute();

  // Devuelve un solo registro
  return $stmt->get_result()->fetch_assoc();
}
function agregarUsuario($nombre, $apellido, $telefono, $email, $contrasena) {
  $conn = conectar();

  $stmt = $conn->prepare("Insert into usuarios(nombre, apellido, telefono, email, contrasena) 
  values(?, ?, ?, ?, ?)"
  );

  $stmt->bind_param(
  "sssss", 
  $nombre, 
  $apellido, 
  $telefono, 
  $email, 
  $contrasena);

  return $stmt->execute();
}
function login($email, $contrasena) {

    $conn = conectar();

    $stmt = $conn->prepare("
        SELECT * FROM usuarios
        WHERE email = ?
    ");

    $stmt->bind_param("s", $email);

    $stmt->execute();

    $usuario = $stmt->get_result()->fetch_assoc();

    if ($usuario && password_verify($contrasena, $usuario["contrasena"])) {
        return $usuario;
    }

    return false;
}
?>