<?php
include_once('config/config.inc.php'); //cargando archivo de configuracion

$uM = load_model('usuario');
$aM = load_model('articulos');
$iM = load_model('inputs');
$cM = load_model('carrito');
$hM = load_model('html');


$id_usuario = isset($_SESSION['id_usuario']) ? $_SESSION['id_usuario'] : '';
if(isset($_POST['transporte'])){
    $_SESSION['transporte']=$_POST['transporte'];
}
$gasto_envio = isset($_SESSION['transporte']) ? $_SESSION['transporte'] : '';
$precioEnvio = 0;
$carrito_compra = array('123','1234');
$orgcc = '';
$qttCarrito = 1;
$sumaTotal = 0;
//datos
$id_carrito=0;
$predeterminada = false;
$nombre = '';
$apellidos = '';
$direccion = '';
$cp = '';
$poblacion = '';
$movil = '';
$str_error = '';
$str_success = '';
$old = '';
$oldad = '';
$cont_direcciones = 0;
$oca = '';
$iva = 0.21;
$otransporte = '';
//datos

//GET__________________________________________________________________________
if(isset($_GET['opc'])){
    switch($_GET['opc']){
        case "del":
            $rdd = $cM->delete_direccion($id_usuario, $_GET['direccion']);
            if($rdd){
                $str_success = 'Dirección de envio eliminada correctamente!';
            }else{
                $str_error = 'No ha sido posible eliminar la dirección de envío';
            }
            break;
        case "update":
            $rrdc = $cM->reset_predeterminada_carrito($id_usuario);
            if($rrdc){
                $cM->update_predeterminada_carrito($id_usuario, $_GET['carrito']);
            }else{
                $str_error = 'No ha sido posible seleccionar la dirección de envío';
            }
            break;
    }
}
//GET__________________________________________________________________________

//POST__________________________________________________________________________
if(isset($_POST['id_carrito'])){
    switch($_POST['id_carrito']){
        case 0:
            $rade = $cM->add_direccion_envio($id_usuario, $_POST['nombre_usuario'], $_POST['apellidos_usuario'], $_POST['direccion_usuario'], $_POST['cp_usuario'], $_POST['poblacion_usuario'], $_POST['movil_usuario']);
            if($rade){
                //header("Refresh:0");
                $str_success = 'Dirección de envio añadia correctamente!';
            }else{
                $str_error = 'Error al añadir la dirección de envio';
            }
            break;
        default:
            $rude = $cM->update_direccion_envio($id_usuario, $_POST['nombre_usuario'], $_POST['apellidos_usuario'], $_POST['direccion_usuario'], $_POST['cp_usuario'], $_POST['poblacion_usuario'], $_POST['movil_usuario'], $_POST['id_carrito']);
            if($rude){
                $str_success = 'Actualizado correctamente!';
            }else{
                $str_error = 'No ha sido posible actulizar los datos';
            }
            break;
    }
}
//POST__________________________________________________________________________

