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
class Localizacao_model extends DataMapper{

    var $table = "localizacao";
    
    var $has_one = array(
        'ambiente'=>array(
            'class'=>'ambiente_model',
            'join_other_as'=>'ambiente', // ambiente_id
            'join_table'=>'localizacao'
        )
    );
    
    var $has_many = array(
        'equipamentos'=>array(
           'class' => 'equipamento_model',
           'other_field' => 'localizacoes',
           'join_self_as' => 'localizacao',
           'join_other_as' => 'equipamento',
           'join_table' => 'localizacao_equipamento' 
        )
    );
    
    // It allows to load an object by id when it is created
    function __construct($id = NULL){
        parent::__construct($id);
    }
 
}

/* End of file Tutorial_model.php */
/* Location: ./application/models/Tutorial_model.php */