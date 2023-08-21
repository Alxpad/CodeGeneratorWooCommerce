<?php
// Genera el enlace para el botón que recibe el cliente para el envío de fotos.
require 'connect.php';

$order = intval($_POST["order"]);
$sql = "SELECT * FROM codes WHERE NumPedido = '".$order."'";

$result = mysqli_query($conn, $sql);
if(empty($result)){
    if(!empty(mysqli_error($conn))){
        error_log(mysqli_error($conn));
    }
    exit();
}
else{
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $link_out = "http://localhost/myalbumizer/133-2/?c=".strval($order)."&h=".strval($row["Cadena"]);
    echo $link_out;

}
mysqli_close($conn);

?>