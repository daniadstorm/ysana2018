<?php
include_once('../config/config.inc.php'); //cargando archivo de configuracion

$uM = load_model('usuario'); //uM userModel
$hM = load_model('html');
$iM = load_model('inputs');

/* $nombre_usuario = '';
$apellidos_usuario = '';
$email_usuario = '';
$email_conf_usuario = '';
$password_usuario = '';


if(isset($_POST['frmregistro'])){
    $nombre_usuario = $uM->escstr($_POST['nombre_usuario']);
    $apellidos_usuario = $uM->escstr($_POST['apellidos_usuario']);
    $email_usuario = $uM->escstr($_POST['email_usuario']);
    $email_conf_usuario = $uM->escstr($_POST['email_conf_usuario']);
    $password_usuario = $uM->escstr($_POST['password_usuario']);

} */


//CONTROL_______________________________________________________________________
if (isset($_SESSION['id_tipo_usuario'])) { //si hay login
    switch ($_SESSION['id_tipo_usuario']) {
        default:
        case USER:
            header('Location: '.$ruta_inicio.'club_ysana/areapersonal/');
            exit();
        break;
        case ADMIN:
            header('Location: '.$ruta_inicio.'inicio-administrador.php');
            exit();
        break;
    }
}
//CONTROL_______________________________________________________________________

//POST__________________________________________________________________________
if(isset($_POST['id_usuario'])){
    if(!$uM->get_existe_correo($_POST['email_usuario'])){
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
        }
    }else{
        $str_errores = 'Este correo ya existe';
    }
}
//POST__________________________________________________________________________

include_once('../inc/cabecera.inc.php'); //cargando cabecera
?>
<script type="text/javascript">
</script>

<body class="">
    <?php include_once('../inc/panel_top.inc.php'); ?>
    <?php include_once('../inc/navbar_inicio.inc.php'); ?>
    <div class="club-ysana-home">
        <div class="cy-container">
            <div class="logo">
                <img src="../../img/ysanaclub.png" alt="Logo Ysana">
            </div>
            <?php
            if(isset($str_errores) && $str_errores){
                echo $hM->get_alert($str_errores,"alert-danger");
            } ?>
            <form id="frmRegistrocy" method="post" onSubmit="enviarDatos(); return false">
                <h2>Darme de alta</h2>
                <input name="authtoken" value="<?php echo AUTHTOKEN; ?>" hidden>
                <input name="scope" value="<?php echo SCOPE; ?>" hidden>
                <input type="text" class="inputFrm" name="id_usuario" value="0" hidden>
                <input type="text" class="inputFrm" name="nombre_usuario" minlength="4" placeholder="Nombre" required>
                <input type="text" class="inputFrm" name="apellidos_usuario" minlength="6" placeholder="Apellidos" required>
                <input type="email" class="inputFrm" name="email_usuario" placeholder="Email" required>
                <select name="genero_usuario" id="genero_usuario_cy" required>
                    <option value="F">Femenino</option>
                    <option value="M">Masculino</option>
                </select>
                <input type="password" class="inputFrm" name="password_usuario" minlength="6" placeholder="Contraseña" required>
                <input type="password" class="inputFrm" name="password_usuario" minlength="6" placeholder="Confirmar contraseña" required>
                <input type="submit" class="inputFrm" value="UNIRME A CLUB YSANA">
                <div class="d-flex align-items-center justify-content-center mt-4 mb-5">
                        <input type="checkbox" value="" required>
                        <p id="btnAceptopolitica">Acepto la Política de privacidad</p>
                    </div>

<!--                 <input required type="text" class="inputFrm" name="nombre_usuario" placeholder="Nombre">
                <input required type="text" class="inputFrm" name="apellidos_usuario" placeholder="Apellidos">
                <input required type="text" class="inputFrm" name="email_usuario" placeholder="Correo electrónico">
                <input required type="text" class="inputFrm" name="email_usuario" placeholder="Confirmar correo electrónico">
                <input required type="password" minlength="8" class="inputFrm" name="contrasena_usuario" placeholder="Password">
                <input type="submit" class="inputFrm" value="UNIRSE A CLUB YSANA">
                    <div class="d-flex align-items-center justify-content-center mt-4 mb-5">
                        <input type="checkbox" value="" required>
                        <p id="btnAceptopolitica">Acepto la Política de privacidad</p>
                    </div> -->
            </form>
        </div>
    </div>
    <script>
    $(document).ready(function(){
        function show_coming_soon(){
            $("#coming-soon-derecha").addClass("aparecer-ysana");
            /* console.log("aparecer-ysana"); */
        };
        setTimeout(show_coming_soon, 3900 );
    });
    </script>
        <?php include_once('../inc/footer.inc.php'); ?>
</body>

</html>