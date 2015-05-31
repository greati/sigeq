<?php

use \DateTime;

/**
 * Description of Admin_controller
 *
 * @author Vitor
 */
class AdminAmb_controller extends CI_Controller{
    
    function __construct(){
        parent::__construct();
        $this->form_validation->set_error_delimiters('<p class="error">', '</p>');

        if(!$this->ion_auth->in_group('g_amb')){
            //show_error("Você não é Gerente de Ambientes.");
            redirect('login');
        }
    }
    
    public function index(){
        echo 'Hello world!';
    }
    
    /**
     * Método controlador do CI.
     * 
     * Realiza o cadastro de um ambiente. 
     * Exibe o formulário, faz validação e insere no banco quando possível.
     * 
     * @version 1.0.1
     * @author Vitor Greati <vitorgreati@hotmail.com>
     * @link http://./admin/ambs/new Rota para esta função.
     * @since 1.0.1 Passou a exibir o formulário e realizar validação.
     * @since 1.0.0 Primeira implementação. Apenas realizava o cadastro.
     */
    public function cadastrar_ambiente(){
        $data["type_section"] = "Ambientes";
        if($this->form_validation->run("form_ambiente")==FALSE){
            $this->template->set('title_section','Novo ambiente');

            $c = new CategoriaAmbiente_model();
            $data['categorias'] = $c->get();

            $this->template->load('template','cadastrar_ambiente',$data);
        }else{
            $a = new Ambiente_model();

            $a->nome = $this->input->post('nome');
            $a->descricao = $this->input->post('descricao');

            // set the category
            $c = new CategoriaAmbiente_model();
            $c->where('id',$this->input->post('categoria'))->get();
            $a->save_categoria($c);

            $a->save();
            redirect("/admin/ambs");
        }
    }
    
    /**
     * Método controlador do CI.
     * 
     * Exibe, em tabela, ambientes cadastrados no sistema.
     * Página oferece opções de editar e excluir ambientes. 
     * 
     * @version 1.0.0
     * @author Vitor Greati <vitorgreati@hotmail.com>
     * @link http://./admin/ambs Rota para esta função.
     * @since 1.0.0 Primeira implementação.
     */     
    public function listar_ambientes(){
        $data["type_section"] = "Ambientes";
        $this->template->set('title_section','Gerenciar ambientes');
        
        $a = new Ambiente_model();
        $data['ambientes'] = $a->include_related('categoria','nome',TRUE,TRUE)->get();
        
        $this->template->load('template','listar_ambientes',$data);
    }
    
    /**
     * Método controlador do CI.
     * 
     * Realiza o update de um ambiente. 
     * Exibe o formulário, faz validação e insere no banco quando possível.
     * 
     * @version 1.0.1
     * @author Vitor Greati <vitorgreati@hotmail.com>
     * @link http://./admin/ambs/edit/:num Rota para esta função.
     * @since 1.0.1 Passou a exibir o formulário e realizar validação.
     * @since 1.0.0 Primeira implementação. Apenas realizava o update.
     */
    public function editar_ambiente(){
        $data["type_section"] = "Ambientes";
        $id = $this->uri->segment(4);
        $a = new Ambiente_model($id);
        
        if($a->exists()){        
            if($this->form_validation->run("form_ambiente")==FALSE){
                $id = $this->uri->segment(4);

                $a = new Ambiente_model($id);

                $data['error'] = '';

                $this->template->set('title_section','Editar ambiente');

                $c = new CategoriaAmbiente_model();
                $data['categorias'] = $c->get();

                $l = new Localizacao_model();
                $data['localizacoes'] = $l->where_related('ambiente',$a)->get();

                $data['a'] = $a;

                $this->load->helper('form');

                $this->template->load('template','editar_ambiente',$data);               
            }else{
                $id = $this->uri->segment(4);

                $this->load->helper('form');

                $a = new Ambiente_model($id);

                $a->nome = $this->input->post('nome');
                $a->descricao = $this->input->post('descricao');

                // set the category
                $c = new CategoriaAmbiente_model();
                $c->where('id',$this->input->post('categoria'))->get();
                $a->save_categoria($c);

                $a->save();

                //do upload
                $config['upload_path'] = './assets/images/ambs';
                $config['file_name'] = "$id.jpg";
                $config['override'] = TRUE;
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_width'] = '2048';
                $config['max_height'] = '2048';

                $this->load->library('upload');
                $this->upload->initialize($config);
                $this->upload->do_upload();

                redirect("admin/ambs");            
            }
        }else{
            show_404();
        }
    }
    
