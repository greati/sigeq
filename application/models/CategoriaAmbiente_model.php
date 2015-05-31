<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CategoriaTutorial_model
 *
 * @author Vitor
 */
class CategoriaAmbiente_model extends DataMapper{
   
    // Needed because we are not using the singular/plural pattern
    var $table = 'categoria_ambiente';
    
    var $has_many = array(
        'ambientes'=>array(
           'class' => 'ambiente_model',
           'other_field' => 'categoria',
           'join_table' => 'categoria'
        )
    );
    
    // It allows to load an object by id when it is created
    function __construct($id = NULL){
        parent::__construct($id);
    }
 
}

/* End of file CategoriaTutorial_model.php */
/* Location: ./application/models/CategoriaTutorial_model.php */