<?php
include_once('../config/config.inc.php'); //cargando archivo de configuracion

$uM = load_model('usuario');
$aM = load_model('articulos');
$iM = load_model('inputs');

$id_usuario = '';
$id_producto = '';
$id_articulo = 0;
$nombre = 'N/A';
$nombre_categoria = 'N/A';
$usos_prod = array();
$info_producto = array();
$descripcion = 'N/A';
$stock=0;
$precio = 'N/A';

$consejo_producto = array(
    array('titulo'=>'Titulo','des'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque ut commodo quam, id aliquet sem. Cras interdum sed elit quis malesuada. Vivamus mauris enim, fermentum ut tempor nec, ultrices ac nisi. Vestibulum facilisis, sapien ut faucibus elementum, nibh enim vestibulum orci, sed auctor ante enim eget tortor. Ut vel faucibus est, quis dictum arcu. Etiam eu justo quis felis ornare mattis. Nulla facilisi. Etiam arcu diam, feugiat aliquam iaculis et, scelerisque a est. Donec nisi leo, cursus vitae purus nec, ultrices fermentum quam.')
);
$preguntas_producto = array(
    array('titulo'=>'Pregunta lorem ipsuuuum','des'=>'Respuesta a lorem ipsuuuuuuuuuuum.','puntuacion'=>9,'fecha_valoracion'=>'20-08-2018','nombre_usuario'=>'Dani','apellidos_usuario'=>'AdStorm'),
    array('titulo'=>'Pregunta lorem ipsuuuum','des'=>'Respuesta a lorem ipsuuuuuuuuuuum.','puntuacion'=>2,'fecha_valoracion'=>'20-08-2018','nombre_usuario'=>'Sergio','apellidos_usuario'=>'AdStorm')
);
$valoracion_producto = array(
    array('titulo'=>'Pregunta lorem ipsuuuum','des'=>'Respuesta a lorem ipsuuuuuuuuuuum.','puntuacion'=>9,'fecha_valoracion'=>'20-08-2018','nombre_usuario'=>'Dani','apellidos_usuario'=>'AdStorm'),
    array('titulo'=>'Pregunta lorem ipsuuuum','des'=>'Respuesta a lorem ipsuuuuuuuuuuum.','puntuacion'=>6,'fecha_valoracion'=>'20-08-2018','nombre_usuario'=>'Sergio','apellidos_usuario'=>'AdStorm'),
    array('titulo'=>'Pregunta lorem ipsuuuum','des'=>'Respuesta a lorem ipsuuuuuuuuuuum.','puntuacion'=>7,'fecha_valoracion'=>'20-08-2018','nombre_usuario'=>'Dani','apellidos_usuario'=>'AdStorm'),
    array('titulo'=>'Pregunta lorem ipsuuuum','des'=>'Respuesta a lorem ipsuuuuuuuuuuum.','puntuacion'=>3,'fecha_valoracion'=>'20-08-2018','nombre_usuario'=>'Sergio','apellidos_usuario'=>'AdStorm')
);

$imgs_producto = array();
$cantidad_productos = array('1','2','3','4','5','6');
$count_valoracion_producto = 4;
$total_valoracion_producto = 7;
//GET__________________________________________________________________________
(isset($_GET['id_articulo'])) ? $id_articulo=$_GET['id_articulo'] : '';
$id_producto = (isset($_GET['id'])) ? $_GET['id'] : '';

//GET__________________________________________________________________________

//LISTADO______________________________________________________________________
$encontrado = false;
$cont_prod = 0;
$cont_prod_cat = 0;
//echo '<h1>'.count($productos_ysana_df).'</h1>';
while(!$encontrado && $cont_prod<count($productos_ysana_df)){
    //echo '<h1>'.$productos_ysana_df[$cont_prod]['nombre_categoria'].'</h1>';
    while(!$encontrado && $cont_prod_cat<count($productos_ysana_df[$cont_prod]['productos_categoria'])){
        if($id_producto==$productos_ysana_df[$cont_prod]['productos_categoria'][$cont_prod_cat]['url-seo']){
            $encontrado=true;
            $nombre=$productos_ysana_df[$cont_prod]['productos_categoria'][$cont_prod_cat]['nombre'];
            $nombre_categoria=$productos_ysana_df[$cont_prod]['nombre_categoria'];
            $usos_prod=$productos_ysana_df[$cont_prod]['productos_categoria'][$cont_prod_cat]['usos'];
            $descripcion=$productos_ysana_df[$cont_prod]['productos_categoria'][$cont_prod_cat]['descripcion'];
            $stock=$productos_ysana_df[$cont_prod]['productos_categoria'][$cont_prod_cat]['stock'];
            $precio=$productos_ysana_df[$cont_prod]['productos_categoria'][$cont_prod_cat]['precio'];
            $info_producto=$productos_ysana_df[$cont_prod]['productos_categoria'][$cont_prod_cat]['informacion'];
        }
        $cont_prod_cat++;
    }
    $cont_prod_cat=0;
    $cont_prod++;
}
//LISTADO______________________________________________________________________
include_once('../inc/cabecera.inc.php'); //cargando cabecera 
?>
<script type="text/javascript">
</script>

<body>
    <?php //include_once('../inc/franja_top.inc.php'); ?>
    <?php //include_once('../inc/main_menu.inc.php'); ?>
    <?php include_once('../inc/panel_top_experiencia.inc.php'); ?>
    <?php include_once('../inc/navbar_inicio_experiencia.inc.php'); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="article-info bg-white p-3 mt-3">
                    <div class="row py-4" style="box-shadow: 0px 3px 10px 2px #0000001c;">
                        <div class="imagenes col-md-12 col-lg-4 mb-2">
                            <!-- <?php
                            if(count($imgs_producto)>0){
                                $img = 0;
                                echo '<img src="'.$imgs_producto[$img].'" class="w-100">';
                                echo '<div class="row mt-2">';
                                while($img<count($imgs_producto)){
                                    if($img<count($imgs_producto)){
                                        echo '<div class="col-md-4">
                                                <img src="'.$imgs_producto[$img].'" class="w-100">
                                            </div>';
                                    }
                                $img++;
                                }
                                echo '</div>';
                            }
                            ?> -->
                            <img src="https://i1.wp.com/spintiresvenezuela.com/wp-content/uploads/2017/05/fondo-gris-claro.jpg" class="w-100">
                            <div class="row mt-2">
                                <div class="col-md-4">
                                    <img src="https://i1.wp.com/spintiresvenezuela.com/wp-content/uploads/2017/05/fondo-gris-claro.jpg" class="w-100">
                                </div>
                                <div class="col-md-4">
                                    <img src="https://i1.wp.com/spintiresvenezuela.com/wp-content/uploads/2017/05/fondo-gris-claro.jpg" class="w-100">
                                </div>
                                <div class="col-md-4">
                                    <img src="https://i1.wp.com/spintiresvenezuela.com/wp-content/uploads/2017/05/fondo-gris-claro.jpg" class="w-100">
                                </div>
                            </div>
                        </div>
                        <div class="info col-md-6 col-lg-5">
                            <p class="pb-0 mb-0 text-color-3">
                                <?php echo $nombre_categoria; ?>
                            </p>
                            <h3>
                                <?php echo $nombre; ?>
                            </h3>
                            <p class="mb-2">
                                <?php echo $descripcion; ?>
                            </p>
                            <p class="mb-1 text-color-3">
                                <?php echo ($stock>0) ? 'En stock':'Sin stock'; ?>
                            </p>
                            <p class="mb-1 text-color-1">
                                <?php echo 'Añadir a Favoritos' ?>
                            </p>
                            <p>
                                <?php
                                for($i=1;$i<=5;$i++){
                                    echo ($i<=($total_valoracion_producto/2)) ? '<img class="img-start-puntuacion-16" src="'.$ruta_archivos.'img/star-color.png">':'<img class="img-start-puntuacion-16" src="'.$ruta_archivos.'img/star-color.png">';
                                }
                                ?>
                            </p>
                            <p class="o-50">
                                <?php echo $count_valoracion_producto; ?> Valoraciones</p>
                            <div id="compartir" class="d-flex pt-2">
                                <p class="o-50 pt-1 mr-3">Compartir</p>
                                <img src="https://png.icons8.com/color/50/f39c12/gmail.png" height="30px" class="mr-2">
                                <img src="https://png.icons8.com/color/50/f39c12/facebook.png" height="30px" class="mr-2">
                                <img src="https://png.icons8.com/color/50/f39c12/twitter.png" height="30px" class="mr-2">
                            </div>
                        </div>
                        <?php if($stock>0){ ?>
                        <div class="compra col-md-6 col-lg-3 text-center" style="border-left: 1px solid #bbbbbb;">
                            <h1 class="display-4 mt-3">
                                <?php echo $precio.' €'; ?>
                            </h1>
                            <!-- <p>información adicional</p> -->
                            <form action="articulo.php" method="post">
                                <button class="btn btn-lg btn-color-5 mb-2 w-100">Comprar Ahora</button>
                                <button class="btn btn-lg btn-cesta mb-2 w-100">Añadir a la Cesta</button>
                                <div class="caja d-flex">
                                    <label class="mr-3">Cantidad</label>
                                    <?php echo $iM->get_select("cantidad_productos", $stock, $cantidad_productos,''); ?>
                                </div>
                            </form>
                        </div>
                        <?php }else{ ?>
                        <div class="compra col-md-6 col-lg-3 text-center" style="border-left: 1px solid #bbbbbb;">
                            <img src="https://png.icons8.com/ios/50/e74c3c/out-of-stock-filled.png">
                            <p style="color:#e74c3c; font-weight:bold;" class="m-0">LO LAMENTAMOS</p>
                            <p style="color:#e74c3c; font-weight:bold;" class="m-1">PRODUCTO SIN STOCK</p>
                            <p style="font-size:12px;" class="m-1">¿Quiere que le avisemos cuando volvamos a tener stock?</p>
                            <button class="btn btn-lg btn-color-5 mb-2 w-100" style="background-color:var(--ysana-color-2);" data-toggle="modal" data-target=".bd-example-modal-sm">email</button>
                            <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        Formulario para introducir el correo :)
                                    </div>
                                </div>
                            </div>
                            <form action="producto.php" method="post">
                                <button class="btn btn-lg btn-color-5 mb-2 w-100">avisar</button>
                            </form>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-white mt-5">
        <div class="container">
            <div class="row pb-5">
                <div class="col-md-12">
                    <nav id="nav-info">
                        <div class="nav">
                            <a class="nav-item nav-link active" id="nav-usos-tab" data-toggle="tab" href="#nav-usos" role="tab" aria-controls="nav-usos"
                                aria-selected="true">Usos</a>
                            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile"
                                aria-selected="false">Información Adicional</a>
                            <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact"
                                aria-selected="false">Valoraciones</a>
                        </div>
                    </nav>
                    <div class="tab-content mt-4" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-usos" role="tabpanel" aria-labelledby="nav-usos-tab">
                            <?php foreach($usos_prod as $valor){
                                echo '<div class="uso ml-2">';
                                echo '<'.$valor['etiqueta'].'>'.$valor['contenido'].'</'.$valor['etiqueta'].'>';
                                echo '</div>';
                            }?>
                        </div>
                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <div class="row">
                                <div class="col-md-6 h-100 d-flex flex-column align-items-center">
                                    <h5 class="text-center mt-2">Información Producto</h5>
                                    <div class="mt-3 w-100">
                                        <?php foreach($info_producto as $valor){
                                        echo '<div class="uso ml-2">';
                                        echo '<'.$valor['etiqueta'].'>'.$valor['contenido'].'</'.$valor['etiqueta'].'>';
                                        echo '</div>';
                                    }?>
                                    </div>
                                </div>
                                <div class="col-md-6 pb-3">
                                    <!-- bg-grayopacity-ysana -->
                                    <div class="no-blur-consejo">
                                        <div class="nb-pers">
                                            <h1>Para poder ver este contenido debes de loguearte en ClubYsana</h1>
                                        </div>
                                    </div>
                                    <div class="blur-consejos no_seleccion">
                                        <div>
                                            <h5 class="text-center mt-2">Consejo Farmacéutico</h5>
                                            <div class="mt-3">
                                                <?php foreach($consejo_producto as $valor){
                                                echo '<div class="info mb-4 bg-white mx-2 p-3">
                                                <h6>'.$valor['titulo'].'</h6>
                                                <p>'.$valor['des'].'</p>
                                                </div>';
                                                }?>
                                            </div>
                                        </div>
                                        <div>
                                            <h5 class="text-center mt-2">Preguntas</h5>
                                            <div class="mt-3">
                                                <?php foreach(array_slice($preguntas_producto, 0, 2) as $valor){
                                                echo '<div class="info mb-4 bg-white mx-2 p-3">
                                                <h6>'.$valor['titulo'].'</h6>
                                                <p class="mb-0">'.$valor['des'].'</p>';
                                                for($i=1;$i<=5;$i++){
                                                    echo ($i<=($valor['puntuacion']/2)) ? '<img class="img-start-puntuacion-16" src="'.$ruta_archivos.'img/star-color.png">':'<img class="img-start-puntuacion-16" src="'.$ruta_archivos.'img/star.png">';
                                                }
                                                echo '<p class="o-50 mb-0 mt-1">'.$valor['fecha_valoracion'].' | Opinión de '.$valor['nombre_usuario'].' '.$valor['apellidos_usuario'].'</p>
                                                </div>';
                                            }?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                            <div class="row">
                                <div class="col-12">
                                    <div class="mt-3">
                                    <div class="no-blur-consejo">
                                        <div class="nb-pers">
                                            <h1>Para poder ver este contenido debes de loguearte en ClubYsana</h1>
                                        </div>
                                    </div>
                                        <h5 class="o-50">
                                            <?php echo $count_valoracion_producto; ?> Valoraciones</h5>
                                        <?php foreach($valoracion_producto as $valor){
                                        echo '<div class="valoracion blur-x5  mb-4 p-3 row">
                                        <div class="col-md-2 m-0 px-0 d-flex align-items-center flex-column">
                                            <div class="estrellas">';
                                        for($i=1;$i<=5;$i++){
                                            echo ($i<=($valor['puntuacion']/2)) ? '<img class="img-start-puntuacion-20" src="'.$ruta_archivos.'img/star-color.png">':'<img class="img-start-puntuacion-20" src="'.$ruta_archivos.'img/star.png">';
                                        }
                                        echo '</div>
                                        <p class="o-50">'.$valor['fecha_valoracion'].'</p></div>';
                                        echo '<div class="col-md-10">
                                        <h5 class="mb-0">'.$valor['titulo'].'</h5>
                                        <p class="o-50"><strong>Publicado por:</strong> '.$valor['nombre_usuario'].' '.$valor['apellidos_usuario'].'</p>
                                        <p>'.$valor['des'].'</p>
                                    </div></div>';
                                    }?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include_once('../inc/footer.inc.php'); ?>
</body>

</html>