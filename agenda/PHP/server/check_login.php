<?php
//Obtener las variables de inicio de sesion
$userName = $_POST['username'];
$pass = $_POST['password'];
//Conexion a la base d datos
$conection = new mysqli('localhost','frank','1234','agenda_nextu');
if($conection->connect_error){
    echo "Error al conectar: " . $conection->connect_error;
}
//Verificacion de credenciales
$sql = "SELECT * FROM usuarios WHERE mail = '$userName'";
$res = $conection->query($sql);
$rows = $res->num_rows;
if($rows > 0){
  while($fila = $res->fetch_assoc()){
    if(password_verify($pass, $fila['pass'])){
      session_start();
      $_SESSION['username'] = $fila['mail'];
      $response['msg'] = "OK";
    }else{
      $response['msg'] = "Contraseña Incorrecta";
    }
  }
}else{
  $response['msg'] = "Usuario No encontrado";
}
//Respuesta
$conection->close();
$responseJSON = json_encode($response);
echo $responseJSON;
 ?>