<?php

$config = array(
    'cadastrar_usuario'=> array(
        array(
            'field' => 'nome',
            'label' => 'Nome',
            'rules' => 'required'
        ),
        array(
            'field' => 'login',
            'label' => 'Login',
            'rules' => 'required|min_length[4]|max_length[12]|callback_checar_username'
        ),
        array(
            'field' => 'senha',
            'label' => 'Senha',
            'rules' => 'required|min_length[8]|max_length[20]'
        ),
        array(
            'field' => 'confirmar_senha',
            'label' => 'Confirmar senha',
            'rules' => 'required|matches[senha]'
        ),
        array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'required|valid_email'
        ),
        array(
            'field' => 'autoridade[]',
            'label' => 'Autoridades',
            'rules' => 'required'
        )
    ),
    'editar_usuario' => array(
        array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'required|valid_email'
        ),
        array(
            'field' => 'nome',
            'label' => 'Nome',
            'rules' => 'required'
        ),
        array(
            'field' => 'numeroCasa',
            'label' => 'Numero da casa',
            'rules' => 'is_natural'
        ),
        array(
            'field' => 'celular',
            'label' => 'Celular',
            'rules' => 'numeric'
        ),
        array(
            'field' => 'telefoneFixo',
            'label' => 'Telefone',
            'rules' => 'numeric'
        ),
        array(
            'field' => 'cep',
            'label' => 'CEP',
            'rules' => 'numeric'
        )
    ),
    'form_equipamento' => array(
        array(
            'field' => 'nome',
            'label' => 'Nome',
            'rules' => 'required'
        ),
        array(
            'field' => 'tombamento',
            'label' => 'Tombamento',
            'rules' => 'required'
        ),
        array(
            'field' => 'categoria',
            'label' => 'Categoria',
            'rules' => 'required'
        ),
        array(
            'field' => 'descricao',
            'label' => 'Descricao',
            'rules' => 'required'
        ),
        array(
            'field' => 'quantidade',
            'label' => 'Quantidade',
            'rules' => 'required|numeric'
        )
    ),
    'form_reserva' => array(
        array(
            'field' => 'equipamento',
            'label' => 'Equipamento',
            'rules' => 'required'
        ),
        array(
            'field' => 'descricao',
            'label' => 'Descricao',
            'rules' => 'required'
        ),
        array(
            'field' => 'inicio',
            'label' => 'Início',
            'rules' => 'required'
        ),
        array(
            'field' => 'fim',
            'label' => 'Fim',
            'rules' => 'required'
        )        
    ),
    'form_tutorial' => array(
        array(
            'field' => 'titulo',
            'label' => 'Título',
            'rules' => 'required'
        ),
        array(
            'field' => 'texto',
            'label' => 'Texto',
            'rules' => 'required'
        )
    ),
    'form_ambiente' => array(
        array(
            'field' => 'nome',
            'label' => 'Nome',
            'rules' => 'required'
        ),
        array(
            'field' => 'descricao',
            'label' => 'Descricao',
            'rules' => 'required'
        )        
    ),
    'form_categoria' => array(
        array(
            'field' => 'nome',
            'label' => 'Nome',
            'rules' => 'required'
        ),
        array(
            'field' => 'descricao',
            'label' => 'Descrição',
            'rules' => 'required'
        )
    )
);

?>