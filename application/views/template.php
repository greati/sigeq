<!DOCTYPE html>
<html lang="en">

	<head>
		<!-- title max 64 chars -->
		<title><?= $title ?></title>
		<!-- UTF-8 is the most used -->
		<meta charset="UTF-8">
		<!-- viewport makes the site responsive -->
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<!-- site's stylesheets -->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/reset.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/admin.css">
		<link rel="stylesheet" href="<?php echo base_url();?>assets/fonts/font-awesome/css/font-awesome.min.css">
		<!-- js scripts -->
		<script src="http://code.jquery.com/jquery-1.11.2.min.js" type="text/javascript"></script>
                <script src="<?php echo base_url() ?>assets/js/jquery.maskedinput.min.js" type="text/javascript"></script>
		<script src="<?php echo base_url();?>assets/js/admin.js" type="text/javascript"></script>
		<!-- adding support to HTML5 in older browsers -->
		<!--[if lt IE 9]>
			<script src="js/html5shiv.min.js"></script>
		<![endif]-->
	</head>

	<body>
		<!-- whole page container -->
		<div id="page">
                    <!-- this wrapper is for sticky footer -->
                    <div id="wrapper">
			<!-- page's header -->
			<header id="page-header" role="banner">
				<div class="header-no-nav row">
					<!-- logo -->
					<h1 id="logo">
						<a href="#">
							<img src="<?php echo base_url();?>assets/images/logo-wit.png" alt="Logomarca SIGEQ"/>
						</a>
					</h1>
					<!-- nav infos -->
					<nav id="info-nav" role="navigation">
						<ul>
							<li><a href="<?php echo base_url(); ?>">Início</a></li>
							<li><a href="<?php echo base_url(); ?>sobre">Sobre</a></li>
							<li><a href="<?php echo base_url(); ?>contato">Contato</a></li>
						</ul>
					</nav>
					<!-- search bar -->
					<form id="header-search-form" method="get" action="<?php echo base_url() ?>busca">
						<input type="text" name="q" placeholder="Digite um termo">
						<button>Buscar</button>
					</form>
                                        <?php if($this->ion_auth->logged_in()){ ?>
                                                <!-- logged user panel -->
                                                <div id="logged-user-panel">
                                                        <!-- logged user avatar -->
                                                        <img id="logged-user-avatar" 
                                                             src="<?php echo base_url();?>assets/images/usuarios/<?php echo $this->ion_auth->user()->row()->id ?>.jpg" 
                                                             alt="Avatar: <?php $this->ion_auth->user()->row()->username ?>"/>
                                                        <!-- grouping logged user info -->
                                                        <div id="logged-user-info">
                                                                <span id="logged-user-username"><?php echo $this->ion_auth->user()->row()->username?></span>
                                                                <!-- grouping logged user painel actions -->
                                                                <div id="logged-user-actions">
                                                                        <a href="<?php echo base_url() ?>users/<?php echo $this->ion_auth->user()->row()->id ?>">Perfil</a>
                                                                        <a href="<?php echo base_url() ?>user/logout">Logout</a>
                                                                </div>
                                                        </div>
                                                </div>
                                        <?php } else { ?>
                                                <!-- non-logged menu -->
                                                <div id="unlogged-user-panel">
                                                    <a href="<?php echo base_url(); ?>login"><i class="fa fa-user"></i>Login</a>
                                                </div>
                                        <?php } ?>
				</div>
				<!-- main nav -->
				<nav id="main-nav" role="navigation">
					<ul>
						<li>
							<a class="bt-menu" href="<?php echo base_url(); ?>ambs">
								<span><i class="fa fa-map-marker"></i>Ambientes</span>
								<span class="menu-desc">Visite os locais que guardam os equipamentos.</span>
							</a>
						</li>
						<li>
                                                        <a class="bt-menu has-submenu" href="<?php echo base_url(); ?>equips">
								<span><i class="fa fa-cut"></i>Equips</span>
								<span class="menu-desc">Consulte o acervo de equipamentos.</span>
							</a>
						</li>
						<li>
							<a class="bt-menu  has-submenu" href="<?php echo base_url(); ?>tuts">
								<span><i class="fa fa-file-text"></i>Tutoriais</span>
								<span class="menu-desc">Aprenda técnicas, métodos e modos de operação.</span>
							</a>
						</li>
						<li>
							<a class="bt-menu" href="<?php echo base_url(); ?>users">
								<span><i class="fa fa-users"></i>Usuários</span>
								<span class="menu-desc">Encontre informações dos usuários do sistema.</span>
							</a>
						</li>
					</ul>
				</nav>

				<span id="page-title"><?= $type_section ?><i class="fa fa-caret-down page-title-arrow"></i></span>

			</header>

			<!-- page's main -->
			<div id="page-main" role="main">
                            <?php if(!isset($not_appear_page_title)) {?>
                                <h3 class="page-main-title"><?= $title_section ?></h3>
                            <?php }?>
                            <div class="clear"></div>
                            <?= $contents ?>
                            <div class="clear"></div>
			</div>

			<!-- page's sidebar -->
			<aside id="page-sidebar" role="complementary">
                            <?php if(!$this->ion_auth->logged_in() && !isset($is_login_page)){ ?>
                                <section class="sidebar-login">
                                    <h2>Acesso</h2>
                                    <form method="post" action="login">
                                        <div id="infoMessage"><?php if(isset($message)) echo $message;?></div>
                                        <input type="text" placeholder="Login" name="identity"/>
                                        <input type="password" placeholder="Senha" name="password"/>
                                        <fieldset class="bts">
                                            <label><input type="checkbox" name="remember"/>Lembre-me</label>
                                            <button>Entrar</button>
                                        </fieldset>
                                    </form>
                                </section>
                            <?php }else if($this->ion_auth->logged_in()){ ?>
                                <section class="sidebar-menu-logged">
                                    <h2>Suas ações</h2>
                                    <nav>
                                            <ul>
                                                <?php if($this->ion_auth->in_group("u_lab")){?>
                                                    <li><a href="<?php echo base_url(); ?>admin/reservs"><i class="fa fa-user"></i>Ver reservas</a></li>
                                                    <li><a href="<?php echo base_url(); ?>user/edit"><i class="fa fa-user"></i>Editar perfil</a></li>
                                                <?php }?>
                                                
                                                <?php if($this->ion_auth->in_group("g_equips")){?>
                                                    <li><a href="<?php echo base_url(); ?>admin/equips/new"><i class="fa fa-cut"></i>Cadastrar equipamento</a></li>
                                                    <li><a href="<?php echo base_url(); ?>admin/equips"><i class="fa fa-cut"></i>Gerenciar equipamentos</a></li>
                                                    <li><a href="<?php echo base_url(); ?>admin/equips/cats"><i class="fa fa-cut"></i>Gerenciar categorias</a></li>
                                                <?php }?>

                                                <?php if($this->ion_auth->in_group("g_usu")){?>
                                                    <li><a href="<?php echo base_url(); ?>admin/users/new"><i class="fa fa-users"></i>Cadastrar usuário</a></li>
                                                    <li><a href="<?php echo base_url(); ?>admin/users"><i class="fa fa-users"></i>Gerenciar usuários</a></li>            
                                                <?php }?>
                                                
                                                <?php if($this->ion_auth->in_group("g_tut")){?>
                                                    <li><a href="<?php echo base_url(); ?>admin/tuts/new"><i class="fa fa-file-text"></i>Publicar tutorial</a></li>
                                                    <li><a href="<?php echo base_url(); ?>admin/tuts"><i class="fa fa-file-text"></i>Gerenciar tutoriais</a></li>
                                                    <li><a href="<?php echo base_url(); ?>admin/tuts/cats"><i class="fa fa-file-text"></i>Gerenciar categorias</a></li>
                                                <?php }?>
                                                
                                                <?php if($this->ion_auth->in_group("g_amb")){?>
                                                    <li><a href="<?php echo base_url(); ?>admin/ambs/new"><i class="fa fa-map-marker"></i>Cadastrar ambiente</a></li>
                                                    <li><a href="<?php echo base_url(); ?>admin/ambs"><i class="fa fa-map-marker"></i>Gerenciar ambientes</a></li>
                                                    <li><a href="<?php echo base_url(); ?>admin/ambs/cats"><i class="fa fa-map-marker"></i>Gerenciar categorias</a></li>
                                                <?php }?>
                                            </ul>
                                    </nav>
                                </section>
                            <?php } ?>
                            <?php if(isset($is_index) || isset($is_login_page)){ ?>
                                <?php 
                                    $u = new Usuario_model();
                                    $admins = $this->ion_auth->users(array(1, 2, 3))->result();
                                ?>
                                <section class="sidebar-admins">
                                        <h2>Administradores</h2>
                                        <table>
                                                <?php foreach($admins as $a) {?>
                                                    <tr>
                                                        <td>
                                                            <img 
                                                             src="<?php echo base_url();?>assets/images/usuarios/<?php echo $a->id ?>.jpg" 
                                                             alt="Avatar: <?php $a->username ?>"/>
                                                        </td>
                                                        <td>
                                                            <a href="<?php echo base_url() ?>users/<?php echo $a->id ?>"><?php echo $a->username ?></a>
                                                        </td>
                                                        <td>
                                                            <?php if($this->ion_auth->in_group("g_usu",$a->id)){?>
                                                                <i class="fa fa-users"></i>
                                                            <?php }?>
                                                            <?php if($this->ion_auth->in_group("g_equips",$a->id)){?>
                                                                <i class="fa fa-cut"></i>
                                                            <?php }?>
                                                            <?php if($this->ion_auth->in_group("g_tut",$a->id)){?>
                                                                <i class="fa fa-file-text"></i>
                                                            <?php }?>
                                                            <?php if($this->ion_auth->in_group("u_lab",$a->id)){?>
                                                                <i class="fa fa-user"></i>
                                                            <?php }?>
                                                            <?php if($this->ion_auth->in_group("g_amb",$a->id)){?>
                                                                <i class="fa fa-map-marker"></i>
                                                            <?php }?>
                                                        </td>
                                                        <td class="appear-medium"><a href="<?php echo base_url() ?>users/<?php echo $a->id ?>"><i class="fa fa-info"></i></a></td>
                                                    </tr>
                                                <?php }?>
                                        </table>
                                </section>  
                        <?php } ?>
                        <?php if(isset($is_index)){?>
                                <section>
                                        <h2>Tutoriais recentes</h2>
                                        <nav>
                                                <ul>
                                                    <?php foreach($tuts as $t) {?>
                                                        <li><a href="<?php echo base_url() ?>tuts/<?php echo $t->id ?>"><?php echo $t->titulo ?></a></li>
                                                    <?php }?>
                                                </ul>
                                        </nav>
                                </section>
                        <?php } ?>
                            
			</aside>
                        <div class="clear"></div>
                    </div> <!-- end of wrapper -->
                    <!-- page's footer -->
                    <footer id="page-footer" role="contentinfo">
                            <p>Todos os direitos reservados.</p>
                    </footer>

		</div>

	</body>

</html>