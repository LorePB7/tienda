<?php
include 'global/config.php';
include 'global/conexion.php';
include 'carrito.php';
include 'templates/cabecera.php';
?>
<br>
        <?php if($mensaje!=""){ ?>
         <div class="alert alert-success">
             <?php echo $mensaje; ?>

                <a href="mostrarCarrito.php" class="badge badge-success">Ver Carrito</a>
         </div>
        <?php } ?>
         <div class="row">
             <?php
                $sentencia=$pdo->prepare("SELECT * FROM `tblproductos`");
                $sentencia->execute();
                $listaProductos=$sentencia->fetchAll(PDO::FETCH_ASSOC);
               // print_r($listaProductos)
             ?>
             <?php foreach($listaProductos as $producto){ ?>
                <div class="col-3">
                 <div class="card">
                     <img 
                     title="<?php echo $producto['Nombre'];?>"
                     class="card-img-top" 
                     src="<?php echo $producto['Imágen'];?>" 
                     alt="<?php echo $producto['Nombre'];?>"
                     data-bs-toggle="popover"
                     data-bs-trigger="hover"
                     data-bs-content="<?php echo $producto['Descripción'];?>"
                     height="317px"
                     >
                     <div class="card-body">
                     <span><?php echo $producto['Nombre'];?></span>
                         <h5 class="card-title">$<?php echo $producto['Precio'];?></h5>
                         <p class="card-text">Descripción</p>

                     <form action="" method="post">

                     <input type="hidden" name="id" id="id" value="<?php echo openssl_encrypt($producto['ID'],COD,KEY);?>">
                     <input type="hidden" name="nombre" id="nombre" value="<?php echo openssl_encrypt($producto['Nombre'],COD,KEY);?>">
                     <input type="hidden" name="precio" id="precio" value="<?php echo openssl_encrypt($producto['Precio'],COD,KEY);?>">
                     <input type="hidden" name="cantidad" id="cantidad" value="<?php echo openssl_encrypt(1,COD,KEY);?>">

                     <button 
                         class="btn btn-primary"
                         name="btnAccion"
                         value="Agregar"
                         type="submit"
                         >
                         Agregar al carrito
                        </button>
                     </form>

                         
                     </div>
                 </div>
             </div>
             <?php } ?>
             
         </div>
    </div>
    <script>
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
    var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
    return new bootstrap.Popover(popoverTriggerEl)
    })
    </script>
<?php include 'templates/pie.php'; ?>