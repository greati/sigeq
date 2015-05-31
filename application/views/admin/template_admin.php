<!DOCTYPE html>
<html>
    <head>
        <title><?= $title ?></title>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/admin_style.css"/>
    </head>

    <body>
        <div id="sidebar">
            <img id="user_avatar" src="<?php echo base_url();?>assets/images/usuarios/<?php echo $this->ion_auth->user()->row()->id ?>.jpg" alt="Avatar usuário" />
            <span id="user_login"><?php echo $this->ion_auth->user()->row()->username?><a id="link_logout" href="<?php echo base_url() ?>user/logout">  Logout</a></span>

            <div id="autorizacoes"><h6>Autorizações</h6>
                <?php if($this->ion_auth->in_group("g_usu",$this->ion_auth->user()->row()->id))?>
                <img class="user_aut" src="<?php echo base_url();?>assets/images/aut_admin_ativo.png" alt="Avatar usuário" />
                <?php if($this->ion_auth->in_group("g_equips",$this->ion_auth->user()->row()->id))?>
                <img class="user_aut" src="<?php echo base_url();?>assets/images/aut_equip_ativo.png" alt="Avatar usuário" />
                <?php if($this->ion_auth->in_group("g_tut",$this->ion_auth->user()->row()->id))?>
                <img class="user_aut" src="<?php echo base_url();?>assets/images/aut_tutoriais_ativo.png" alt="Avatar usuário" />
                <?php if($this->ion_auth->in_group("u_lab",$this->ion_auth->user()->row()->id))?>
                <img class="user_aut" src="<?php echo base_url();?>assets/images/aut_normal_ativo.png" alt="Avatar usuário" />
            </div>

            <nav>
                <h4>Equipamentos</h4>
                <ul>
                    <li><a href="<?php echo base_url();?>admin/equips/new">Cadastrar equipamento</a></li>
                    <li><a href="<?php echo base_url();?>admin/equips">Gerenciar equipamentos</a></li>
                    <li><a href="<?php echo base_url();?>admin/equips/reservar">Reservar equipamentos</a></li>
                </ul>
            </nav>

            <nav>
                <h4>Tutoriais</h4>
                <ul>
                    <li><a href="<?php echo base_url();?>admin/tuts/new">Criar tutorial</a></li>
                    <li><a href="<?php echo base_url();?>admin/tuts">Gerenciar tutoriais</a></li>
                </ul>
            </nav>

            <nav>
                <h4>Usuários</h4>
                <ul>
                    <li><a href="<?php echo base_url();?>admin/users/new">Cadastrar usuário</a></li>
                    <li><a href="<?php echo base_url();?>admin/users">Gerenciar usuários</a></li>
                </ul>
            </nav>

            <nav>
                <h4>Minha conta</h4>
                <ul>
                    <li><a href="<?php echo base_url();?>user/<?php echo $this->ion_auth->user()->row()->id?>">Visitar perfil</a></li>
                    <li><a href="<?php echo base_url();?>user/edit">Atualizar perfil</a></li>
                </ul>
            </nav>			

        </div>

        <header id="page_header">
            <div>
                <h1><?= $title_section ?></h1>
                <h2><?= $desc_section ?></h2>
            </div>
        </header>

        <section id="main">
            <?= $contents ?>
        </section>
    </body>
</html>