<?php
class model_login  extends Models{
    private
    $username;
    private
    $password;
    function __construct()
    {
    }

    function se_connecter()
    {
        if (isset($_POST['username']) && !empty($_POST['username'])) {
            $u = htmlentities($_POST['username']);
        } else {
            return false;
        }
        if (isset($_POST['password']) && !empty($_POST['password'])) {
            $p = htmlentities($_POST['password']);
            $p = md5($p);
        } else {
            return false;
        }
        $this->table = "utilisateur_bloom";
        $arrydata = array('condition' => 'NOM_UTIL=:u AND MOTS_PASS_UTIL =:p', 'fields' => '*,COUNT(*)', 'params' => array(':u' => $u, ':p' => $p));
        $r = $this->find($arrydata);
        return $r;
    }
}?>