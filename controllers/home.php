<?php

date_default_timezone_set('UTC');

class home extends Controller {
 
    function index()
    {
        $this->layout = true;
        $this->render('home');
    }

    function add_invoice(){
        $this->layout = true;
        $this->render('add_invoice');
    }

    function add_bl(){
        $this->layout = true;
        $this->render('add_bl');
    }

    function add_bc(){
        $this->layout = true;
        $this->render('add_bc');
    }

    function save_facture()
    {
        $this->loadModel("model_home");

        $last_num_fac=$this->model_home->get_last_fac_num();
        $current_num_fac=$last_num_fac[0]['num_fac']+1;

        $data_facture['societe'] =htmlentities($_POST['societe']);           
        $data_facture['ice'] = htmlentities($_POST['ice']);
        $data_facture['date'] = strtotime(htmlentities($_POST['date']));
        $data_facture['numero'] =$current_num_fac."/".date("Y");
        $data_facture['total_ht'] =htmlentities($_POST['total_ht'][0]);
        $data_facture['tva'] =htmlentities($_POST['tva'][0]);
        $data_facture['total'] =htmlentities($_POST['total_ttc'][0]);
        $data_facture['total_en_lettre']=strtoupper($this->chifre_en_lettre(str_replace(",", "", $data_facture['total']),'',''))." TTC";
        // echo "<pre>";
        //var_dump($data_facture);
        $id_fac=$this->model_home->save_facture($data_facture);  
        foreach($_POST['product'] as $k => $v) {
            $data_det_facture['produits'] =htmlentities($_POST['product'][$k]);
            $data_det_facture['unite'] =htmlentities($_POST['unite'][$k]);
            $data_det_facture['qte'] =htmlentities($_POST['qte'][$k]);
            $data_det_facture['prix_unitaire'] =htmlentities($_POST['price_unit'][$k]);
            $data_det_facture['prix_total'] =htmlentities($_POST['price_total'][$k]);           
            $data_facture['det_facture'][$k]=$data_det_facture;
            $data_det_facture['id_fac'] =(int)$id_fac;
            $this->model_home->save_detail_facture($data_det_facture); 
        } 

        $data['num_fac']=(int)$current_num_fac;
        $this->model_home->update_fac_num($data);


        unset($_POST);

        $this->set($data_facture);

        $this->layout = false;
        $this->render('pdf_facture');
    }

    function save_bl()
    {
        $this->loadModel("model_home");

        $last_num_bl=$this->model_home->get_last_bl_num();
        $current_num_bl=$last_num_bl[0]['num_bl']+1;

        $data_bl['societe'] =htmlentities($_POST['societe']);
        $data_bl['date'] = strtotime(htmlentities($_POST['date']));           
        $data_bl['ref'] = htmlentities($_POST['ref']);
        $data_bl['destination'] = htmlentities($_POST['destination']);
        $data_bl['transporteur'] = htmlentities($_POST['transporteur']);
        $data_bl['camion'] = htmlentities($_POST['camion']);
        $data_bl['numero_bl'] =$current_num_bl."/".date("Y");
        // echo "<pre>";
        // var_dump($_POST);
        $id_bl=$this->model_home->save_bl($data_bl); 
        foreach($_POST['code_art'] as $k => $v) {
            $data_det_bl['code_article'] =htmlentities($_POST['code_art'][$k]);
            $data_det_bl['designation'] =htmlentities($_POST['designiation'][$k]);
            $data_det_bl['qte'] =htmlentities($_POST['qte'][$k]);
            $data_det_bl['unite'] =htmlentities($_POST['unite'][$k]);
            $data_bl['det_bl'][$k]=$data_det_bl;
            $data_det_bl['id_bl'] =(int)$id_bl;
            $this->model_home->save_detail_bl($data_det_bl); 
        } 
        
        $data['num_bl']=(int)$current_num_bl;
        $this->model_home->update_bl_num($data);

        unset($_POST);

        $this->set($data_bl);

        $this->layout = false;
        $this->render('pdf_bl');

    }

    function save_bc()
    {
        $this->loadModel("model_home");

        $last_num_bc=$this->model_home->get_last_bc_num();
        $current_num_bc=$last_num_bc[0]['num_bc']+1;

        $data_bc['societe'] =htmlentities($_POST['societe']);
        $data_bc['date'] = strtotime(htmlentities($_POST['date']));        
        $data_bc['total_ht'] =htmlentities($_POST['total_ht'][0]);
        $data_bc['tva'] =htmlentities($_POST['tva'][0]);
        $data_bc['total'] =htmlentities($_POST['total_ttc'][0]);
        $data_bc['numero_bc'] =$current_num_bc."/".date("Y");
        // echo "<pre>";
        //var_dump($data_facture);
        $id_fac=$this->model_home->save_bc($data_bc);  
        foreach($_POST['product'] as $k => $v) {
            $data_det_bc['designiation'] =htmlentities($_POST['product'][$k]);
            $data_det_bc['unite'] =htmlentities($_POST['unite'][$k]);
            $data_det_bc['qte'] =htmlentities($_POST['qte'][$k]);
            $data_det_bc['prix_unitaire'] =htmlentities($_POST['price_unit'][$k]);
            $data_det_bc['prix_total'] =htmlentities($_POST['price_total'][$k]);            
            $data_bc['det_bc'][$k]=$data_det_bc;
            $data_det_bc['id_bc'] =(int)$id_fac;
            $this->model_home->save_detail_bc($data_det_bc);
        } 

        $data['num_bc']=(int)$current_num_bc;
        $this->model_home->update_fac_num($data);


        unset($_POST);

        $this->set($data_bc);

        $this->layout = false;
        $this->render('pdf_bc');
    }
}
