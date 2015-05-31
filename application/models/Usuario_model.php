<?php
/**
 * Description of Usuario_model
 *
 * @author Vitor
 */
class Usuario_model extends DataMapper{
    
    // Needed because we are not using the singular/plural pattern
    var $table = 'usuario';
    
    // Defining manually a many-to-many relationship
    var $has_many = array(
        'autoridades'=>array(
           'class' => 'autoridade_model',
           'other_field' => 'usuarios',
           'join_self_as' => 'user',
           'join_other_as' => 'group',
           'join_table' => 'usuario_autoridade' 
        ),
        'equipamentos_editados' => array(
            'class' => 'equipamento_model',
            'other_field' => 'editores',
            'join_self_as' => 'usuario',
            'join_other_as' => 'equipamento',
            'join_table' => 'usuario_edita_equipamento'
        ),
        'equipamentos_reservados' => array(
            'class' => 'equipamento_model',
            'other_field' => 'reservas',
            'join_self_as' => 'usuario',
            'join_other_as' => 'equipamento',
            'join_table' => 'usuario_edita_equipamento'
        ),
        'tutoriais_editados' => array(
            'class' => 'tutorial_model',
            'other_field' => 'editores',
            'join_self_as' => 'usuario',
            'join_other_as' => 'tutorial',
            'join_table' => 'usuario_edita_tutorial'
        )
    );
    
    // It allows to load an object by id when it is created
    function __construct($id = NULL){
        parent::__construct($id);
    }
 
}

/* End of file Usuario_model.php */
/* Location: ./application/models/Usuario_model.php */