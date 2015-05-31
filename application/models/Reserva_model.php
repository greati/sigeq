<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Reserva_model
 *
 * @author Vitor
 */
class Reserva_model extends DataMapper{
    
    // Needed because we are not using the singular/plural pattern
    var $table = 'usuario_reserva_equipamento';
    
    var $has_one = array(
        'usuario' => array(
            'class'=>'usuario_model',
            'join_other_as'=>'usuario',
            'join_self_as'=>'reserva',
            'join_table'=>'usuario_reserva_equipamento'            
        ),
        'equipamento' => array(
            'class'=>'equipamento_model',
            'join_other_as'=>'equipamento',
            'join_self_as'=>'reserva',
            'join_table'=>'usuario_reserva_equipamento'            
        )
    );

    // It allows to load an object by id when it is created
    function __construct($id = NULL){
        parent::__construct($id);
    }
}

/* End of file Equipamento_model.php */
/* Location: ./application/models/Equipamento_model.php */