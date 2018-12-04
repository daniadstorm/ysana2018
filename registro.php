<?php
include_once('config/config.inc.php'); //cargando archivo de configuracion

$uM = load_model('usuario'); //uM userModel
$fM = load_model('form');
$sM = load_model('seo');
$hM = load_model('html');

$nombre_usuario = '';
$contrasenya_usuario = '';
$captcha = false;
$arr_err = array();

//GET___________________________________________________________________________

//GET___________________________________________________________________________

//POST__________________________________________________________________________

if(isset($_POST['id_usuario']) && isset($_POST['g-recaptcha-response'])){
    if(!$uM->get_existe_correo($_POST['email_usuario']) && $uM->verificarCaptcha(SECRETKEY,$_POST['g-recaptcha-response'])){
        if($uM->add_usuario($_POST['nombre_usuario'],$_POST['apellidos_usuario'], $_POST['email_usuario'], $_POST['genero_usuario'], $_POST['password_usuario'])){
            $uM->add_post_zoho('https://creator.zoho.eu/api/pharmalink/json/ysanaapp/form/usuarios/record/add/', array(
                'authtoken' => AUTHTOKEN,
                'scope' => SCOPE,
                'nombre_usuario' => $_POST['nombre_usuario'],
                'apellidos_usuario' => $_POST['apellidos_usuario'],
                'email_usuario' => $_POST['email_usuario'],
                'genero_usuario' => $_POST['genero_usuario'],
                'tipo_usuario' => 0,
                'password_usuario' => $_POST['password_usuario']
            ));
            header('Location: '.$ruta_inicio.'login.php');
        }else{
            $str_errores = 'No se ha podido dar de alta el usuario';
        }
    }else{
        $str_errores = 'Este correo ya existe';
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
                <img src="<?php echo $ruta_inicio;?>img/svg/ysanacolor.svg" class="img-responsive" alt="">
            </div>
            <?php
            if(isset($str_errores) && $str_errores){
                echo $hM->get_alert($str_errores,"alert-danger");
            } ?>
            <form method="post" class="inputs">
                <input name="authtoken" value="<?php echo AUTHTOKEN; ?>" hidden>
                <input name="scope" value="<?php echo SCOPE; ?>" hidden>
                <input type="text" name="id_usuario" value="0" hidden>
                <input type="text" name="nombre_usuario" minlength="4" placeholder="Nombre" required>
                <input type="text" name="apellidos_usuario" minlength="6" placeholder="Apellidos" required>
                <input type="email" name="email_usuario" placeholder="Email" required>
                <select name="genero_usuario" id="genero_usuario" required>
                    <option value="F">Femenino</option>
                    <option value="M">Masculino</option>
                </select>
                <input type="password" name="password_usuario" minlength="6" placeholder="Contraseña" required>
                <input type="password" name="password_usuario" minlength="6" placeholder="Confirmar contraseña" required>
                <div class="g-recaptcha" data-sitekey="6Lchi34UAAAAANUKKZmltkZCIcYozGdCT7YRgZq4"></div>
                <input id="button_enviar" disabled type="submit" name="button_enviar" value="Crear cuenta">
            </form>
            <script>
            $(document).ready(function(){
                $('input').keyup(function(event){
                    var password_usuario = document.getElementsByName('password_usuario')[0].value;
                    var password_usuario1 = document.getElementsByName('password_usuario')[1].value;
                    if(password_usuario==password_usuario1 && password_usuario!=''){
                        $('#button_enviar').prop("disabled", false);
                    }else{
                        $('#button_enviar').prop("disabled", true);
                    }
                });
            });
            </script>
        </div>
    </div>
    <?php include_once('inc/footer.inc.php'); ?>
</body>
</html>