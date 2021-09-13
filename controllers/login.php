<?php
class login extends Controller {
    function index()
    {
        if (isset($_SESSION['istrue_upassurance']) && $_SESSION['istrue_upassurance'] == 'true') {
            $page = WEB_ROOT . 'home/';
            $this->rederction($page);            //header ( 'Location: ' . $page );
        } else {
            if (isset($_POST['login_btn'])) {
                $this->loadModel("model_login");
                $r = $this->model_login->se_connecter();
                if ($r == false) {
                    $www = WEB_ROOT;
                    $this->rederction($www);
                } else {
                    if ($r[0]['COUNT(*)'] == 1) {
                        unset($r[0]['COUNT(*)']);
                        unset($r[0]['MOTS_PASS_UTIL']);
                        $_SESSION['istrue_upassurance'] = true;
                        $_SESSION['user_upassurance'] = $r;
                        $www = WEB_ROOT . "home";
                        $this->rederction($www);
                    } else if ($r[0]['COUNT(*)'] == 0) {
                        $data['erreur_login'] = "L'identifiant ou le mot de passe est incorrect";
                        $this->set($data);
                        $this->render('login');
                    }
                }
            } else {
                $this->render('login');
            }
        }
    }

    function log_out()
    {
        if (isset($_SESSION['istrue_upassurance']) && $_SESSION['istrue_upassurance'] == 'true') {
            unset($_SESSION['istrue_upassurance']);
            unset($_SESSION['user_upassurance']);
            $www = WEB_ROOT+"/login";
            $this->rederction($www);
        }
    }
}?>