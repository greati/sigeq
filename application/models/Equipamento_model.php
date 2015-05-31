<?php
/**
 * Description of Equipamento_model
 *
 * @author Vitor
 */
class Equipamento_model extends DataMapper{
    
    // Needed because we are not using the singular/plural pattern
    var $table = 'equipamento';
    
    var $has_one = array(
        'categoria'=>array(
            'class'=>'categoriaequipamento_model',
            'join_other_as'=>'categoria',
            'join_self_as'=>'equipamento',
            'join_table'=>'equipamento'
        )
    );
    
    var $has_many = array(
        'editores' => array(
            'class' => 'usuario_model',
            'other_field' => 'equipamentos_editados',
            'join_self_as' => 'equipamento',
            'join_other_as' => 'usuario',
            'join_table' => 'usuario_edita_equipamento' 
        ),
        'reservas' => array(
            'class' => 'usuario_model',
            'other_field' => 'equipamentos_reservados',
            'join_self_as' => 'equipamento',
            'join_other_as' => 'usuario',
            'join_table' => 'usuario_reserva_equipamento'
        ),
        'localizacoes'=>array(
           'class' => 'localizacao_model',
           'other_field' => 'equipamentos',
           'join_self_as' => 'equipamento',
           'join_other_as' => 'localizacao',
           'join_table' => 'localizacao_equipamento' 
        )
    );
    
    // It allows to load an object by id when it is created
    function __construct($id = NULL){
        parent::__construct($id);
    }
}

/* End of file Equipamento_model.php */
/* Location: ./application/models/Equipamento_model.php */