<?php
session_start();
if (isset($_SESSION['username'])) {
  //variable de sesion
  $usuario = $_SESSION['username'];
  //Conexion a la base d datos
  $conection = new mysqli('localhost','frank','1234','agenda_nextu');
  if($conection->connect_error){
      echo "Error al conectar: " . $conection->connect_error;
  }
  //Obtener eventos
  $sql = "SELECT * FROM eventos WHERE usuario = '$usuario'";
  $res = $conection->query($sql);
  $rows = $res->num_rows;
  if($rows > 0){
    $eventos = array();
    while($fila = $res->fetch_assoc()){
      if($fila['diaCompleto'] == 0){
        $auxDia = FALSE;
      }else if($fila['diaCompleto'] == 1){
        $auxDia = TRUE;
      }
      $eventos[] = array(
             'id' => $fila['id'],
             'title' => $fila['titulo'],
             'start' => $fila['fechaInicio']. "T" . $fila['horaInicio'],
             'end' => $fila['fechaFinal'] . "T" . $fila['horaFinal'],
             'allDay' => $auxDia
       );
    }
    $response['eventos'] = $eventos;
  }else{
    $response['eventos'] = "No hay eventos";
  }
  $response['msg'] = "OK";
  $conection->close();
  $responseJSON = json_encode($response);
  echo $responseJSON;
}else{
  $response['msg'] = "Inicia Sesion Primero";
  $responseJSON = json_encode($response);
  echo $responseJSON;
}
 ?>