//LISTADO______________________________________________________________________
if($id_usuario>0){
    $rgd = $cM->get_direcciones($id_usuario, 1);
    if($rgd){
        while($frgd = $rgd->fetch_assoc()){
            $old .= '<div class="green-bg my-2 p-3">';
            $old .= '<p class="my-0">'.$frgd['nombre'].' '.$frgd['apellidos'].'</p>';
            $old .= '<p class="my-0">'.$frgd['direccion'].'</p>';
            //$old .= '<p class="my-0">'.$frgd['codigo_postal'].'</p>';
            $old .= '<p class="my-0">'.$frgd['poblacion'].', '.$frgd['codigo_postal'].'</p>';
            $old .= '<p class="my-0">'.$frgd['movil'].'</p>';
            $old .= '<hr><div class="d-flex justify-content-end text-right">';
            $old .= '<p class="mb-1 mx-2" data-toggle="modal" data-target="#modalDireccion'.$cont_direcciones.'">Editar</p><a href="?opc=del&direccion='.$frgd['id_carrito'].'"><p class="mb-1 mx-2">Eliminar</p></a>';
            $old .= '</div></div>';
            $old .= '<div class="modal fade" id="modalDireccion'.$cont_direcciones.'" tabindex="-1" role="dialog" aria-labelledby="modalDireccion'.$cont_direcciones.'Label" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header info-datos">
            <h5 class="modal-title" id="modalDireccion'.$cont_direcciones.'Label">Añadir y/o Editar dirección de Envio</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button></div>
            <form action="" method="post"><div class="modal-body">';
            $old .= $iM->get_input_hidden('id_carrito', $frgd['id_carrito']);
            $old .= $iM->get_input_text('nombre_usuario', $frgd['nombre'], 'form-control', '', 'Nombre');
            $old .= $iM->get_input_text('apellidos_usuario', $frgd['apellidos'], 'form-control', '', 'Apellidos');
            $old .= $iM->get_input_text('direccion_usuario', $frgd['direccion'], 'form-control', '', 'Direccion');
            $old .= $iM->get_input_text('cp_usuario', $frgd['codigo_postal'], 'form-control', '', 'Código Postal');
            $old .= $iM->get_input_text('poblacion_usuario', $frgd['poblacion'], 'form-control', '', 'Población');
            $old .= $iM->get_input_text('movil_usuario', $frgd['movil'], 'form-control', '', 'Móvil');
            $old .= '</div><div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Guardar</button>
            </div></form></div></div></div>';
                $cont_direcciones++;
        }
    }
    $rgt = $cM->get_transporte();
    if($rgt){
        $otransporte .= '<form id="frmenvio" method="post" class="m-0">';
        while($frgt = $rgt->fetch_assoc()){
            $otransporte .= '<div class="input-group my-1">
            <div class="input-group-prepend">
              <div class="input-group-text">
              <input ';
              if($gasto_envio==$frgt['id_transporte']){
                  $otransporte .= 'checked';
                  $precioEnvio = $frgt['precio'];
              }
            $otransporte .= ' type="radio" name="transporte" value="'.$frgt['id_transporte'].'">
              </div>
            </div>
            <p class="form-control">'.$frgt['nombre'].' <strong>'.$frgt['precio'].'€</strong></p>
          </div>';
        }
        $otransporte .= '</form>';
    }
    $rgd2 = $cM->get_direcciones($id_usuario, 0);
    if($rgd2){
        while($frgd2 = $rgd2->fetch_assoc()){
            $oldad .= '<div class="my-2 p-3">';
            $oldad .= '<p class="my-0">'.$frgd2['nombre'].' '.$frgd2['apellidos'].'</p>';
            $oldad .= '<p class="my-0">'.$frgd2['direccion'].'</p>';
            $oldad .= '<p class="my-0">'.$frgd2['poblacion'].', '.$frgd2['codigo_postal'].'</p>';
            $oldad .= '<p class="my-0">'.$frgd2['movil'].'</p>';
            $oldad .= '<a href="?opc=update&carrito='.$frgd2['id_carrito'].'"><button type="button" class="btn mt-2 br-n-c">Enviar a esta dirección</button></a>
            </div><hr>';
        }
    }
    $rgcc = $cM->get_carrito($id_usuario,$_SESSION['lang']);
    if($rgcc){
        while($frgcc = $rgcc->fetch_assoc()){
            $oca .= '<div class="articulos-enviar-item">
            <img src="'.$ruta_inicio.'img/productos/';
            if($frgcc["img_portada"]!=""){
                $oca .= $frgcc["img_portada"];
            }else{
                $oca .= $frgcc["img"];
            }
            $oca .= '" alt="">
            <div class="articulos-enviar-texto-info">
                '.$frgcc['nombre'].'
                    <div class="stock">
                        Unidades: '.$frgcc['cantidad'].'
                        <br>
                        Disponibilidad: ';
            if($frgcc['stock']>=$frgcc['cantidad']){
                $oca .= '<span class="positive-emp">En stock</span>';
            }else{
                $oca .= '<span class="negative-emp">Sin stock</span>';
            }
            $oca .= '</div>
            </div>
        </div>';
        $sumaTotal+=($frgcc["precio"]*$frgcc["cantidad"]);
        }
    }
}
//LISTADO______________________________________________________________________
include_once('inc/cabecera.inc.php'); //cargando cabecera 
?>
<script type="text/javascript">
    $(document).ready(function(){
        $('input[type="radio"]').change(function(){
            $('#frmenvio').submit();
        });
    });
</script>

