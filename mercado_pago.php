<?php
  require __DIR__.'/vendor/autoload.php';
  $accessToken="TEST-1627583639589383-050222-b50ca23e510f4b5e7c38b655bdb39d44-292116879";
  MercadoPago\SDK::setAccessToken($accessToken);
  $preference = new MercadoPago\Preference();

  $preference->back_urls= array(
    "success"=>"http://localhost/tienda/correcto.php",
    "failure"=>"http://localhost/tienda/falla.php",
    "pending"=>"http://localhost/tienda/falla.php"
  );

  $preference->auto_return = "approved";
  $preference->binary_mode = true;

  $productos=[];
  $item = new MercadoPago\Item();
  $item->title = $producto['NOMBRE'];
  $item->quantity = 1;
  $item->unit_price = $total;
  array_push($productos,$item);

  $preference->items = $productos;
  $preference->save();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="checkout-btn"></div>
	<script src="https://sdk.mercadopago.com/js/v2"></script>
    <script>
			//Adicione as credenciais de sua conta Mercado Pago junto ao SDK
            var public_key= "TEST-09193cf9-4a6e-44fc-8f21-316b6612df51";
			const mp = new MercadoPago(public_key, {
			    locale: 'es-AR'
			});
			const checkout = mp.checkout({
			   preference: {
			       id: '<?php echo $preference->id ?>' // Indica el ID de la preferencia
			   },
			   render: {
			       container: '.checkout-btn', // Clase CSS para renderizar el botón de pago
			       label: 'Pagar con MercadoPago', // Cambiar el texto del botón de pago (opcional)
			    }
			});
	</script>
</body>
</html>
