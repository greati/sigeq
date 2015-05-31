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
class Tutorial_model extends DataMapper{

    var $table = "tutorial";
    
    var $has_one = array(
        'categoria'=>array(
            'class'=>'categoriatutorial_model',
            'join_other_as'=>'categoria',
            'join_self_as'=>'tutorial',
            'join_table'=>'tutorial'
        )
    );
    
    var $has_many = array(
        "editores" => array(
            "class" => "usuario_model",
            'other_field' => 'tutoriais_editados',
            'join_self_as' => 'tutorial',
            'join_other_as' => 'usuario',
            'join_table' => 'usuario_edita_tutorial' 
        )
    );
    
    // It allows to load an object by id when it is created
    function __construct($id = NULL){
        parent::__construct($id);
    }
 
}

/* End of file Tutorial_model.php */
/* Location: ./application/models/Tutorial_model.php */