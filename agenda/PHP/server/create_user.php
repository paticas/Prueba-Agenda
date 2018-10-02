<?php
//Coneccion a la base de datos
$conection = new mysqli('localhost','frank','1234','agenda_nextu');
if($conection->connect_error){
    echo "Error al conectar: " . $conection->connect_error;
}
//Agregar usuarios
$insert = $conection->prepare('INSERT INTO usuarios(mail, nombre, pass, nacimiento) VALUES (?,?,?,?)');
$insert->bind_param("ssss",$mail, $nombre, $pass, $nacimiento);
$mail = "frank_santills@hotmail.com";
$nombre = "Frank Santillan";
$pass = password_hash("1234", PASSWORD_DEFAULT);
$nacimiento = "13-12-91";
$insert->execute();
$mail = "juan_perez@hotmail.com";
$nombre = "Juan Perez";
$pass = password_hash("12345", PASSWORD_DEFAULT);
$nacimiento = "15-09-85";
$insert->execute();
$mail = "jhon_doe@hotmail.com";
$nombre = "John Doe";
$pass = password_hash("123456", PASSWORD_DEFAULT);
$nacimiento = "12-01-75";
$insert->execute();
echo "Usuarios creados...";
$conection->close();
 ?>