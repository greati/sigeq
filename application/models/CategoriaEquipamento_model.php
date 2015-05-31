<?php
/**
 * Description of CategoriaEquipamento_model
 *
 * @author Vitor
 */
class CategoriaEquipamento_model extends DataMapper{
    
    // Needed because we are not using the singular/plural pattern
    var $table = 'categoria_equipamento';
        
    var $has_many = array(
        'equipamentos'=>array(
           'class' => 'equipamento_model',
           'other_field' => 'categoria',
           'join_table' => 'categoria'
        )
    );
        
    // It allows to load an object by id when it is created
    function __construct($id = NULL){
        parent::__construct($id);
    }
 
}

/* End of file CategoriaEquipamento_model.php */
/* Location: ./application/models/CategoriaEquipamento_model.php */