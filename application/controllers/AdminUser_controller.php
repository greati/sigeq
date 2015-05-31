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
class AdminUser_controller extends CI_Controller{
        
    function __construct(){
        parent::__construct();
        $this->form_validation->set_error_delimiters('<p class="error">', '</p>');
        if(!$this->ion_auth->in_group('g_usu')){
            //show_error("Você não é Gerente de Usuários.");
            redirect('login');
        }
       
    }
    
    public function index(){
        echo 'Hello world!';
    }
    
    /**
     * Método controlador do CI.
     * 
     * Realiza o cadastro de um usuário. 
     * Exibe o formulário, faz validação e insere no banco quando possível.
     * 
     * @version 1.0.1
     * @author Vitor Greati <vitorgreati@hotmail.com>
     * @link http://./admin/users/new Rota para esta função.
     * @since 1.0.1 Passou a exibir o formulário e realizar validação.
     * @since 1.0.0 Primeira implementação. Apenas realizava o cadastro.
     */
    public function cadastrar_usuario(){
        $data["type_section"] = "Usuários";
        // if the user's inputs are wrong
        if($this->form_validation->run('cadastrar_usuario') == FALSE){
            // load page elements
            $this->template->set('title','Cadastrar usuário');
            $this->template->set('title_section','Cadastrar usuário');
            $this->template->load('template','cadastrar_usuario', $data);
        // if the inputs are right    
        }else{
            // required
            $username = $this->input->post('login');
            $password = $this->input->post('senha');
            $email = $this->input->post('email');
            //additional data
            $nome = $this->input->post('nome');
            $additional_data = array(
                'nome' => $nome
            );
            // roles
            $groups = $this->input->post('autoridade');
            // inserting in the db
            $this->ion_auth->register($username,$password,$email,$additional_data,$groups);
            redirect("admin/users");
        }
    }
    
    /**
     * Verifica a existência de um username.
     * Usado pelos métodos 'cadastrar_usuario', 'editar_usuario'.
     * 
     * @version 1.0.0
     * @author Vitor Greati <vitorgreati@hotmail.com>
     * @since 1.0.0 Implementado pela primeira vez.
     * 
     * @param string username O username a ser checado.
     * @return boolean FALSE se o username existe, TRUE se não existe.
     */
    public function checar_username($username){
        $u = new Usuario_model();
        $u->where('username',$username)->get();
        if($u->exists()){
            $this->form_validation->set_message('checar_username',"O login '$username' já existe. Escolha outro.");
            return FALSE;
        }else{
            return TRUE;
        }
    }
    
    /**
     * Método controlador do CI.
     * 
     * Exibe, em tabela, usuários cadastrados no sistema.
     * Página oferece opções de editar e excluir usuários. 
     * 
     * @version 1.0.0
     * @author Vitor Greati <vitorgreati@hotmail.com>
     * @link http://./admin/users Rota para esta função.
     * @since 1.0.0 Primeira implementação.
     */
    public function listar_usuarios(){
        $this->template->set('title','Gerenciar usuários');
        $this->template->set('title_section','Gerenciar usuários');
        
        $usuario = new Usuario_model();
        $autoridade = new Autoridade_model();
        $data = array(
            'usuarios' => $usuario->get()
        );
        $data["type_section"] = "Usuários";
        $this->template->load('template','listar_usuarios',$data);
    }
    
