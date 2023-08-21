<script>


  /* COMENTARIOS:
  * Los mensajes de los envíos AJAX se muestran en un cuadro de texto preparado para ello.
  * Sólo hay que cambiar el texto que muestra la notificación, e iconos si acaso
  *
  * CORRECTO (Pedido existe y no está completado) -> Borra el texto y el propio server responde con la URL del formulario de subida
  * INCORRECTO ( Pedido no existe || ya se completó) -> Notificación indicando que el pedido se ha cursado con posibles vías de contacto.
  * 
  */
  
jQuery(document).ready(function(){
  const queryString = window.location.search;
	const urlParams = new URLSearchParams(queryString);
	const code_o = parseInt(urlParams.get('c'));
  const code_h = urlParams.get('h');
  jQuery.ajax({
    method:"POST",    url:'http://localhost/myalbumizer/wp-content/themes/Divi-child-theme/php/check_Code.php',
    data: {codec:code_o,
          codeh:code_h},
    error: function(){
      jQuery('#Notif').empty();
      jQuery('#Icon_notif').hide();
 jQuery('#Cuadro_notif').html("<div style='text-align:center;color:black;font-weight:bold'>Ha habido algún error en la conexión. <br>Contacte con nosotros a través de nuestro <a href='#'>correo para incidencias.</a>");
    },
    success:function(resp){
      jQuery('#Notif').empty();
      jQuery('#Icon_notif').hide();
			jQuery('#Notif').html(resp);
    	}
  });
});
</script>