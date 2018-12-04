<?php
include_once('../config/config.inc.php'); //cargando archivo de configuracion

$uM = load_model('usuario'); //uM userModel
$hM = load_model('html');
$iM = load_model('inputs');

$id_usuario = (isset($_SESSION['id_usuario'])) ? $_SESSION['id_usuario'] : '';


//GET___________________________________________________________________________

//GET___________________________________________________________________________

//POST__________________________________________________________________________

//POST__________________________________________________________________________

//CONTROL__________________________________________________________________________

//CONTROL__________________________________________________________________________

include_once('../inc/cabecera.inc.php'); //cargando cabecera
?>
<script type="text/javascript">

</script>

<body>
    <?php include_once('../inc/panel_top_clubysana.inc.php'); ?>
    <?php include_once('../inc/navbar_inicio.inc.php'); ?>
    <div class="container-fluid px-0">
        <ul id="nav-clubysana" class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link" id="areapersonal-tab" href="<?php echo $ruta_inicio; ?>club_ysana/areapersonal">Tu Area Personal</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="experiencia-tab" href="<?php echo $ruta_inicio; ?>club_ysana/areapersonal">Tu Experiencia</a>
            </li>
        </ul>
    </div>
    <div class="container-fluid">
        <div class="neurologia">
            <div class="cont">
                <a href="<?php echo $ruta_inicio; ?>club_ysana/areapersonal/neurologia/sueno">
                    <img src="<?php echo $ruta_inicio; ?>img/club-ysana-picto-articulo-suenoMesa.png" alt="">
                    <p>Sueño</p>
                </a>
            </div>
            <div class="cont">
                <a href="#">
                    <img src="https://www.tenvinilo.com/vinilos-decorativos/img/preview/pegatinas-personalizadas-redonda-promo-1336.png" alt="">
                    <p>Articulo 2</p>
                </a>
            </div>
            <div class="cont">
                <a href="#">
                    <img src="https://www.tenvinilo.com/vinilos-decorativos/img/preview/pegatinas-personalizadas-redonda-promo-1336.png" alt="">
                    <p>Articulo 3</p>
                </a>
            </div>
            <div class="cont">
                <a href="#">
                    <img src="https://www.tenvinilo.com/vinilos-decorativos/img/preview/pegatinas-personalizadas-redonda-promo-1336.png" alt="">
                    <p>Articulo 4</p>
                </a>
            </div>
            <div class="cont">
                <a href="#">
                    <img src="https://www.tenvinilo.com/vinilos-decorativos/img/preview/pegatinas-personalizadas-redonda-promo-1336.png" alt="">
                    <p>Articulo 5</p>
                </a>
            </div>
            <div class="cont">
                <a href="#">
                    <img src="https://www.tenvinilo.com/vinilos-decorativos/img/preview/pegatinas-personalizadas-redonda-promo-1336.png" alt="">
                    <p>Articulo 6</p>
                </a>
            </div>
            <div class="cont">
                <a href="#">
                    <img src="https://www.tenvinilo.com/vinilos-decorativos/img/preview/pegatinas-personalizadas-redonda-promo-1336.png" alt="">
                    <p>Articulo 7</p>
                </a>
            </div>
        </div>
    </div>
    <?php include_once('../inc/footer.inc.php'); ?>
</body>

</html>