    /**
     * Método controlador do CI.
     * 
     * Exclui um ambiente quando possível. 
     * 
     * @version 1.0.1
     * @author Vitor Greati <vitorgreati@hotmail.com>
     * @link http://./admin/ambs/delete/:num Rota para esta função.
     * @since 1.0.1 Passou a validar a existência do ambiente.
     * @since 1.0.0 Primeira implementação. Apenas realizava o delete.
     */    
    public function deletar_ambiente(){
        $id = $this->uri->segment(4);
        $a = new Ambiente_model($id);
        
        if($a->exists()){        
            $id = $this->uri->segment(4);
            $e = new Ambiente_model();
            $e->where('id',$id)->get();
            $e->delete();

            redirect("admin/ambs");
        }else{
            show_404();
        }
    }
    
    /**
     * Método controlador do CI.
     * 
     * Realiza o cadastro de uma localização. 
     * Exibe o formulário, faz validação e insere no banco quando possível.
     * 
     * @version 1.0.1
     * @author Vitor Greati <vitorgreati@hotmail.com>
     * @link http://./admin/tuts/new Rota para esta função.
     * @since 1.0.1 Passou a exibir o formulário e realizar validação.
     * @since 1.0.0 Primeira implementação. Apenas realizava o cadastro.
     */    
    public function cadastrar_localizacao(){
        $data["type_section"] = "Ambientes";
        $l = new Localizacao_model();
        
        $l->ratioX = $this->input->post('ratioX');
        $l->ratioY = $this->input->post('ratioY');
        $l->nome = $this->input->post('nome');
        $l->descricao = $this->input->post('descricao');
        
        $a = new Ambiente_model($this->uri->segment(3));
        $l->save_ambiente($a);
        
        $idEquips = $this->input->post('equips');
        $equips = array();
        
        foreach($idEquips as $idEquip){
            $equips[] = new Equipamento_model($idEquip);
        }
        
        $l->save_equipamentos($equips);
        
        $l->save();
        echo 1;
    }
    
    /**
     * Método controlador do CI.
     * 
     * Apenas exibe o formulário, pois a submissão é feita por AJAX.
     * 
     * @version 1.0.0
     * @author Vitor Greati <vitorgreati@hotmail.com>
     * @link http://./admin/ambs/:num/locs/edit/:num Rota para esta função.
     * @since 1.0.0 Primeira implementação.
     */   
    public function show_editar_localizacao(){
        $data["type_section"] = "Ambientes";
        $id = $this->uri->segment(6);
        
        $this->template->set('title_section','Editar localização');
        
        $l = new Localizacao_model($id);
        $e = new Equipamento_model();
        
        $data['l'] = $l->include_related('ambiente','*',TRUE,TRUE)->get_where(array('id'=>$id));
        
        $data['equipsRelated'] = $e->where_related('localizacoes',new Localizacao_model($id))->get();
        
        $e = new Equipamento_model();
        $data['equipamentos'] = $e->get();
        
        $this->template->load('template','editar_localizacao',$data);        
    }
    
