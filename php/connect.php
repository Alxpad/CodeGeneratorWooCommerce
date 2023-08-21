<?php
// Archivo de conexión a la base de datos.

$servername="localhost";
$username="root";
$password="";

$conn=mysqli_connect($servername,$username,$password);
if(!$conn)
  echo "Error in Connection".mysqli_error();

$dbcheck=mysqli_select_db($conn,"code_pedidos");
if(!$dbcheck)
	echo "Error selecting Database<br>".mysqli_error();
//else echo "Success";

  //mysql_close($conn);

  //------------- Consexión a woocommerce

  $conn2=mysqli_connect($servername,$username,$password);
if(!$conn2)
  echo "Error in Connection".mysqli_error();

$dbcheck2=mysqli_select_db($conn2,"main_albumizer");
if(!$dbcheck2)
	echo "Error selecting Database<br>".mysqli_error();
//else echo "Success";

  //mysql_close($conn);


  ?>