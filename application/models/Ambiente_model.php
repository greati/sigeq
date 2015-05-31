<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Tutorial_model
 *
 * @author Vitor
 */
class Ambiente_model extends DataMapper{

    var $table = "ambiente";
    
    var $has_one = array(
        'categoria'=>array(
            'class'=>'categoriaambiente_model',
            'join_other_as'=>'categoria',
            'join_self_as'=>'ambiente',
            'join_table'=>'ambiente'
        )
    );
    
    var $has_many = array(
        'localizacoes'=>array(
           'class' => 'localizacao_model',
           'other_field' => 'ambiente',
           'join_table' => 'localizacao'
        )
    );
    
    // It allows to load an object by id when it is created
    function __construct($id = NULL){
        parent::__construct($id);
    }
 
}

/* End of file Tutorial_model.php */
/* Location: ./application/models/Tutorial_model.php */