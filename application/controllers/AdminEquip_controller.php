<?php

use \DateTime;

/**
 * Description of Admin_controller
 *
 * @author Vitor
 */
class AdminEquip_controller extends CI_Controller{
    
    function __construct(){
        parent::__construct();
        $this->form_validation->set_error_delimiters('<p class="error">', '</p>');

        if(!$this->ion_auth->in_group('g_equips')){
            //show_error("Você não é Gerente de Equipamentos.");
            redirect('login');
        }
    }
    
    public function index(){
        echo 'Hello world!';
    }
    
    /**
     * Método controlador do CI.
     * 
     * Realiza o cadastro de um equipamento. 
     * Exibe o formulário, faz validação e insere no banco quando possível.
     * 
     * @version 1.0.1
     * @author Vitor Greati <vitorgreati@hotmail.com>
     * @link http://./admin/equips/new Rota para esta função.
     * @since 1.0.1 Passou a exibir o formulário e realizar validação.
     * @since 1.0.0 Primeira implementação. Apenas realizava o cadastro.
     */
    public function cadastrar_equipamento(){
        $data["type_section"] = "Equipamentos";
        if($this->form_validation->run('form_equipamento') == FALSE){
            $this->template->set('title','Cadastrar equipamento');
            $this->template->set('title_section','Cadastrar equipamento');

            $categorias = new CategoriaEquipamento_model();
            $data['categorias'] = $categorias->get();   

            $this->template->load('template','cadastrar_equip',$data);
        }else{
            // create the equip
            $e = new Equipamento_model();
            $e->descricao = $this->input->post('descricao');
            $e->fabricante = $this->input->post('fabricante');
            $e->instrucoes = $this->input->post('instrucoes');
            $e->nome = $this->input->post('nome');
            $e->precaucoes = $this->input->post('precaucoes');
            $e->quantidade = $this->input->post('quantidade');
            $e->tombamento = $this->input->post('tombamento');
            $e->save();

            // set the user
            $u = new Usuario_model();
            $u->where('id', $this->input->post('usuario_id'))->get();
            $e->save_editores($u);

            // set the category
            $c = new CategoriaEquipamento_model();
            $c->where('nome',$this->input->post('categoria'))->get();
            $e->save_categoria($c);
            
            //do upload
            $config['upload_path'] = './assets/images/equips';
            $config['file_name'] = "$e->id.jpg";
            $config['override'] = TRUE;
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_width'] = '2048';
            $config['max_height'] = '2048';

            $this->load->library('upload');
            $this->upload->initialize($config);
            $this->upload->do_upload();

            redirect("admin/equips");
        }
    }
    
    /**
     * Método controlador do CI.
     * 
     * Exibe, em tabela, equipamentos cadastrados no sistema.
     * Página oferece opções de editar e excluir equipamentos. 
     * 
     * @version 1.0.0
     * @author Vitor Greati <vitorgreati@hotmail.com>
     * @link http://./admin/equips Rota para esta função.
     * @since 1.0.0 Primeira implementação.
     */    
    public function listar_equipamentos(){
        $data["type_section"] = "Equipamentos";
        $this->template->set('title','Gerenciar equipamentos');
        $this->template->set('title_section','Gerenciar equipamentos');
        
        $equipamento = new Equipamento_model();
        $data['equipamentos'] = $equipamento->include_related('categoria','nome',TRUE,TRUE)->include_related('editores','nome',TRUE,TRUE)->get();
        
        $this->template->load('template','listar_equipamentos',$data);
    }
    
