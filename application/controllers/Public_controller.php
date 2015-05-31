<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Public_controller
 *
 * @author Vitor
 */
class Public_controller extends CI_Controller{
    
    function __construct() {
        parent::__construct();
    }

    function sobre(){
        $data["type_section"] = "SIGEQ";
        $this->template->set('title_section','Sobre');
        $this->template->load('template','sobre',$data);
    }
    
    function contato(){
        $data["type_section"] = "SIGEQ";
        $this->template->set('title_section','Contato');
        $this->template->load('template','contato',$data);
    }
    
    /*
     * Para a página de busca, precisamos de dois controladores:
     * um exibe a página e outra responde ao form,
     * visto que o método utilizado é o GET, não suportado pelo
     * form_validation.
     * 
     */
    
    function busca(){
        $data["type_section"] = "Busca";
        $busca = $this->input->get("q");
        
        if($busca == null || empty($busca)){
            $this->template->set('title_section','Busca');
            $this->template->load('template','busca');
        }else{
            $this->template->set('title_section','Resultados da busca para "'.$busca.'"');
            
            $e = new Equipamento_model();
            $data["equips"] = $e->like('nome',$busca)->or_like('fabricante',$busca)->get();//like('fabricante',$busca)->get();
            
            $t = new Tutorial_model();
            $data["tuts"] = $t->like('titulo',$busca)->get();
            
            $a = new Ambiente_model();
            $data["ambs"] = $a->like('nome',$busca)->like('descricao',$busca)->get();
            
            $this->template->load('template','busca',$data);
        }
    }
    
    /**
     * Método controlador do CI.
     * 
     * Lista todos os usuários.
     * 
     * @version 1.0.0
     * @author Vitor Greati <vitorgreati@hotmail.com>
     * @link http://./users Rota para esta função.
     * @since 1.0.0 Primeira implementação.
     */    
    function listar_usuarios(){
        $this->template->set('title','Usuários');
        $this->template->set('title_section','Usuários');
        
        $usuario = new Usuario_model();
        $autoridade = new Autoridade_model();
        $data = array(
            'usuarios' => $usuario->get()
        );
        $data["type_section"] = "Usuários";
        $this->template->load('template','consultar_usuarios',$data);
    }    

    /**
     * Método controlador do CI.
     * 
     * Lista todos os equipamentos.
     * 
     * @version 1.0.0
     * @author Vitor Greati <vitorgreati@hotmail.com>
     * @link http://./equips Rota para esta função.
     * @since 1.0.0 Primeira implementação.
     */     
    function listar_equipamentos(){
        $this->template->set('title','Equipamentos');
        $this->template->set('title_section','Equipamentos');
        
        $e = new Equipamento_model();
        $data = array(
            'equipamentos' => $e->include_related('categoria','nome',TRUE,TRUE)->get()
        );
        $data["type_section"] = "Equipamentos";
        $this->template->load('template','consultar_equipamentos',$data);
    }

    /**
     * Método controlador do CI.
     * 
     * Retorna, por AJAX e JSON, todos os equipamentos.
     * 
     * @version 1.0.0
     * @author Vitor Greati <vitorgreati@hotmail.com>
     * @link http://./equips/list/ajax Rota para esta função.
     * @since 1.0.0 Primeira implementação.
     */     
    function listar_equipamentos_ajax(){
        $equip = new Equipamento_model();
        $equips = $equip->get();
        $results = array();
        foreach($equips as $e){
            $results[] = $e->to_json();
        }
                
        print '['.join(',', $results).']';
    }

    /**
     * Método controlador do CI.
     * 
     * Lista todos os tutoriais.
     * 
     * @version 1.0.0
     * @author Vitor Greati <vitorgreati@hotmail.com>
     * @link http://./tuts Rota para esta função.
     * @since 1.0.0 Primeira implementação.
     */    
    function listar_tutoriais(){
        $this->template->set('title','Tutoriais');
        $this->template->set('title_section','Tutoriais');
        
        $t = new Tutorial_model();
        $data = array(
            'tutoriais' => $t->include_related('categoria','nome',TRUE,TRUE)->include_related('editores','nome',TRUE,TRUE)->get()
        );
        $data["type_section"] = "Tutoriais";
        $this->template->load('template','consultar_tutoriais',$data);
    }

    /**
     * Método controlador do CI.
     * 
     * Lista todos os ambientes.
     * 
     * @version 1.0.0
     * @author Vitor Greati <vitorgreati@hotmail.com>
     * @link http://./ambs Rota para esta função.
     * @since 1.0.0 Primeira implementação.
     */    
    function listar_ambientes(){
        $this->template->set('title','Ambientes');
        $this->template->set('title_section','Ambientes');
        
        $a = new Ambiente_model();
        $a->group_by('id');
        $a->include_related('localizacoes','*',TRUE,TRUE);
        $a->include_related('localizacoes/equipamentos','nome');
        $a->include_related('categoria','*',TRUE,TRUE);
        
        $data = array(
            'ambientes' => $a->get()
        );
        
        $data['countEquips'] = $data['ambientes']->count();
        $data["type_section"] = "Ambientes";
        $this->template->load('template','consultar_ambientes',$data);    
        
    }

