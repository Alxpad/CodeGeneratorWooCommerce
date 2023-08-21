<?php
/*---Add these functions to functions.php---*/

/*-----------------------------------------FUNCIONES AÑADIDAS ------------------------------------*/

// Genera hash para cada pedido

function hashIt($id){
	$hashable = $id.time();
	$out = hash('md5', $hashable);
	return $out;
}

// define woocommerce_order_status_completed callback function
function add_order_codeTable( $order_id ) { 
    error_log("Se ha completado un pedido de WooCommerce, con id: ".$order_id,0);
	if (!require('php/connect.php')){
		error_log("ERROR en acceso a connect.php");
	};
	$sql = "SELECT * FROM codes WHERE NumPedido = ".$order_id;
	$result = mysqli_query($conn,$sql);
	$count = mysqli_num_rows($result);
	
	if($count == 1) {
		error_log ("Error: Pedido duplicado en code_pedidos (".date('m/d/Y H:i:s', time().")"));
	}

	else{
		error_log("Iniciando registro...");
		$hash = hashIt($order_id);
		$query = "INSERT INTO codes(NumPedido, Cadena) VALUES(".$order_id.",'".$hash."')";
		if (mysqli_query($conn,$query)){
			error_log("Inscripción enviada");
			error_log("Registrado pedido code: ".$order_id." hash: ".$hash);
		}
		else{
			error_log("Error en conexión".mysqli_error($conn));
		}
		
	}
	mysqli_close($conn);



};

add_action( 'woocommerce_thankyou', 'add_order_codeTable');

?>