    /**
     * Método controlador do CI.
     * 
     * Realiza o update de uma localização. 
     * Insere no banco quando possível.
     * A validação é feita por javascript.
     * 
     * @version 1.0.0
     * @author Vitor Greati <vitorgreati@hotmail.com>
     * @link http://./admin/ambs/:num/locs/edit/:num Rota para esta função.
     * @since 1.0.0 Primeira implementação. Apenas realiza o update.
     */    
    public function editar_localizacao(){
        $data["type_section"] = "Ambientes";
        $l = new Localizacao_model($this->uri->segment(6));

        $l->nome = $this->input->post('nome');
        $l->descricao = $this->input->post('descricao');
        
        $idEquips = $this->input->post('equips');
        $equips = array();
        
        foreach($l->equipamentos->get() as $e){
            $l->delete_equipamentos($e);
        }
        
        foreach($idEquips as $idEquip){
            $equips[] = new Equipamento_model($idEquip);
        }
        
        $l->save_equipamentos($equips);
        
        $l->save();
        echo 1;
    }

    /**
     * Método controlador do CI.
     * 
     * Exclui uma localização quando possível. 
     * 
     * @version 1.0.1
     * @author Vitor Greati <vitorgreati@hotmail.com>
     * @link http://./admin/ambs/:num/locs/delete/:num Rota para esta função.
     * @since 1.0.1 Passou a validar a existência da localização.
     * @since 1.0.0 Primeira implementação. Apenas realizava o delete.
     */    
    public function excluir_localizacao(){
        $l = new Localizacao_model($this->uri->segment(6));
        
        if($l->exists()){
            $l->delete();
            redirect("/admin/ambs/edit/".$this->uri->segment(3));
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
        $data["type_section"] = "Ambientes";
        $this->template->set('title','Gerenciar categorias');
        $this->template->set('title_section','Gerenciar categorias');
        $data['objeto'] = "ambs";
        
        $c = new CategoriaAmbiente_model();
        $c->distinct();
        $data['cats'] = $c->get();
        
        $data['c'] = new CategoriaAmbiente_model();
        
        if($this->form_validation->run("form_categoria") == TRUE){
            $c = new CategoriaAmbiente_model();
            $c->nome = $this->input->post("nome");
            $c->descricao = $this->input->post("descricao");
            $c->save();
            redirect("admin/ambs/cats");
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
        $data["type_section"] = "Ambientes";
        $this->template->set('title','Gerenciar categorias');
        $this->template->set('title_section','Gerenciar categorias');
        $data['objeto'] = "ambs";
        
        $c = new CategoriaAmbiente_model();
        $data['cats'] = $c->get();
        
        $id = $this->uri->segment(4);
        
        //se é uma edição de categoria
        if(isset($id)){
            $c = new CategoriaAmbiente_model($id);
            if($c->exists()){
                if($this->form_validation->run("form_categoria") == FALSE){
                    $data['c'] = $c;
                    $this->template->load("template","gerenciar_cat_equips", $data);
                }else{
                    $c->nome = $this->input->post("nome");
                    $c->descricao = $this->input->post("descricao");
                    $c->save();
                    redirect("admin/ambs/cats");
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
        $id = $this->uri->segment(5);
        $c = new CategoriaAmbiente_model($id);
        
        if($c->exists()){
            $c->delete();
            redirect("admin/ambs/cats");
        }else{
            show_404();
        }
    }    
    
//    public function listar_reservas(){
//        $this->template->set('title_section','Minhas reservas');
//        
//        $u = new Usuario_model(1); //get the logged
//        $r = new Reserva_model();
//        
//        $data['reservas'] = $r->where_related('usuario',$u)->include_related('equipamento','*', TRUE, TRUE)->get();
//        
//        $data['now'] = $this->convert_date_format(date("d/m/Y H:i"),'d/m/Y H:i','Y-m-d H:i:s');
//
//        $this->template->load('template','listar_reservas',$data);        
//        
//    }
//    
//    public function deletar_reserva(){
//        $id = $this->uri->segment(5);
//
//        $r = new Reserva_model($id);
//        
//        $r->delete();
//        
//        redirect("admin/reservs");        
//    }
//    
//    public function registrar_uso(){
//        
//    }
    
}

/* End of file Admin_controller.php */
/* Location: ./application/controller/Admin_controller.php */
