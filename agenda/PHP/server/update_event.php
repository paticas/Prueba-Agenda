<?php
session_start();
if (isset($_SESSION['username'])){
  //variable de sesion
  $usuario = $_SESSION['username'];
  //Obtener datos desde Cliente
  $idEvento = $_POST['id'];
  $fechaInicio = $_POST['start_date'];
  $horaInicio = $_POST['start_hour'];
  $fechaFinal = $_POST['end_date'];
  $horaFinal = $_POST['end_hour'];
  //Conexion a la base d datos
  $conection = new mysqli('localhost','frank','1234','agenda_nextu');
  if($conection->connect_error){
      echo "Error al conectar: " . $conection->connect_error;
  }
  //Editar de Base de datos
  $sql = "UPDATE eventos SET fechaInicio = '$fechaInicio', horaInicio = '$horaInicio', fechaFinal = '$fechaFinal', horaFinal = '$horaFinal' WHERE id='$idEvento' AND usuario='$usuario'";
  $res =  $conection->query($sql);
  //Respuesta
  $response['msg'] = "OK";
  $conection->close();
  $responseJSON = json_encode($response);
  echo $responseJSON;
}
 ?>