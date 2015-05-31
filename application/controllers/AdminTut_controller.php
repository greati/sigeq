<?php

use \DateTime;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Admin_controller
 *
 * @author Vitor
 */
class AdminTut_controller extends CI_Controller{
    
    function __construct(){
        parent::__construct();
        $this->form_validation->set_error_delimiters('<p class="error">', '</p>');

        if(!$this->ion_auth->in_group('g_tut')){
            //show_error("Você não é Gerente de Tutoriais.");
            redirect('login');
        }
    }
    
    public function index(){
        echo 'Hello world!';
    }
    
    /**
     * Método controlador do CI.
     * 
     * Realiza o cadastro de um tutorial. 
     * Exibe o formulário, faz validação e insere no banco quando possível.
     * 
     * @version 1.0.1
     * @author Vitor Greati <vitorgreati@hotmail.com>
     * @link http://./admin/tuts/new Rota para esta função.
     * @since 1.0.1 Passou a exibir o formulário e realizar validação.
     * @since 1.0.0 Primeira implementação. Apenas realizava o cadastro.
     */
    public function publicar_tutorial(){
        $data["type_section"] = "Tutoriais";
        if($this->form_validation->run("form_tutorial")==FALSE){
            $this->template->set('title','Publicar tutorial');
            $this->template->set('title_section','Criar tutorial');

            $categorias = new CategoriaTutorial_model();
            $data['categorias'] = $categorias->get(); 

            $this->template->load('template','criar_tutorial',$data);
        }else{
            $t = new Tutorial_model();
            $t->titulo = $this->input->post('titulo');
            $t->texto = $this->input->post('texto');
            $t->save();

            // set the user
            $u = new Usuario_model();
            $u->where('id', $this->input->post('usuario_id'))->get();
            $t->save_editores($u);

            // set the category
            $c = new CategoriaTutorial_model();
            $c->where('nome',$this->input->post('categoria'))->get();
            $t->save_categoria($c);

            redirect("admin/tuts");
        }
        
    }

    /**
     * Método controlador do CI.
     * 
     * Exibe, em tabela, tutoriais cadastrados no sistema.
     * Página oferece opções de editar e excluir tutoriais. 
     * 
     * @version 1.0.0
     * @author Vitor Greati <vitorgreati@hotmail.com>
     * @link http://./admin/tuts Rota para esta função.
     * @since 1.0.0 Primeira implementação.
     */
    public function listar_tutoriais(){
        $this->template->set('title','Gerenciar tutoriais');
        $this->template->set('title_section','Gerenciar tutoriais');
        
        $tutorial = new Tutorial_model();
        $data = array(
            'tutoriais' => $tutorial->include_related('categoria','nome', TRUE, TRUE)->include_related('editores','nome',TRUE,TRUE)->get()
        );
        $data["type_section"] = "Tutoriais";
        $this->template->load('template','listar_tutoriais',$data);    
    }
    
    /**
     * Método controlador do CI.
     * 
     * Realiza o update de um tutorial. 
     * Exibe o formulário, faz validação e insere no banco quando possível.
     * 
     * @version 1.0.1
     * @author Vitor Greati <vitorgreati@hotmail.com>
     * @link http://./admin/tuts/edit/:num Rota para esta função.
     * @since 1.0.1 Passou a exibir o formulário e realizar validação.
     * @since 1.0.0 Primeira implementação. Apenas realizava o update.
     */
    public function editar_tutorial(){
        $data["type_section"] = "Tutoriais";
        $id = $this->uri->segment(4);
        $t = new Tutorial_model($id);
        
        if($t->exists()){
            if($this->form_validation->run("form_tutorial")==FALSE){
                $this->template->set('title','Editar tutorial');
                $this->template->set('title_section','Editar tutorial');

                $id = $this->uri->segment(4);

                $t = new Tutorial_model();
                $categorias = new CategoriaTutorial_model();

                $data['t'] = $t->where('id',$id)->get();
                $data['categorias'] = $categorias->get(); 
                $this->template->load('template','editar_tutorial',$data);
            }else{
                $id = $this->input->post('id');

                $t = new Tutorial_model();

                $t->where('id',$id)->get();

                $t->titulo = $this->input->post('titulo');
                $t->texto = $this->input->post('texto');
                $t->save();

                // set the user
                $u = new Usuario_model();
                $u->where('id', $this->input->post('usuario_id'))->get();
                $t->save_editores($u);

                // set the category
                $c = new CategoriaTutorial_model();
                $c->where('nome',$this->input->post('categoria'))->get();
                $t->save_categoria($c);

                redirect("admin/tuts");
            }
        }else{
            show_404();
        }              
    }

