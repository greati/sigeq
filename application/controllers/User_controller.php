<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User_controller
 *
 * @author Vitor
 */
class User_controller extends CI_Controller{
    
    function __construct() {
        parent::__construct();
    }
    
    public function index(){
        echo 'Hello, World';
    }
    
    public function show_login(){
        $this->template->set('title','Login');
        $data["is_login_page"] = TRUE;
        $this->template->load('template','auth/login', $data);
    }
    
    // login
    public function login(){
        
        $login = $this->input->post('login');
        $password = $this->input->post('password');
        $remember = $this->input->post('remember');
        
        $remember = TRUE ? ((int) $remember == 1) : FALSE;
        
        if($this->ion_auth->login($login,$password,$remember)){
            redirect('http://localhost/SIGEQWebApp/index.php/','refresh');
        }
    }
    
    // logout
    
    public function logout(){
        $this->ion_auth->logout();
        redirect("index.php");
    }

    // show the form
    public function show_editar_perfil(){
        $this->template->set('title','Atualizar perfil');
        $this->template->set('title_section','Atualizar perfil');
        
        $data = array(
            'nome' => $this->ion_auth->user()->row()->nome,
            'is_publico' => TRUE,//$this->ion_auth->user()->row()->is_publico,
            'email' => $this->ion_auth->user()->row()->email,
            'descricao' => $this->ion_auth->user()->row()->descricao
        );
        
        $data["u"] = $this->ion_auth->user()->row();
        $data["type_section"] = "Usuários";
        $this->template->load('template','editar_perfil',$data);
        
    }
    
    // perform update
    public function editar_perfil(){
        $data = array(
            'nome' => $this->input->post('nome'),
            'is_publico' => TRUE ? (int)$this->input->post('is_publico')==1 : FALSE,
            'email' => $this->input->post('email'),
            'descricao' => $this->input->post('descricao')
        );
        $data["type_section"] = "Usuários";
        $this->ion_auth->update($this->ion_auth->user()->row()->id,$data);
        redirect("user/edit");
    }
    
}
/* End of file User_controller.php */
/* Location: ./application/controller/User_controller.php */