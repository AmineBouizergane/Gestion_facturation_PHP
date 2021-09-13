<?php

class Controller
{
    var
        $params = array();
    var
        $layout = 'login';

    public
    function set($array)
    {
        $this->params = array_merge($this->params, $array);
    }

    public
    function render($filename)
    {
        extract($this->params);
        ob_start();
        require ROOT . 'views/' . get_class($this) . '/' . $filename . '.php';
        $content_for_layout = ob_get_clean();
        if ($this->layout == false) {
            echo $content_for_layout;
        } else {
            if ($filename == "login" || $filename == "lockscreen") {
                $this->is_connect();
                require ROOT . 'views/layout/' . $this->layout . '.php';
            } else {
                if ((isset ($_SESSION ['user_upassurance'])) && (!empty ($_SESSION ['user_upassurance']))) {
                    $this->loadModel('model_login');                    /*$etat = $this->model_login->s_utili($_SESSION['user'][0]['Id_Emp']);			        $etat = $etat[0]['etat'];			        if($etat == 1){*/
                    $this->is_connect();
                    require ROOT . 'views/layout/' . $this->layout . '.php';                    /*}elseif($etat == 0){			        	if($filename != "lockscreen"){			        		$page = WEB_ROOT . 'login/luckscreen';		                    $this->rederction($page);			        	}			        }*/
                } else {
                    $page = WEB_ROOT . 'login/';
                    $this->rederction($page);
                }
            }
        }
    }

    private
    function is_connect()
    {
        if ((isset ($_SESSION ['user_upassurance'])) && (!empty ($_SESSION ['user_upassurance']))) {
            $this->loadModel('model_login');            /*$etat = $this->model_login->s_utili($_SESSION['user_upassurance'][0]['Id_Emp']);			$etat = $etat[0]['etat'];			if($etat == 1){*/
            $this->layout = 'default';            /*}else{				$this->layout = 'login';			}*/
        } else {
            $this->layout = 'login';
        }
    }

    public
    function loadModel($name)
    {
        require_once ROOT . 'models/' . strtolower($name) . '.php';
        $this->$name = new $name ();
    }

    function rederction($www)
    {
        echo '<script language="Javascript">                      document.location.replace("' . $www . '");                   </script>';
    }

    public
    function changechifre($chifr)
    {
        $langeurchifr = strlen($chifr);
        $mil = $chifr / 1000;
        $mil = intval($mil);
        $rep = "";
        $lesunit = array("", "un", "deux", "trois", "quatre", "cinq", "six", "sept", "huit", "neuf", "dix", "onze", "douze", "treize", "quatorze", "quinze", "seize", "dix-sept", "dix-huit", "dix-neuf");
        $lesven = array("", "", "vingt", "trente", "quarante", "cinquante", "soixante", "soixante", "quatre-vingt", "quatre-vingt");
        $lengeur = strlen($mil);        //return $lengeur ;
        if ($lengeur == 1 || $lengeur == 2 && $mil <= 19 && $mil >= 0 && $langeurchifr >= 4) {
            if ($mil == 1) {
                $rep = $rep . " mille";
            }
            if ($mil != 1 && $mil >= 0) {
                $rep = $rep . $lesunit [$mil] . " mille";
            } else if ($mil != 1 && $mil > 0 && $langeurchifr >= 4) {
                $rep = $rep . " mille";
            }
        } elseif ($lengeur == 2 && $mil > 19) {
            $j = $mil / 10;
            $j = intval($j);
            $i = $j * 10;
            $i = $mil - $i;
            if ($i != 0) {
                $rep = $rep . $lesven [$j] . "-" . $lesunit [$i] . " mille";
            } elseif ($i == 0) {
                $rep = $rep . $lesven [$j];
            }
        } elseif ($lengeur == 3 && $mil >= 100) {
            $j = $mil / 100;
            $j = intval($j);
            $i = $j * 100;
            $i = $mil - $i;
            $m = $i / 10;
            $m = intval($m);
            $k = $m * 10;
            $k = $i - $k;
            if ($j != 1) {
                if ($m != 7 && $m != 9) {
                    if ($k != 0) {
                        $rep = $rep . $lesunit [$j] . " cent " . $lesven [$m] . "-" . $lesunit [$k] . " mille";
                    } elseif ($k == 0) {
                        $rep = $rep . $lesunit [$j] . " cent " . $lesven [$m] . " mille";
                    }
                } else {
                    $k = $k + 10;
                    if ($k != 0) $rep = $rep . $lesunit [$j] . " cent " . $lesven [$m] . "-" . $lesunit [$k] . " mille"; elseif ($k == 0) $rep = $rep . $lesunit [$j] . " cent " . $lesven [$m] . " mille";
                }
            } elseif ($j == 1) if ($k != 0) $rep = $rep . "cent " . $lesven [$m] . "-" . $lesunit [$k] . " mille"; elseif ($k == 0) $rep = $rep . "cent " . $lesven [$m] . " mille";
        }
        $mil = $mil * 1000;
        $cent = $chifr - $mil;
        $cent = $cent / 100;
        $cent = intval($cent);
        $lengeur = strlen($cent);
        if ($lengeur == 1 && $cent != 0) {
            $rep = $rep . " " . $lesunit [$cent] . " cent";
        } else {
            $rep = $rep;
        }
        $cent = $cent * 100;
        $centc = $cent + $mil;
        $dix = $chifr - $centc;
        $dix = $dix / 10;
        $dix = intval($dix);
        $dixc = $dix * 10;
        $clc = $cent + $mil + $dixc;
        $un = $chifr - $clc;
        if ($dix == 1) {
            $i = 10 + $un;
            $rep = $rep . " " . $lesunit [$i];
        } elseif ($dix >= 2 && $dix != 7 && $dix != 9) {
            if ($un == 0) {
                $rep = $rep . " " . $lesven [$dix];
            } else {
                $rep = $rep . " " . $lesven [$dix] . "-" . $lesunit [$un];
            }
        } elseif ($dix == 7 || $dix == 9) {
            $i = 10 + $un;
            $rep = $rep . " " . $lesven [$dix] . "-" . $lesunit [$i];
        }
        $rep = $rep . " " . $lesven[$dix] . " " . $lesunit[$un];
        $rep = $rep . " DHS";
        $rep = strtoupper($rep);
        return $rep;
    }

