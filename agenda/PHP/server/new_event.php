<?php
session_start();
if (isset($_SESSION['username'])){
  //variable de sesion
  $usuario = $_SESSION['username'];
  //Obtener datos desde Cliente
  $titulo = $_POST['titulo'];
  $fechaInicio = $_POST['start_date'];
  $horaInicio = $_POST['start_hour'];
  $fechaFinal = $_POST['end_date'];
  $horaFinal = $_POST['end_hour'];
  $diaCompleto = $_POST['allDay'];
  //Conexion a la base d datos
  $conection = new mysqli('localhost','frank','1234','agenda_nextu');
  if($conection->connect_error){
      echo "Error al conectar: " . $conection->connect_error;
  }
  //Agregar evento
  if($diaCompleto == True){
    $diaCompleto = 1;
  }else if($diaCompleto == false){
    $diaCompleto = 0;
  }
  $sql = "INSERT INTO eventos (usuario, titulo, fechaInicio, horaInicio, fechaFinal, horaFinal, diaCompleto) VALUES ('$usuario', '$titulo', '$fechaInicio', '$horaInicio', '$fechaFinal', '$horaFinal', '$diaCompleto')";
  $res = $conection->query($sql);
  $response['msg'] = "OK";
  $conection->close();
  $responseJSON = json_encode($response);
  echo $responseJSON;
}else{
  $response['msg'] = 'Inicia Sesion Primero';
  $responseJSON = json_encode($response);
  echo $responseJSON;
}
?>