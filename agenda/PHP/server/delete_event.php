<?php
session_start();
if (isset($_SESSION['username'])){
  //variable de sesion
  $usuario = $_SESSION['username'];
  //Obtener datos desde Cliente
  $idEvento = $_POST['id'];
  //Conexion a la base d datos
  $conection = new mysqli('localhost','frank','1234','agenda_nextu');
  if($conection->connect_error){
      echo "Error al conectar: " . $conection->connect_error;
  }
  //Eliminar de Base de datos
  $sql = "DELETE FROM eventos WHERE id='$idEvento' AND usuario='$usuario'";
  $res =  $conection->query($sql);
  //Respuesta
  $response['msg'] = "OK";
  $conection->close();
  $responseJSON = json_encode($response);
  echo $responseJSON;
}
 ?>
