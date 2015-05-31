<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
            $this->template->set('is_index',TRUE);
            
            $this->template->set('title_section','Bem-vindo');
            $this->template->set('title','SIGEQ - Sistema Gerenciador de Equipamentos');
            
            $e = new Equipamento_model();
            $data['equips'] = $e->include_related('categoria','*', TRUE, TRUE)->get_paged(1,5);
            
            $t = new Tutorial_model();
            $data['tuts'] = $t->get_paged(1,5);
            
            $r = new Reserva_model();
            $data['reservas'] = $r->include_related('usuario','*',TRUE,TRUE)->include_related('equipamento','*', TRUE, TRUE)->get_paged(1,5);
            
            $a = new Ambiente_model();
            $data['ambs'] = $a->get();
            
            $data["type_section"] = "Sistema Gerenciador de Equipamentos";
            $data["not_appear_page_title"] = TRUE;
            $this->template->load('template','index',$data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */