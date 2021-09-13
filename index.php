<?php
session_start ();
//ob_start();
define ( 'WEB_ROOT', str_replace ( 'index.php', '', $_SERVER ['SCRIPT_NAME'] ) );
define ( 'ROOT', str_replace ( 'index.php', '', $_SERVER ['SCRIPT_FILENAME'] ) );
define ( 'LIENT_P', str_replace ( 'index.php', '', "http://bincouf.ma" ) );
define ( 'LIENT_S', str_replace ( 'index.php', '', "http://bincouf.ma/systeme/oufkir/" ) );

define ( 'API_KEY', str_replace ( 'index.php', '', "CgDGD0rQtj2Xe5cxrQeIRDF802UxQcFC5fkeb4be6Dw" ) );

require ROOT . 'core/Controller.php';
require ROOT . 'core/Models.php';
//require ROOT . 'src/langues/fr.php';
$p = preg_split ( '#[\/]#', $_GET ['p'] );
if (! empty ( $p [0] )) {
    $controlleur = $p [0];
    if (isset ( $p [1] ) && ! empty ( $p [1] ))
        $action = $p [1];
    else
        $action = 'index';

    if($controlleur == "login" || $controlleur == "consulting"){
        require ROOT . 'controllers/' . $controlleur . '.php';
    }else{
        if((isset ( $_SESSION['istrue_upassurance'] )) && (! empty ( $_SESSION['istrue_upassurance']))){
            if(isset($_SESSION['istrue_upassurance']) && $_SESSION['istrue_upassurance'] == true){
                require ROOT . 'controllers/' . $controlleur . '.php';
            }
        }else{
            $page = WEB_ROOT . 'login/';
            rederction($page);
        }

    }

    $control = new $controlleur ();
    if (method_exists ( $control, $action )) {
        unset ( $p [0] );
        unset ( $p [1] );
        call_user_func_array ( array (
            $control,
            $action
        ), $p );
    } else {
        $err = WEB_ROOT . 'erreur/pagenotfound/';
        header ( 'Location: ' . $err );
    }
} else {
    $page = WEB_ROOT . 'login/';
    rederction($page);
    //header ( 'Location: ' . $pag );
}
function rederction($www){
    echo '<script language="Javascript">
              <!--
                 document.location.replace("'.$www.'");
              // -->
              </script>';
}
?>