    /**
     * Método controlador do CI.
     * 
     * Exibe a página de um equipamento.
     * 
     * @version 1.0.0
     * @author Vitor Greati <vitorgreati@hotmail.com>
     * @link http://./equips/:num Rota para esta função.
     * @since 1.0.0 Primeira implementação.
     */    
    function ver_equipamento(){
        $this->template->set('title_section','Equipamento');
        
        $id = $this->uri->segment(2);
        
        $data['e'] = new Equipamento_model($id);
        
        $r = new Reserva_model();
        
        $data['reservas'] = $r->where_related('equipamento',$data['e'])->include_related('usuario','*',TRUE,TRUE)->get();
        $data["type_section"] = "Equipamentos";
        $data["not_appear_page_title"] = TRUE;
        $this->template->load('template','ver_equipamento',$data);
    }

    /**
     * Método controlador do CI.
     * 
     * Exibe a página de um ambiente.
     * 
     * @version 1.0.0
     * @author Vitor Greati <vitorgreati@hotmail.com>
     * @link http://./ambs/:num Rota para esta função.
     * @since 1.0.0 Primeira implementação.
     */    
    function ver_ambiente(){
        $this->template->set('title_section','Ambiente');
        
        $id = $this->uri->segment(2);
        
        $a = new Ambiente_model();
        $data['a'] = $a->where('id',$id)->include_related('categoria',"*", TRUE, TRUE)->get();
        //$data['a'] = $a->include_related('categoria',"*", TRUE, TRUE)->get();
        
        $l = new Localizacao_model();
        $l->where_related('ambiente',$a);
        $data['localizacoes'] = $l->get();
        
        $l = new Localizacao_model();
        $data['localizacoes_c_equips'] = $l->where_related('ambiente',$a)->include_related('equipamentos','*',TRUE, TRUE)->group_by('equipamentos_nome')->get();
        $data["type_section"] = "Ambientes";
        $data["not_appear_page_title"] = TRUE;
        $this->template->load('template','ver_ambiente',$data);
    }
    
    /**
     * Método controlador do CI.
     * 
     * Exibe a página de um usuário.
     * 
     * @version 1.0.0
     * @author Vitor Greati <vitorgreati@hotmail.com>
     * @link http://./users/:num Rota para esta função.
     * @since 1.0.0 Primeira implementação.
     */    
    function ver_perfil(){
        $this->template->set('title_section','Perfil');
        
        $id = $this->uri->segment(2);
        
        $data['u'] = new Usuario_model($id);
        $data["type_section"] = "Usuários";
        $data["not_appear_page_title"] = TRUE;
        $this->template->load('template','ver_perfil',$data);
    }

    /**
     * Método controlador do CI.
     * 
     * Exibe a página de um tutorial.
     * 
     * @version 1.0.0
     * @author Vitor Greati <vitorgreati@hotmail.com>
     * @link http://./tuts/:num Rota para esta função.
     * @since 1.0.0 Primeira implementação.
     */    
    function ver_tutorial(){
        $id = $this->uri->segment(2);
        $t = new Tutorial_model();
        $t = $t->include_related('categoria','nome',TRUE,TRUE)->include_related('editores','nome',TRUE,TRUE);
        $data['t'] = $t->where('id', $id)->get();
        
        $this->template->set('title_section','Tutorial' . $data['t']->titulo);
        $data["type_section"] = "Tutoriais";
        $data["not_appear_page_title"] = TRUE;
        $this->template->load('template','ver_tutorial',$data);
    }

    /**
     * Método controlador do CI.
     * 
     * Exibe a página de uma localização.
     * 
     * @version 1.0.0
     * @author Vitor Greati <vitorgreati@hotmail.com>
     * @link http://./ambs/:num/locs/:num Rota para esta função.
     * @since 1.0.0 Primeira implementação.
     */    
    function ver_localizacao(){
        $id = $this->uri->segment(4);
        
        $l = new Localizacao_model();
        
        $data['l'] = $l->include_related('ambiente','*',TRUE,TRUE)->include_related('equipamentos','*',TRUE,TRUE)->where('id',$id)->get();
        
        $this->template->set('title_section','Localização');
        $data["type_section"] = "Ambientes";
        $data["not_appear_page_title"] = TRUE;
        $this->template->load('template','ver_localizacao',$data);
    }
    
    /**
     * Método controlador do CI.
     * 
     * Exibe a página de uma reserva.
     * 
     * @version 1.0.0
     * @author Vitor Greati <vitorgreati@hotmail.com>
     * @link http://./equips/reservs/:num Rota para esta função.
     * @since 1.0.0 Primeira implementação.
     */    
    function ver_reserva(){
        $id = $this->uri->segment(3);
        
        $r = new Reserva_model();
        
        $data['r'] = $r->include_related('equipamento','*',TRUE,TRUE)->include_related('usuario','*',TRUE,TRUE)->where('id',$id)->get();
        
        $this->template->set('title_section','Reserva');
        $data["type_section"] = "Equipamentos";
        $data["not_appear_page_title"] = TRUE;
        $this->template->load('template','ver_reserva',$data);
    }    
    
}