    function chifre_en_lettre($montant, $devise1 = '', $devise2 = '')
    {
        if (empty($devise1)) $dev1 = 'DHS'; else $dev1 = $devise1;
        if (empty($devise2)) $dev2 = 'CTS'; else $dev2 = $devise2;
        $valeur_entiere = intval($montant);
        $valeur_decimal = intval(round($montant - intval($montant), 2) * 100);
        $dix_c = intval($valeur_decimal % 100 / 10);
        $cent_c = intval($valeur_decimal % 1000 / 100);
        $unite[1] = $valeur_entiere % 10;
        $dix[1] = intval($valeur_entiere % 100 / 10);
        $cent[1] = intval($valeur_entiere % 1000 / 100);
        $unite[2] = intval($valeur_entiere % 10000 / 1000);
        $dix[2] = intval($valeur_entiere % 100000 / 10000);
        $cent[2] = intval($valeur_entiere % 1000000 / 100000);
        $unite[3] = intval($valeur_entiere % 10000000 / 1000000);
        $dix[3] = intval($valeur_entiere % 100000000 / 10000000);
        $cent[3] = intval($valeur_entiere % 1000000000 / 100000000);
        $chif = array('', 'un', 'deux', 'trois', 'quatre', 'cinq', 'six', 'sept', 'huit', 'neuf', 'dix', 'onze', 'douze', 'treize', 'quatorze', 'quinze', 'seize', 'dix sept', 'dix huit', 'dix neuf');
        $secon_c = '';
        $trio_c = '';
        for ($i = 1; $i <= 3; $i++) {
            $prim[$i] = '';
            $secon[$i] = '';
            $trio[$i] = '';
            if ($dix[$i] == 0) {
                $secon[$i] = '';
                $prim[$i] = $chif[$unite[$i]];
            } else if ($dix[$i] == 1) {
                $secon[$i] = '';
                $prim[$i] = $chif[($unite[$i] + 10)];
            } else if ($dix[$i] == 2) {
                if ($unite[$i] == 1) {
                    $secon[$i] = 'vingt et';
                    $prim[$i] = $chif[$unite[$i]];
                } else {
                    $secon[$i] = 'vingt';
                    $prim[$i] = $chif[$unite[$i]];
                }
            } else if ($dix[$i] == 3) {
                if ($unite[$i] == 1) {
                    $secon[$i] = 'trente et';
                    $prim[$i] = $chif[$unite[$i]];
                } else {
                    $secon[$i] = 'trente';
                    $prim[$i] = $chif[$unite[$i]];
                }
            } else if ($dix[$i] == 4) {
                if ($unite[$i] == 1) {
                    $secon[$i] = 'quarante et';
                    $prim[$i] = $chif[$unite[$i]];
                } else {
                    $secon[$i] = 'quarante';
                    $prim[$i] = $chif[$unite[$i]];
                }
            } else if ($dix[$i] == 5) {
                if ($unite[$i] == 1) {
                    $secon[$i] = 'cinquante et';
                    $prim[$i] = $chif[$unite[$i]];
                } else {
                    $secon[$i] = 'cinquante';
                    $prim[$i] = $chif[$unite[$i]];
                }
            } else if ($dix[$i] == 6) {
                if ($unite[$i] == 1) {
                    $secon[$i] = 'soixante et';
                    $prim[$i] = $chif[$unite[$i]];
                } else {
                    $secon[$i] = 'soixante';
                    $prim[$i] = $chif[$unite[$i]];
                }
            } else if ($dix[$i] == 7) {
                if ($unite[$i] == 1) {
                    $secon[$i] = 'soixante et';
                    $prim[$i] = $chif[$unite[$i] + 10];
                } else {
                    $secon[$i] = 'soixante';
                    $prim[$i] = $chif[$unite[$i] + 10];
                }
            } else if ($dix[$i] == 8) {
                if ($unite[$i] == 1) {
                    $secon[$i] = 'quatre-vingts et';
                    $prim[$i] = $chif[$unite[$i]];
                } else {
                    $secon[$i] = 'quatre-vingt';
                    $prim[$i] = $chif[$unite[$i]];
                }
            } else if ($dix[$i] == 9) {
                if ($unite[$i] == 1) {
                    $secon[$i] = 'quatre-vingts et';
                    $prim[$i] = $chif[$unite[$i] + 10];
                } else {
                    $secon[$i] = 'quatre-vingts';
                    $prim[$i] = $chif[$unite[$i] + 10];
                }
            }
            if ($cent[$i] == 1) $trio[$i] = 'cent'; else if ($cent[$i] != 0 || $cent[$i] != '') $trio[$i] = $chif[$cent[$i]] . ' cents';
        }
        $chif2 = array('', 'dix', 'vingt', 'trente', 'quarante', 'cinquante', 'soixante', 'soixante-dix', 'quatre-vingts', 'quatre-vingts dix');
        $secon_c = $chif2[$dix_c];
        $res = "";
        if ($cent_c == 1) $trio_c = 'cent'; else if ($cent_c != 0 || $cent_c != '') $trio_c = $chif[$cent_c] . ' cents';
        if (($cent[3] == 0 || $cent[3] == '') && ($dix[3] == 0 || $dix[3] == '') && ($unite[3] == 1)) $res .= $trio[3] . '  ' . $secon[3] . ' ' . $prim[3] . ' million '; else if (($cent[3] != 0 && $cent[3] != '') || ($dix[3] != 0 && $dix[3] != '') || ($unite[3] != 0 && $unite[3] != '')) $res .= $trio[3] . ' ' . $secon[3] . ' ' . $prim[3] . ' millions '; else        $res .= $trio[3] . ' ' . $secon[3] . ' ' . $prim[3];
        if (($cent[2] == 0 || $cent[2] == '') && ($dix[2] == 0 || $dix[2] == '') && ($unite[2] == 1)) $res .= ' mille '; else if (($cent[2] != 0 && $cent[2] != '') || ($dix[2] != 0 && $dix[2] != '') || ($unite[2] != 0 && $unite[2] != '')) $res .= $trio[2] . ' ' . $secon[2] . ' ' . $prim[2] . ' milles '; else        $res .= $trio[2] . ' ' . $secon[2] . ' ' . $prim[2];
        $res .= $trio[1] . ' ' . $secon[1] . ' ' . $prim[1];
        $res .= ' ' . $dev1 . ' ';
        if (($cent_c == '0' || $cent_c == '') && ($dix_c == '0' || $dix_c == '')) $res .= ' et zero ' . $dev2; else        $res .= $trio_c . ' ' . $secon_c . ' ' . $dev2;
        return $res;
    }
}

?>