<?php
class model_home extends Models {
    function __construct()
    {
    }

    function save_facture($data)
    {
        $this->table = "factures";
        return $this->save_($data);
    }

    function save_bl($data)
    {
        $this->table = "bon_livraison";
        return $this->save_($data);
    }

    function save_bc($data)
    {
        $this->table = "bon_commande";
        return $this->save_($data);
    }

    function save_detail_facture($data)
    {
        $this->table = "details_fac";
        return $this->save_($data);
    }

    function save_detail_bl($data)
    {
        $this->table = "details_bl";
        return $this->save_($data);
    }

    function save_detail_bc($data)
    {
        $this->table = "details_bc";
        return $this->save_($data);
    }

    function get_last_fac_num()
    {
        $this->table = "sequence" ;
        $arrydata = array (
            'condition' => 'id = 1',
            'fields' => 'num_fac',
            'params' => array (
            )
        );
        $r = $this->find( $arrydata );
        return $r;
     }

     function update_fac_num($data){
        $this->table='sequence';
        $data['id'] = array('n' => 'id', 
                            'd' => 1);
        return $this->update($data);
    }

    function get_last_bl_num()
    {
        $this->table = "sequence" ;
        $arrydata = array (
            'condition' => 'id =:id',
            'fields' => 'num_bl',
            'params' => array (
                ':id'=> 1
            )
        );
        $r = $this->find ( $arrydata );
        return $r;
     }

     function update_bl_num($data){
        $this->table='sequence';
        $data['id'] = array('n' => 'id', 
                            'd' => 1);
        return $this->update($data);
    }

    function get_last_bc_num()
    {
        $this->table = "sequence" ;
        $arrydata = array (
            'condition' => 'id =:id',
            'fields' => 'num_bc',
            'params' => array (
                ':id'=> 1
            )
        );
        $r = $this->find ( $arrydata );
        return $r;
     }

}
        ?>