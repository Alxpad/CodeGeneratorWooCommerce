<?php

/* Programa que hace el chequeo sobre el pedido. Primero comprueba si el pedido existe con check_code.
* Si existe, da paso al check dele stado . Da una salida distinta según si el pedido está completado, a la espera, o en proceso.
* Remitirá la url del formulario de subida sólo si el pedido existe y está en proceso.
* En los otros caso, arrojará un mensaje de aviso distinto.
*/
require 'connect.php';
//Query to execute
$code = intval($_POST["codec"]);
$hash = $_POST["codeh"];


//Check status pedido
function check_status($cod, $con){
$sql_woo = "SELECT * FROM wp_wc_order_stats  WHERE order_id = '".$cod."'";
$result_status = mysqli_query($con, $sql_woo);

$status_order = mysqli_fetch_array($result_status,MYSQLI_ASSOC);

if ($status_order["status"] == 'wc-completed'){
    error_log("Intento de acceso a pedido completado nº ".strval($cod)." [".date('m/d/Y H:i:s',time())."]");
    echo "¡Éste pedido ya ha sido completado y enviado!";
    mysqli_close($con);
    exit();
}

else if ($status_order["status"] == 'wc-on-hold'){
    echo "¡Éste pedido está en proceso de entrega!";
    error_log("Intento de acceso a pedido en proceso nº ".strval($cod)." [".date('m/d/Y H:i:s',time())."]");
    mysqli_close($con);
    exit();
}
mysqli_close($con);
}
//TODO: -----INCLUIR AQUÍ LA FUNCIÓN QUE ENCUENTRA EL PEDIDO, PERO COMPRUEBA SI ESTÁ COMPLETADO O NO



function check_code($cod, $ha, $con, $con2){
$sql = "SELECT ID FROM codes WHERE NumPedido = '".$cod."' AND Cadena = '".$ha."'";
$result = mysqli_query($con, $sql);
    $count = mysqli_num_rows($result);
    
    if($count == 0){
        echo "No se ha encontrado el pedido solicitado en nuestros archivos. Contacte con nosotros a través del correo.";
        error_log("Intento de acceso a pedido inexistente nº ".strval($cod)." [".date('m/d/Y H:i:s',time())."]");
    if(!empty(mysqli_error($con))){
        error_log(mysqli_error($con));
    }
    mysqli_close($con);
    }

    
    if($count == 1) {
        check_status($cod, $con2);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $id_result = $row["ID"];
        $sql_verif = "UPDATE codes SET Accesos = Accesos +1 WHERE ID ='".$id_result."'";
        mysqli_query($con, $sql_verif);
        echo "Éste es el formulario";
        mysqli_close($con);
        //$sql_set = "UPDATE code_pedidos SET Verificaciones = Verificaciones + 1 WHERE ID =".$id_result;
    }
}

check_code($code, $hash, $conn, $conn2);
 ?>