    /**
     * Método controlador do CI.
     * 
     * Realiza o update de um equipamento. 
     * Exibe o formulário, faz validação e insere no banco quando possível.
     * 
     * @version 1.0.1
     * @author Vitor Greati <vitorgreati@hotmail.com>
     * @link http://./admin/equips/edit/:num Rota para esta função.
     * @since 1.0.1 Passou a exibir o formulário e realizar validação.
     * @since 1.0.0 Primeira implementação. Apenas realizava o update.
     */
    public function editar_equipamento(){
        $data["type_section"] = "Equipamentos";
        $id = $this->uri->segment(4);
        $e = new Equipamento_model($id);
        
        if($e->exists()){
            if($this->form_validation->run('form_equipamento')==FALSE){
                $this->template->set('title','Editar equipamento');
                $this->template->set('title_section','Editar equipamento');

                $e = new Equipamento_model();
                $categorias = new CategoriaEquipamento_model();

                $data['e'] = $e->where('id',$id)->get();
                $data['categorias'] = $categorias->get(); 
                $this->template->load('template','editar_equip',$data);
            }else{        
                $e = new Equipamento_model($id);
                
                $e->descricao = $this->input->post('descricao');
                $e->fabricante = $this->input->post('fabricante');
                $e->instrucoes = $this->input->post('instrucoes');
                $e->nome = $this->input->post('nome');
                $e->precaucoes = $this->input->post('precaucoes');
                $e->quantidade = $this->input->post('quantidade');
                $e->tombamento = $this->input->post('tombamento');
                $e->save();

                // set the user
                $u = new Usuario_model($this->input->post('usuario_id'));
                $e->save_editores($u);

                // set the category
                $c = new CategoriaEquipamento_model($this->input->post('categoria'));
                $e->save_categoria($c);

                redirect("admin/equips/edit/".$id);
            }
        }else{
            show_404();
        }
    }
    
    /**
     * Método controlador do CI.
     * 
     * Exclui um equipamento quando possível. 
     * 
     * @version 1.0.1
     * @author Vitor Greati <vitorgreati@hotmail.com>
     * @link http://./admin/equips/delete/:num Rota para esta função.
     * @since 1.0.1 Passou a validar a existência do equipamento.
     * @since 1.0.0 Primeira implementação. Apenas realizava o delete.
     */
    public function deletar_equipamento(){
        $id = $this->uri->segment(4);
        $e = new Equipamento_model($id);

        if($e->exists()){
            $e->delete();
        }else{
            show_404();
        }
        
        redirect("admin/equips");
    }
    
    /**
     * Método controlador do CI.
     * 
     * Cria uma reserva para o equipamento. 
     * Exibe o formulário, faz validação e insere no banco quando possível.
     * 
     * @version 1.0.1
     * @author Vitor Greati <vitorgreati@hotmail.com>
     * @link http://./admin/equips/new Rota para esta função.
     * @since 1.0.1 Passou a exibir o formulário e realizar validação.
     * @since 1.0.0 Primeira implementação. Apenas realizava o reserva.
     */    
    public function reservar_equipamento(){
        $data["type_section"] = "Equipamentos";
        $idEquip = $this->uri->segment(5);
        $e = new Equipamento_model($idEquip);
        
        if(($e->exists()) || !$this->uri->segment(5)){      
            if($this->form_validation->run("form_reserva") == FALSE){                  
                // if the request comes from a equipment's view
                $data['id'] = $this->uri->segment(5);

                $this->template->set('title','Reservar equipamento');
                $this->template->set('title_section','Reservar equipamento');

                $equipamento = new Equipamento_model();
                $data['equipamentos'] = $equipamento->get(); 

                $this->template->load('template','reservar_equipamento',$data);
            }else{
                $r = new Reserva_model();
                $r->descricao = $this->input->post('descricao');
                $r->data_inicio = $this->convert_date_format($this->input->post('inicio'),'d/m/Y H:i','Y-m-d H:i:s');
                $r->data_final = $this->convert_date_format($this->input->post('fim'),'d/m/Y H:i','Y-m-d H:i:s');
                
                $e = new Equipamento_model();
                $r2 = new Reserva_model();
                $r2->where_related('equipamento',$e)->get();
                foreach($r2 as $r3){
                    
                }
                
                
                $r->save();

                // set equipamento
                $e = new Equipamento_model();
                $idEquip = $this->input->post('equipamento');
                $e->where('id',$idEquip)->get();
                $r->save_equipamento($e);

                // set the user
                $u = new Usuario_model();
                $u->where('id', $this->ion_auth->user()->row()->id)->get();
                $r->save_usuario($u);

                redirect("equips/$idEquip");    
            }
        }else{
            show_404();
        }  
    }
    