<body>
    <?php //include_once('inc/franja_top.inc.php'); ?>
    <?php //include_once('inc/main_menu.inc.php'); ?>
    <?php //include_once('inc/panel_top_experiencia.inc.php'); ?>
    <?php //include_once('inc/navbar_inicio_experiencia.inc.php'); ?>
    <?php include_once('inc/panel_top.inc.php'); ?>
    <?php include_once('inc/navbar_inicio_experiencia.inc.php'); ?>
    <div class="bg-carrito">
        <div class="container carrito-datos">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-8 my-4">
                        <?php
                        if($str_error){
                            echo $hM->get_alert_danger($str_error);
                        ?>
                        <div class="mb-3"></div>
                        <?php }else if($str_success){
                            echo $hM->get_alert_success($str_success);
                        ?>
                        <div class="mb-3"></div>
                        <?php } ?>
                        <div class="info-datos">
                            <div class="info-resumen">
                                <div class="d-flex justify-content-between">
                                    <h5>Dirección de entrega</h5>
                                    <a data-toggle="modal" data-target="#modalDireccionSeleccionar">Seleccionar otra dirección</a>
                                </div>
                                <!-- Modal -->
                                <div class="modal fade" id="modalDireccionSeleccionar" tabindex="-1" role="dialog" aria-labelledby="modalDireccionSeleccionarLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header info-datos">
                                                <h5 class="modal-title" id="modalDireccionSeleccionarLabel">Añadir y/o Editar dirección de Envio</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="" method="post">
                                                <div class="modal-body">
                                                    <?php echo $oldad; ?>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <?php echo $old; ?>
                                </div>
                                <div class="botones mt-3">
                                    <button id="btndireccion" class="btnAdddireccion btn btn-lg" data-toggle="modal" data-target="#modalDireccion">+ Añadir dirección de envío</button>
                                </div>
                            </div>
                        </div>
                        <div class="articulos-enviar">
                            <div class="articulos-enviar-title">Envío de 1 artículo(s)</div>
                            <div class="articulos-enviar-list-items">
                                <?php echo $oca; ?>
                                <!-- <div class="articulos-enviar-item">
                                    <img src="//thumb.pccomponentes.com/w-85-85/articles/14/144765/a3.jpg" alt="">
                                    <div class="articulos-enviar-texto-info">
                                            Toshiba OCZ TR200 SSD 240GB SATA3
                                            <div class="stock">
                                                Unidades: 1
                                                <br>
                                                Disponibilidad: En stock
                                            </div>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="modalDireccion" tabindex="-1" role="dialog" aria-labelledby="modalDireccionLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header info-datos">
                                        <h5 class="modal-title" id="modalDireccionLabel">Añadir y/o Editar dirección de Envio</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="" method="post">
                                        <div class="modal-body">
                                            <?php
                                                echo $iM->get_input_hidden('id_carrito', $id_carrito);
                                                echo $iM->get_input_text('nombre_usuario', $nombre, 'form-control', '', 'Nombre');
                                                echo $iM->get_input_text('apellidos_usuario', $apellidos, 'form-control', '', 'Apellidos');
                                                echo $iM->get_input_text('direccion_usuario', $direccion, 'form-control', '', 'Direccion');
                                                echo $iM->get_input_text('cp_usuario', $cp, 'form-control', '', 'Código Postal');
                                                echo $iM->get_input_text('poblacion_usuario', $poblacion, 'form-control', '', 'Población');
                                                echo $iM->get_input_text('movil_usuario', $movil, 'form-control', '', 'Móvil');
                                            ?>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="btn btn-primary">Guardar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="info-datos transporte">
                            <div class="info-resumen">
                                <?php echo $otransporte; ?>
                            </div>
                        </div>
                </div>
                <div class="pedido show col-12 col-md-12 col-lg-4 my-4">
                    <div class="info-pago">
                        <div class="ticket-resumen">
                            <div class="ticket-pago">
                                <div class="ticket-pago_desglose">
                                    <div class="ticket-pago_articulos">
                                        <div class="d-flex flex-column">
                                            <strong class="w-100">
                                                <span>IVA (21%)</span>
                                                <span data-precio-total class="pull-xs-right"><?php echo round($sumaTotal*$iva,2); ?> €</span>
                                            </strong>
                                            <strong class="w-100">
                                                <span>Gastos de envío</span>
                                                <span data-precio-total class="pull-xs-right"><?php echo $precioEnvio; ?> €</span>
                                            </strong>
                                        </div>
                                    </div>
                                    <div class="ticket-pago_total">
                                        <strong class="w-100">
                                            <?php echo $lng['experiencia-carrito'][7]; ?>
                                            <span data-precio-total class="pull-xs-right"><?php echo ($sumaTotal+$precioEnvio); ?> €</span>
                                        </strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form method="post" action="">
                            <button type="submit" name="btnPedido" class="btn bg-blue-ysana btn-lg btn-block mt-2 text-light">
                                <?php echo $lng['experiencia-carrito'][9]; ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php include_once('inc/footer.inc.php'); ?>
</body>

</html>