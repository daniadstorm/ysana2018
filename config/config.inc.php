<?php
/* RUTAS */
//-------------------------------------------------------------------------------------

$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$base = "http://" . $host . $uri . "/";
/* $ruta_inicio = 'http://adstormcloud.ddns.net/ysana/';
$ruta_archivos = 'http://adstormcloud.ddns.net/ysana/'; */
//$ruta_inicio = 'http://192.168.1.2/ysana/';
//$ruta_archivos = 'http://192.168.1.2/ysana/';
$ruta_inicio = 'https://ysana.es/';
$ruta_archivos = 'https://ysana.es/';
$document_root = $_SERVER['DOCUMENT_ROOT'].'/';
//====================================================================================

/* CONSTANTES */
//-------------------------------------------------------------------------------------
define('DOCUMENT_ROOT', $document_root);
define('ADMIN', 1);
define('USER', 10);
define('REQ_FIELD', 'campo_requerido');
define('EMPTY_DATE', '1970-01-01');
define('AUTHTOKEN', 'df0c6f41ce865d6b8f8153d8aeb8a584');
define('SCOPE', 'creatorapi');
define('OWNERNAME', 'pharmalink');
define('FORMAT', 'json');
define('APPLICATIONNAME', 'ysanaapp');
define('SECRETKEY', '6Lchi34UAAAAALsKEHEpHoaZxKsYb0wRhIkqx3cm');
//-------------------------------------------------------------------------------------

/* LIBRERIA DE FUNCIONES */
//-------------------------------------------------------------------------------------
include_once(DOCUMENT_ROOT.'func/func.inc.php');
//====================================================================================

/* LIBRERIA DE BD */
//-------------------------------------------------------------------------------------
include_once(DOCUMENT_ROOT.'model/model.class.php');
$rootM = new Model(); //rootModel; supervariable raiz de modelo
//====================================================================================

/* INICIO DE SESION */
//-------------------------------------------------------------------------------------
if(!isset($_SESSION)) session_start();
//====================================================================================

/* CONFIGURANDO LENGUAJE */
//-------------------------------------------------------------------------------------
//castellano asignado por defecto doblemente
//lang = el nombre del lenguaje
//lng = array de textos
/* if (isset($_POST['idioma_seleccionado'])) $_SESSION['lang'] = $_POST['idioma_seleccionado']; */
if (isset($_REQUEST['idioma_seleccionado'])) $_SESSION['lang'] = $_REQUEST['idioma_seleccionado'];
$lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'spa';
$_SESSION['lang'] = $lang;
switch ($lang) {
    default:
    case 'spa':        include_once(DOCUMENT_ROOT.'lang/lang.spa.php');   break; //por defecto spa
    case 'eng':         include_once(DOCUMENT_ROOT.'lang/lang.eng.php');    break; 
    case 'cat':         include_once(DOCUMENT_ROOT.'lang/lang.cat.php');    break;
    case 'fra':         include_once(DOCUMENT_ROOT.'lang/lang.fra.php');    break;
}
/* echo '<pre>';
print_r($_REQUEST);
echo '</pre>'; */
//====================================================================================
?>

<?php
/* echo '<pre>';
print_r($_SESSION);
echo '</pre>'; */
?>