     /**
     * Método controlador do CI.
     * 
     * Realiza o update de um usuário. 
     * Exibe o formulário, faz validação e insere no banco quando possível.
     * 
     * @version 1.0.1
     * @author Vitor Greati <vitorgreati@hotmail.com>
     * @link http://./admin/users/edit/:num Rota para esta função.
     * @since 1.0.1 Passou a exibir o formulário e realizar validação.
     * @since 1.0.0 Primeira implementação. Apenas realizava o update.
     */
    public function editar_usuario(){
        $data["type_section"] = "Usuários";
        $id = $this->uri->segment(4);

        $u = new Usuario_model($id);        
        if($u->exists()){
            if($this->form_validation->run('editar_usuario') == FALSE){
                $this->template->set('title','Editar perfil');
                $this->template->set('title_section','Editar usuário');
                $u->data_nascimento = $this->convert_date_format($u->data_nascimento,'Y-m-d','d/m/Y');
                $data["u"] = $u;
                $this->template->load('template','editar_perfil',$data);
            }else{
                $data = array(
                    'nome' => $this->input->post('nome'),
                    'is_publico' => TRUE ? (int)$this->input->post('is_publico')==1 : FALSE,
                    'email' => $this->input->post('email'),
                    'descricao' => $this->input->post('descricao'),
                    'data_nascimento' =>$this->convert_date_format($this->input->post('data_nascimento'),'d/m/Y','Y-m-d'),
                    'celular' => $this->input->post('celular'),
                    'telefoneFixo' => $this->input->post('telefoneFixo'),
                    'rua' => $this->input->post('rua'),
                    'numeroCasa' => $this->input->post('numeroCasa'),
                    'bairro' => $this->input->post('bairro'),
                    'estado' => $this->input->post('estado'),
                    'cidade' => $this->input->post('cidade'),
                    'cep' => $this->input->post('cep')
                );
                // 
                $this->ion_auth->update($this->uri->segment(4),$data);
                redirect("admin/users");
            }
        }else{
            show_404();
        }
    }
    