    /**
     * Método controlador do CI.
     * 
     * Realiza o update de uma reserva. 
     * Exibe o formulário, faz validação e insere no banco quando possível.
     * 
     * @version 1.0.1
     * @author Vitor Greati <vitorgreati@hotmail.com>
     * @link http://./admin/equips/edit/:num Rota para esta função.
     * @since 1.0.1 Passou a exibir o formulário e realizar validação.
     * @since 1.0.0 Primeira implementação. Apenas realizava o update.
     */
    public function editar_reserva(){
        $data["type_section"] = "Equipamentos";
        $id = $this->uri->segment(5);
        $r = new Reserva_model($id);
        
        if($r->exists()){
            
            if($this->form_validation->run("form_reserva") == FALSE){
                $this->template->set('title','Editar reserva');
                $this->template->set('title_section','Editar reserva');

                $r = new Reserva_model();

                $equipamento = new Equipamento_model();
                $data['equipamentos'] = $equipamento->get(); 

                $data['r'] = $r->where('id',$id)->include_related('equipamento','*',TRUE,TRUE)->get();

                $data['r']->data_inicio = $this->convert_date_format($data['r']->data_inicio,'Y-m-d H:i:s','d/m/Y H:i');
                $data['r']->data_final = $this->convert_date_format($data['r']->data_final,'Y-m-d H:i:s','d/m/Y H:i');

                $this->template->load('template','editar_reserva',$data);
            }else{
                $r = new Reserva_model($id);

                $r->descricao = $this->input->post('descricao');
                $r->data_inicio = $this->convert_date_format($this->input->post('inicio'),'d/m/Y H:i','Y-m-d H:i:s');
                $r->data_final = $this->convert_date_format($this->input->post('fim'),'d/m/Y H:i','Y-m-d H:i:s');
                $r->save();

                // set equipamento
                $e = new Equipamento_model();
                $e->where('id',$this->input->post('equipamento'))->get();
                $r->save_equipamento($e);

                redirect('equips');
            }
        }else{
            show_404();
        }
    }

    /**
     * Método controlador do CI.
     * 
     * Exibe, em tabela, reservas realizadas.
     * Página oferece opções de editar e excluir reservas. 
     * 
     * @version 1.0.0
     * @author Vitor Greati <vitorgreati@hotmail.com>
     * @link http://./admin/equips Rota para esta função.
     * @since 1.0.0 Primeira implementação.
     */     
    public function listar_reservas(){
        $data["type_section"] = "Equipamentos";

        $this->template->set('title_section','Minhas reservas');
        
        $u = new Usuario_model($this->ion_auth->user()->row()->id); //get the logged
        $r = new Reserva_model();
        
        $data['reservas'] = $r->where_related('usuario',$u)->include_related('equipamento','*', TRUE, TRUE)->get();
        
        $data['now'] = $this->convert_date_format(date("d/m/Y H:i"),'d/m/Y H:i','Y-m-d H:i:s');

        $this->template->load('template','listar_reservas',$data);        
    }
    