    /**
     * Método controlador do CI.
     * 
     * Exclui um tutorial quando possível. 
     * 
     * @version 1.0.1
     * @author Vitor Greati <vitorgreati@hotmail.com>
     * @link http://./admin/tuts/delete/:num Rota para esta função.
     * @since 1.0.1 Passou a validar a existência do tutorial.
     * @since 1.0.0 Primeira implementação. Apenas realizava o delete.
     */
    public function deletar_tutorial(){
        $data["type_section"] = "Tutoriais";
        $id = $this->uri->segment(4);
        $t = new Tutorial_model($id);
        
        if($t->exists()){        
            $id = $this->uri->segment(4);
            $t = new Tutorial_model();
            $t->where('id',$id)->get();
            $t->delete();
            redirect("admin/tuts");
        }else{
            show_404();
        }
    }
    
    /**
     * Método controlador do CI.
     * 
     * Cria categorias
     * 
     * @version 1.0.0
     * @author Vitor Greati <vitorgreati@hotmail.com>
     * @link http://./admin/equips/delete/:num Rota para esta função.
     * @since 1.0.0 Primeira implementação. Apenas realizava o delete.
     */    
    public function criar_categorias(){
        $data["type_section"] = "Tutoriais";
        $this->template->set('title','Gerenciar categorias');
        $this->template->set('title_section','Gerenciar categorias');
        $data['objeto'] = "tuts";
        
        $c = new CategoriaTutorial_model();
        $c->distinct();
        $data['cats'] = $c->get();
        
        $data['c'] = new CategoriaTutorial_model();
        
        if($this->form_validation->run("form_categoria") == TRUE){
            $c = new CategoriaTutorial_model();
            $c->nome = $this->input->post("nome");
            $c->descricao = $this->input->post("descricao");
            $c->save();
            redirect("admin/tuts/cats");
        }
        $this->template->load("template","gerenciar_cat_equips", $data);
    }     
    
    
    /**
     * Método controlador do CI.
     * 
     * Gerencia categorias
     * 
     * @version 1.0.0
     * @author Vitor Greati <vitorgreati@hotmail.com>
     * @link http://./admin/equips/delete/:num Rota para esta função.
     * @since 1.0.0 Primeira implementação..
     */    
    public function editar_categorias(){
        $data["type_section"] = "Tutoriais";
        $this->template->set('title','Gerenciar categorias');
        $this->template->set('title_section','Gerenciar categorias');
        $data['objeto'] = "tuts";
        
        $c = new CategoriaTutorial_model();
        $data['cats'] = $c->get();
        
        $id = $this->uri->segment(4);
        
        //se é uma edição de categoria
        if(isset($id)){
            $c = new CategoriaTutorial_model($id);
            if($c->exists()){
                if($this->form_validation->run("form_categoria") == FALSE){
                    $data['c'] = $c;
                    $this->template->load("template","gerenciar_cat_equips", $data);
                }else{
                    $c->nome = $this->input->post("nome");
                    $c->descricao = $this->input->post("descricao");
                    $c->save();
                    redirect("admin/tuts/cats");
                }
            }else{
                show_404();
            }
        }
    }    
    
    /**
     * Método controlador do CI.
     * 
     * Deleta categorias
     * 
     * @version 1.0.1
     * @author Vitor Greati <vitorgreati@hotmail.com>
     * @link http://./admin/equips/delete/:num Rota para esta função.
     * @since 1.0.1 Passou a validar a existência da reserva.
     * @since 1.0.0 Primeira implementação. Apenas realizava o delete.
     */    
    public function deletar_categoria(){
        $data["type_section"] = "Tutoriais";
        $id = $this->uri->segment(5);
        $c = new CategoriaTutorial_model($id);
        
        if($c->exists()){
            $c->delete();
            redirect("admin/tuts/cats");
        }else{
            show_404();
        }
    }    
    
}
//
/* End of file Admin_controller.php */
/* Location: ./application/controller/Admin_controller.php */
