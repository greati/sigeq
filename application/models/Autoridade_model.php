<?php
/**
 * Description of Autoridade_model
 *
 * @author Vitor
 */
class Autoridade_model extends DataMapper{
    
    // Needed because we are not using the singular/plural pattern
    var $table = 'autoridade';
    
    // Defining manually a many-to-many relationship
    var $has_many = array(
        'usuarios'=>array(
           'class' => 'usuario_model',
           'other_field' => 'autoridades',
           'join_self_as' => 'gruoup',
           'join_other_as' => 'user',
           'join_table' => 'usuario_autoridade' 
        )
    );
    
    // It allows to load an object by id when it is created
    function __construct($id = NULL){
        parent::__construct($id);
    }
 
}

/* End of file Autoridade_model.php */
/* Location: ./application/models/Autoridade_model.php */