     /**
     * Método controlador do CI.
     * 
     * Exclui um usuário quando possível. 
     * 
     * @version 1.0.1
     * @author Vitor Greati <vitorgreati@hotmail.com>
     * @link http://./admin/users/delete/:num Rota para esta função.
     * @since 1.0.1 Passou a validar a existência do usuário.
     * @since 1.0.0 Primeira implementação. Apenas realizava o delete.
     */
    public function deletar_usuario(){
        $id = $this->uri->segment(4);
        $u = new Usuario_model($id);
        
        if($u->exists()){
            $u->delete();
            redirect("admin/users");
        }else{
            show_404();
        }
    }
//    
//    // Mostra cadastro de equipamentos
//    public function show_cadastrar_equipamento(){
//
//        $this->template->set('title','Cadastrar equipamento');
//        $this->template->set('title_section','Cadastrar equipamento');
//       
//        $categorias = new CategoriaEquipamento_model();
//        $data['categorias'] = $categorias->get();   
//        
//        $this->template->load('template','cadastrar_equip',$data);
//        
//    }
//    
//    // Efetua cadastro do equipamento
//    public function cadastrar_equipamento(){
//        
//        // create the equip
//        $e = new Equipamento_model();
//        $e->descricao = $this->input->post('descricao');
//        $e->fabricante = $this->input->post('fabricante');
//        $e->instrucoes = $this->input->post('instrucoes');
//        $e->nome = $this->input->post('nome');
//        $e->precaucoes = $this->input->post('precaucoes');
//        $e->quantidade = $this->input->post('quantidade');
//        $e->tombamento = $this->input->post('tombamento');
//        $e->save();
//        
//        // set the user
//        $u = new Usuario_model();
//        $u->where('id', $this->input->post('usuario_id'))->get();
//        $e->save_editores($u);
//        
//        // set the category
//        $c = new CategoriaEquipamento_model();
//        $c->where('nome',$this->input->post('categoria'))->get();
//        $e->save_categoria($c);
//        
//        redirect("admin/equips");
//    }
//    
//    // Mostra lista de equipamento
//    public function show_gerenciar_equipamentos(){
//        $this->template->set('title','Gerenciar equipamentos');
//        $this->template->set('title_section','Gerenciar equipamentos');
//        
//        $equipamento = new Equipamento_model();
//        $data['equipamentos'] = $equipamento->include_related('categoria','nome',TRUE,TRUE)->include_related('editores','nome',TRUE,TRUE)->get();
//        
//        $this->template->load('template','listar_equipamentos',$data);
//    }
//    
//    // Mostra formulário para reserva    
//    public function show_reservar_equipamento(){
//                
//        // if the request comes from a equipment's view
//        $data['id'] = $this->uri->segment(5);
//        
//        $this->template->set('title','Reservar equipamento');
//        $this->template->set('title_section','Reservar equipamento');
//        
//        $equipamento = new Equipamento_model();
//        $data['equipamentos'] = $equipamento->get(); 
//        
//        $this->template->load('template','reservar_equipamento',$data);
//    }
//    
    function convert_date_format($strdate, $old_format, $new_format){
        return date_format(date_create_from_format($old_format, $strdate),$new_format);
    }
//    
//    // Reservar equipamento
//    public function reservar_equipamento(){
//        
//        $r = new Reserva_model();
//        $r->descricao = $this->input->post('descricao');
//        $r->data_inicio = $this->convert_date_format($this->input->post('inicio'),'d/m/Y H:i','Y-m-d H:i:s');
//        $r->data_final = $this->convert_date_format($this->input->post('fim'),'d/m/Y H:i','Y-m-d H:i:s');
//        $r->save();
//        
//        // set equipamento
//        $e = new Equipamento_model();
//        $e->where('id',$this->input->post('equipamento'))->get();
//        $r->save_equipamento($e);
//        
//        // set the user
//        $u = new Usuario_model();
//        $u->where('id', 1)->get();//$this->ion_auth->user()->row()->id)->get();
//        $r->save_usuario($u);
//        
//        redirect("admin/equips");
//    }
//    
//    public function show_editar_reserva(){
//        $this->template->set('title','Editar reserva');
//        $this->template->set('title_section','Editar reserva');
//        
//        $id = $this->uri->segment(5);
//        
//        $r = new Reserva_model();
//
//        $equipamento = new Equipamento_model();
//        $data['equipamentos'] = $equipamento->get(); 
//        
//        $data['r'] = $r->where('id',$id)->include_related('equipamento','*',TRUE,TRUE)->get();
//        
//        $data['r']->data_inicio = $this->convert_date_format($data['r']->data_inicio,'Y-m-d H:i:s','d/m/Y H:i');
//        $data['r']->data_final = $this->convert_date_format($data['r']->data_final,'Y-m-d H:i:s','d/m/Y H:i');
//        
//        $this->template->load('template','editar_reserva',$data);
//    }
//    
//    public function editar_reserva(){
//
//        $id = $this->uri->segment(5);
//        
//        $r = new Reserva_model($id);
//        
//        $r->descricao = $this->input->post('descricao');
//        $r->data_inicio = $this->convert_date_format($this->input->post('inicio'),'d/m/Y H:i','Y-m-d H:i:s');
//        $r->data_final = $this->convert_date_format($this->input->post('fim'),'d/m/Y H:i','Y-m-d H:i:s');
//        $r->save();
//        
//        // set equipamento
//        $e = new Equipamento_model();
//        $e->where('id',$this->input->post('equipamento'))->get();
//        $r->save_equipamento($e);
//        
//        redirect('admin/equips');
//    }
//    
//
//    // Edita um equipamento
//    public function show_editar_equipamento(){
//        $this->template->set('title','Editar equipamento');
//        $this->template->set('title_section','Editar equipamento');
//        
//        $id = $this->uri->segment(4);
//        
//        $e = new Equipamento_model();
//        $categorias = new CategoriaEquipamento_model();
//        
//        $data['e'] = $e->where('id',$id)->get();
//        $data['categorias'] = $categorias->get(); 
//        $this->template->load('template','editar_equip',$data);
//    }
//    
//    public function editar_equipamento(){
//        $id = $this->input->post('id');
//        
//        $e = new Equipamento_model();
//        
//        $e->where('id',$id)->get();
//        
//        $e->descricao = $this->input->post('descricao');
//        $e->fabricante = $this->input->post('fabricante');
//        $e->instrucoes = $this->input->post('instrucoes');
//        $e->nome = $this->input->post('nome');
//        $e->precaucoes = $this->input->post('precaucoes');
//        $e->quantidade = $this->input->post('quantidade');
//        $e->tombamento = $this->input->post('tombamento');
//        $e->save();
//      
//        // set the user
//        $u = new Usuario_model();
//        $u->where('id', $this->input->post('usuario_id'))->get();
//        $e->save_editores($u);
//        
//        // set the category
//        $c = new CategoriaEquipamento_model();
//        $c->where('nome',$this->input->post('categoria'))->get();
//        $e->save_categoria($c);
//        
//        redirect("admin/equips/edit/".$id);
//    }
//    
//    //Excluir equipamento
//    public function deletar_equipamento(){
//        $id = $this->uri->segment(4);
//        $e = new Equipamento_model();
//        $e->where('id',$id)->get();
//        $e->delete();
//        
//        redirect("admin/equips");
//    }
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
//    
}
    
/* End of file AdminUser_controller.php */
/* Location: ./application/controller/AdminUser_controller.php */
