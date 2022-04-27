<?php
  require "vendor/autoload.php";
  MercadoPago\SDK::setAccessToken("TEST-8221914580112236-042519-c2e2c4462e8a9d4bb2171aa8533e1bb7-292116879");
  $preference = new MercadoPago\Preference();

  $item = new MercadoPago\Item();
  $item->title = "Blue shirt";
  $item->quantity = 10;
  $item->currency_id = "ARS";
  $item->unit_price = 150;

  $payer = new MercadoPago\Payer();
  $payer->email = "test_user_19653727@testuser.com";

  $preference->items = array($item);
  $preference->payer = $payer;
  $preference->save();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script src="https://sdk.mercadopago.com/js/v2"></script>
</head>
<body>
    <h3>Mercado Pago</h3>

    <div class="checkout-btn"></div>

    

    <script>
			//Adicione as credenciais de sua conta Mercado Pago junto ao SDK
			const mp = new MercadoPago('TEST-d12b8954-eb42-49a5-a133-2c6f2b73c5b6', {
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