    /**
     * Método controlador do CI.
     * 
     * Exclui uma reserva quando possível. 
     * 
     * @version 1.0.1
     * @author Vitor Greati <vitorgreati@hotmail.com>
     * @link http://./admin/equips/delete/:num Rota para esta função.
     * @since 1.0.1 Passou a validar a existência da reserva.
     * @since 1.0.0 Primeira implementação. Apenas realizava o delete.
     */    
    public function deletar_reserva(){
        $id = $this->uri->segment(5);
        $r = new Reserva_model($id);
        
        if($r->exists()){
            $r->delete();
            redirect("admin/reservs");        
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
        $data["type_section"] = "Equipamentos";
        $this->template->set('title','Gerenciar categorias');
        $this->template->set('title_section','Gerenciar categorias');
        $data['objeto'] = "equips";
        
        $c = new CategoriaEquipamento_model();
        $c->distinct();
        $data['cats'] = $c->get();
        
        $data['c'] = new CategoriaEquipamento_model();
        
        if($this->form_validation->run("form_categoria") == TRUE){
            $c = new CategoriaEquipamento_model();
            $c->nome = $this->input->post("nome");
            $c->descricao = $this->input->post("descricao");
            $c->save();
            redirect("admin/equips/cats");
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
        $data["type_section"] = "Equipamentos";        
        $this->template->set('title','Gerenciar categorias');
        $this->template->set('title_section','Gerenciar categorias');
        $data['objeto'] = "equips";
        
        $c = new CategoriaEquipamento_model();
        $data['cats'] = $c->get();
        
        $id = $this->uri->segment(4);
        
        //se é uma edição de categoria
        if(isset($id)){
            $c = new CategoriaEquipamento_model($id);
            if($c->exists()){
                if($this->form_validation->run("form_categoria") == FALSE){
                    $data['c'] = $c;
                    $this->template->load("template","gerenciar_cat_equips", $data);
                }else{
                    $c->nome = $this->input->post("nome");
                    $c->descricao = $this->input->post("descricao");
                    $c->save();
                    redirect("admin/equips/cats");
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
        $c = new CategoriaEquipamento_model($id);
        
        if($c->exists()){
            $c->delete();
            redirect("admin/equips/cats");
        }else{
            show_404();
        }
    }
    
    function convert_date_format($strdate, $old_format, $new_format){
        return date_format(date_create_from_format($old_format, $strdate),$new_format);
    }
    
//    
//    //Efetuar publicação de tutoriais
//    public function show_publicar_tutorial(){
//        $this->template->set('title','Publicar tutorial');
//        $this->template->set('title_section','Criar tutorial');
//        
//        $categorias = new CategoriaTutorial_model();
//        $data['categorias'] = $categorias->get(); 
//        
//        $this->template->load('template','criar_tutorial',$data);
//    }
//    
//    public function publicar_tutorial(){
//        $t = new Tutorial_model();
//        $t->titulo = $this->input->post('titulo');
//        $t->texto = $this->input->post('texto');
//        $t->save();
//        
//        // set the user
//        $u = new Usuario_model();
//        $u->where('id', $this->input->post('usuario_id'))->get();
//        $t->save_editores($u);
//        
//        // set the category
//        $c = new CategoriaTutorial_model();
//        $c->where('nome',$this->input->post('categoria'))->get();
//        $t->save_categoria($c);
//        
//        redirect("admin/tuts");
//    }
//    
//    public function show_gerenciar_tutoriais(){
//        $this->template->set('title','Gerenciar tutoriais');
//        $this->template->set('title_section','Gerenciar tutoriais');
//        
//        $tutorial = new Tutorial_model();
//        $data = array(
//            'tutoriais' => $tutorial->include_related('categoria','nome', TRUE, TRUE)->include_related('editores','nome',TRUE,TRUE)->get()
//        );
//        
//        $this->template->load('template','listar_tutoriais',$data);
//    }
//    
//        // Edita um equipamento
//    public function show_editar_tutorial(){
//        $this->template->set('title','Editar tutorial');
//        $this->template->set('title_section','Editar tutorial');
//        
//        $id = $this->uri->segment(4);
//        
//        $t = new Tutorial_model();
//        $categorias = new CategoriaTutorial_model();
//        
//        $data['t'] = $t->where('id',$id)->get();
//        $data['categorias'] = $categorias->get(); 
//        $this->template->load('template','editar_tutorial',$data);
//    }
//    
//    public function editar_tutorial(){
//        $id = $this->input->post('id');
//        
//        $t = new Tutorial_model();
//        
//        $t->where('id',$id)->get();
//        
//        $t->titulo = $this->input->post('titulo');
//        $t->texto = $this->input->post('texto');
//        $t->save();
//        
//        // set the user
//        $u = new Usuario_model();
//        $u->where('id', $this->input->post('usuario_id'))->get();
//        $t->save_editores($u);
//        
//        // set the category
//        $c = new CategoriaTutorial_model();
//        $c->where('nome',$this->input->post('categoria'))->get();
//        $t->save_categoria($c);
//        
//        redirect("admin/tuts/edit/".$id);
//    }
//    
//    //Excluir equipamento
//    public function deletar_tutorial(){
//        $id = $this->uri->segment(4);
//        $t = new Tutorial_model();
//        $t->where('id',$id)->get();
//        $t->delete();
//        
//        redirect("admin/tuts");
//    }
//    
//    // Cadastrar ambiente
//    public function show_cadastrar_ambiente(){
//        $this->template->set('title_section','Novo ambiente');
//        
//        $c = new CategoriaAmbiente_model();
//        $data['categorias'] = $c->get();
//        
//        $this->template->load('template','cadastrar_ambiente',$data);
//    }
//    
//    public function cadastrar_ambiente(){
//        $a = new Ambiente_model();
//        
//        $a->nome = $this->input->post('nome');
//        $a->descricao = $this->input->post('descricao');
//        
//        // set the category
//        $c = new CategoriaAmbiente_model();
//        $c->where('nome',$this->input->post('categoria'))->get();
//        $a->save_categoria($c);
//        
//        $a->save();
//    }
//    
//    // Gerenciar ambientes
//    public function show_gerenciar_ambientes(){
//        $this->template->set('title_section','Gerenciar ambientes');
//        
//        $a = new Ambiente_model();
//        $data['ambientes'] = $a->include_related('categoria','nome',TRUE,TRUE)->get();
//        
//        $this->template->load('template','listar_ambientes',$data);
//    }
//    
//    // Editar ambiente
//    public function show_editar_ambiente(){
//        $id = $this->uri->segment(4);
//        
//        $a = new Ambiente_model($id);
//        
//        $data['error'] = '';
//        
//        $this->template->set('title_section','Editar ambiente');
//        
//        $c = new CategoriaAmbiente_model();
//        $data['categorias'] = $c->get();
//        
//        $l = new Localizacao_model();
//        $data['localizacoes'] = $l->where_related('ambiente',$a)->get();
//        
//        $data['a'] = $a;
//        
//        $this->load->helper('form');
//        
//        $this->template->load('template','editar_ambiente',$data);        
//    }
//    
//    public function editar_ambiente(){
//        $id = $this->uri->segment(4);
//        
//        $this->load->helper('form');
//        
//        $a = new Ambiente_model($id);
//        
//        $a->nome = $this->input->post('nome');
//        $a->descricao = $this->input->post('descricao');
//        
//        // set the category
//        $c = new CategoriaAmbiente_model();
//        $c->where('nome',$this->input->post('categoria'))->get();
//        $a->save_categoria($c);
//        
//        $a->save();
//
//        //do upload
//        $config['upload_path'] = './assets/images/ambs';
//        $config['file_name'] = "$id.jpg";
//        $config['override'] = TRUE;
//        $config['allowed_types'] = 'gif|jpg|png';
//        $config['max_width'] = '2048';
//        $config['max_height'] = '2048';
//
//        $this->load->library('upload');
//        $this->upload->initialize($config);
//        $this->upload->do_upload();
//        
//        redirect("admin/ambs");
//    }
//    
//    public function deletar_ambiente(){
//        $id = $this->uri->segment(4);
//        $e = new Ambiente_model();
//        $e->where('id',$id)->get();
//        $e->delete();
//        
//        redirect("admin/ambs");    
//    }
//    
//    public function cadastrar_localizacao(){
//
//        $l = new Localizacao_model();
//        
//        $l->ratioX = $this->input->post('ratioX');
//        $l->ratioY = $this->input->post('ratioY');
//        $l->nome = $this->input->post('nome');
//        $l->descricao = $this->input->post('descricao');
//        
//        $a = new Ambiente_model($this->uri->segment(3));
//        $l->save_ambiente($a);
//        
//        $idEquips = $this->input->post('equips');
//        $equips = array();
//        
//        foreach($idEquips as $idEquip){
//            $equips[] = new Equipamento_model($idEquip);
//        }
//        
//        $l->save_equipamentos($equips);
//        
//        $l->save();
//        echo 1;
//    }
//    
//    public function show_editar_localizacao(){
//        $id = $this->uri->segment(6);
//        
//        $this->template->set('title_section','Editar localização');
//        
//        $l = new Localizacao_model($id);
//        $e = new Equipamento_model();
//        
//        $data['l'] = $l->include_related('ambiente','*',TRUE,TRUE)->get_where(array('id'=>$id));
//        
//        $data['equipsRelated'] = $e->where_related('localizacoes',new Localizacao_model($id))->get();
//        
//        $e = new Equipamento_model();
//        $data['equipamentos'] = $e->get();
//        
//        $this->template->load('template','editar_localizacao',$data);        
//    }
//    
//    public function editar_localizacao(){
//        
//        $l = new Localizacao_model($this->uri->segment(6));
//
//        $l->nome = $this->input->post('nome');
//        $l->descricao = $this->input->post('descricao');
//        
//        $idEquips = $this->input->post('equips');
//        $equips = array();
//        
//        foreach($l->equipamentos->get() as $e){
//            $l->delete_equipamentos($e);
//        }
//        
//        foreach($idEquips as $idEquip){
//            $equips[] = new Equipamento_model($idEquip);
//        }
//        
//        $l->save_equipamentos($equips);
//        
//        $l->save();
//        echo 1;
//    }
//    
//    public function excluir_localizacao(){
//        $l = new Localizacao_model($this->uri->segment(6));
//        $l->delete();
//        redirect("/admin/ambs/edit/".$this->uri->segment(3));
//    }
//    
}

/* End of file Admin_controller.php */
/* Location: ./application/controller/Admin_controller.php */
