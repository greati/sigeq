<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "welcome";
$route['404_override'] = '';
$route['sobre'] = 'Public_controller/sobre';
$route['contato'] = 'Public_controller/contato';
$route['busca'] = 'Public_controller/busca';

//usuário
$route['admin/users'] = 'AdminUser_controller/listar_usuarios';
$route['admin/users/edit/:num'] = 'AdminUser_controller/editar_usuario';
$route['admin/users/delete/:num'] = 'AdminUser_controller/deletar_usuario';
$route['admin/users/new'] = 'AdminUser_controller/cadastrar_usuario';
$route['users'] = 'Public_controller/listar_usuarios';

//equipamento
$route['admin/equips/new'] = "AdminEquip_controller/cadastrar_equipamento";
$route['admin/equips'] = "AdminEquip_controller/listar_equipamentos";
$route['admin/equips/edit/:num'] = "AdminEquip_controller/editar_equipamento";
$route['admin/equips/delete/:num'] = "AdminEquip_controller/deletar_equipamento";
$route['admin/equips/cats'] = "AdminEquip_controller/criar_categorias";
$route['admin/equips/cats/:num'] = "AdminEquip_controller/editar_categorias";
$route['admin/equips/cats/delete/:num'] = "AdminEquip_controller/deletar_categoria";

//reservas
$route['admin/equips/reservs/new'] = "AdminEquip_controller/reservar_equipamento";
$route['admin/equips/reservs/new/:num'] = "AdminEquip_controller/reservar_equipamento";
$route['admin/equips/reservs/edit/:num'] = "AdminEquip_controller/editar_reserva";
$route['admin/equips/reservs/delete/:num'] = "AdminEquip_controller/deletar_reserva";
$route['equips/reservs/:num'] = "Public_controller/ver_reserva";
$route['admin/reservs'] = "AdminEquip_controller/listar_reservas";

$route['equips'] = "Public_controller/listar_equipamentos";
$route['equips/list/ajax'] = "Public_controller/listar_equipamentos_ajax";

$route['equips/:num'] = "Public_controller/ver_equipamento";

//tutoriais
$route['admin/tuts/new'] = "AdminTut_controller/publicar_tutorial";
$route['admin/tuts'] = "AdminTut_controller/listar_tutoriais";
$route['admin/tuts/edit/:num']="AdminTut_controller/editar_tutorial";
$route['admin/tuts/delete/:num']="AdminTut_controller/deletar_tutorial";
$route['admin/tuts/cats'] = "AdminTut_controller/criar_categorias";
$route['admin/tuts/cats/:num'] = "AdminTut_controller/editar_categorias";
$route['admin/tuts/cats/delete/:num'] = "AdminTut_controller/deletar_categoria";


$route['tuts'] = "Public_controller/listar_tutoriais";
$route['tuts/:num'] = "Public_controller/ver_tutorial";

// ambientes
$route['admin/ambs/new'] = "AdminAmb_controller/cadastrar_ambiente";
$route['admin/ambs'] = "AdminAmb_controller/listar_ambientes";
$route['admin/ambs/delete/:num'] = "AdminAmb_controller/deletar_ambiente";
$route['admin/ambs/edit/:num'] = "AdminAmb_controller/editar_ambiente";
$route['admin/ambs/cats'] = "AdminAmb_controller/criar_categorias";
$route['admin/ambs/cats/:num'] = "AdminAmb_controller/editar_categorias";
$route['admin/ambs/cats/delete/:num'] = "AdminAmb_controller/deletar_categoria";

$route['ambs'] = "Public_controller/listar_ambientes";
$route['ambs/:num'] = "Public_controller/ver_ambiente";

//locs
$route['admin/ambs/:num/locs/new/ajax'] = "AdminAmb_controller/cadastrar_localizacao";
$route['admin/ambs/:num/locs/edit/:num'] = "AdminAmb_controller/show_editar_localizacao";
$route['admin/ambs/:num/locs/edit/:num/ajax'] = "AdminAmb_controller/editar_localizacao";
$route['admin/ambs/:num/locs/delete/:num'] = "AdminAmb_controller/excluir_localizacao";
$route['ambs/:num/locs/:num'] = "Public_controller/ver_localizacao";

// perfil
$route['user/edit'] = "User_controller/show_editar_perfil";
$route['user/edit/do'] = "User_controller/editar_perfil";
$route['users/:num'] = "Public_controller/ver_perfil";

//login
$route['login'] = "auth/login";
$route['forgot'] = "auth/forgot_password";
$route['change-password'] = "auth/change_password";
$route['deactivate'] = "auth/deactivate";
$route['activate'] = "auth/activate";
$route['user/logout'] = "User_controller/logout";



/* End of file routes.php */
/* Location: ./application/config/routes.php */