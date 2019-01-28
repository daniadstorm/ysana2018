<?php
/* RUTAS */
//-------------------------------------------------------------------------------------

$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$base = "http://" . $host . $uri . "/";
/* $ruta_inicio = 'http://adstormcloud.ddns.net/ysana/';
$ruta_archivos = 'http://adstormcloud.ddns.net/ysana/'; */
$ruta_inicio = 'http://192.168.1.2/ysana/';
$ruta_archivos = 'http://192.168.1.2/ysana/';
/* $ruta_inicio = 'https://ysana.es/';
$ruta_archivos = 'https://ysana.es/'; */
$document_root = $_SERVER['DOCUMENT_ROOT'].'/ysana/';
//====================================================================================

/* CONSTANTES */
//-------------------------------------------------------------------------------------
define('DOCUMENT_ROOT', $document_root);
define('ADMIN', 1);
define('USER', 10);
define('IVA_GENERAL', 0.21);
define('REQ_FIELD', 'campo_requerido');
define('EMPTY_DATE', '1970-01-01');
define('AUTHTOKEN', 'df0c6f41ce865d6b8f8153d8aeb8a584');
define('SCOPE', 'creatorapi');
define('OWNERNAME', 'pharmalink');
define('FORMAT', 'json');
define('APPLICATIONNAME', 'ysanaapp');
define('SECRETKEY', '6Lchi34UAAAAALsKEHEpHoaZxKsYb0wRhIkqx3cm');
//------------------------------------------------------------------------------
define('DS_VERSION', 'HMAC_SHA256_V1');
define('DS_MERCHANT_TERMINAL', '1');
define('DS_AUTORIZACION', '0');
define('DS_DEVOLUCION_AUTOMATICA', '3');
define('DS_MERCHANT_NAME', 'ysana');

define('DS_EURO', '978');
define('DS_DOLAR', '840');
define('DS_LIBRA', '826');
define('DS_MERCHANT_URL', $ruta_inicio.'validation.php');
define('ADSTORMLOG_URL', $document_root.'adstormlog/adstormlog.txt');
//PRUEBAS-----------------------------------------------------------------------
define('URL_PASARELA', 'https://sis-t.redsys.es:25443/sis/realizarPago'); //PRUEBAS
define('DS_MERCHANT_CODE', '337097182'); //PRUEBAS
define('DS_MERCHANT_KEY', 'sq7HjrUOBfKmC576ILgskD5srU870gJ7'); //PRUEBAS
//PRUEBAS-----------------------------------------------------------------------
//REAL--------------------------------------------------------------------------
//define('URL_PASARELA', 'https://sis.redsys.es/sis/realizarPago'); //REAL
//define('DS_MERCHANT_CODE', '126562669'); //REAL
//define('DS_MERCHANT_KEY', 'DXOYIKNONR0D3++20jG5E2Lf+jQ9qobw'); //REAL
//REAL--------------------------------------------------------------------------
//--
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

switch ($lang) {
    default:
    case 'spa': $_SESSION['id_lang']=1;     break; //por defecto spa
    case 'eng': $_SESSION['id_lang']=2;         break; 
    case 'cat': $_SESSION['id_lang']=3;         break;
    case 'fra': $_SESSION['id_lang']=4;         break;
}
//====================================================================================
?>
