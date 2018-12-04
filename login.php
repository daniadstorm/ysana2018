<?php
include_once('config/config.inc.php'); //cargando archivo de configuracion

$uM = load_model('usuario'); //uM userModel
$fM = load_model('form');
$sM = load_model('seo');
$hM = load_model('html');

$nombre_usuario = '';
$contrasenya_usuario = '';

$arr_err = array();
$cy=false;

//GET___________________________________________________________________________
if (isset($_GET['unlogin'])) {
    $uM->unlogin_usuario();
}
if (isset($_GET['cy'])){
    $cy=true;
}
//GET___________________________________________________________________________

//POST__________________________________________________________________________
if (isset($_POST['nombre_usuario'])) { //si viene de submit de login
    
    $nombre_usuario = $_POST['nombre_usuario'];
    $contrasenya_usuario = $_POST['contrasenya_usuario'];
    
    $result_login = $uM->login_usuario($nombre_usuario, $contrasenya_usuario);
    if (strlen($result_login) > 1) {
        $str_errores = $result_login;
    }
}
//POST__________________________________________________________________________

//CONTROL_______________________________________________________________________
if (isset($_SESSION['id_tipo_usuario'])) { //si hay login
    switch ($_SESSION['id_tipo_usuario']) {
        default:
        case USER:
            header('Location: '.$ruta_inicio.'index.php');
            exit();
        break;
        case ADMIN:
            header('Location: '.$ruta_inicio.'inicio-administrador.php');
            exit();
        break;
    }
}
//CONTROL_______________________________________________________________________

include_once('inc/cabecera.inc.php'); //cargando cabecera
echo $sM->add_cabecera("Iniciar sesión - Ysana"); 
?>
<script type="text/javascript"></script>
<body>
    <?php include_once('inc/panel_top.inc.php'); ?>
    <?php include_once('inc/navbar_inicio.inc.php'); ?>
    <div class="ysana-login">
        <div class="ysana-login-sub">
            <div class="logo mt-5 mb-5">
                <img src="<?php echo $ruta_inicio;?>img/svg/<?php echo ($cy) ? 'clubysana' : 'ysanacolor' ?>.svg" class="img-responsive" alt="">
            </div>
            <?php
            if(isset($str_errores) && $str_errores){
                echo $hM->get_alert($str_errores,"alert-danger");
            } ?>
            <form method="post" class="inputs">
                <input class="<?php echo ($cy) ? 'cycolor' : ''; ?>" type="text" name="nombre_usuario" placeholder="Usuario">
                <input class="<?php echo ($cy) ? 'cycolor' : ''; ?>" type="password" name="contrasenya_usuario" placeholder="Contraseña">
                <input class="<?php echo ($cy) ? 'cycolor' : ''; ?>" type="submit" value="Iniciar Sesión">
                <a href="<?php echo $ruta_inicio; ?>forgot-password"><input class="<?php echo ($cy) ? 'cycolor' : ''; ?>" type="button" value="¿Has olvidado tu contraseña?"></a>
            </form>
        </div>
    </div>
    <?php include_once('inc/footer.inc.php'); ?>
</body>
</html>