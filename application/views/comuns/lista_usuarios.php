<?php foreach($usuarios as $u) {?>

    <article class="perfil">
        <header>
            <a href="ver_perfil.html"><h1><?php echo $u->nome ?></h1></a>
        </header>

        <img class="foto_perfil" src="<?php echo base_url();?>assets/images/usuarios/<?php echo $u->id ?>" alt="Avatar"/>

        <p> 
            <span>E-mail:</span> <?php echo $u->email ?>
        </p>

        <div class="autorizacoes"><span>Autorizações</span>
                <?php if($this->ion_auth->in_group("g_usu",$this->ion_auth->user()->row()->id))?>
                <img class="user_aut" src="<?php echo base_url();?>assets/images/aut_admin_ativo.png" alt="Avatar usuário" />
                <?php if($this->ion_auth->in_group("g_equips",$this->ion_auth->user()->row()->id))?>
                <img class="user_aut" src="<?php echo base_url();?>assets/images/aut_equip_ativo.png" alt="Avatar usuário" />
                <?php if($this->ion_auth->in_group("g_tut",$this->ion_auth->user()->row()->id))?>
                <img class="user_aut" src="<?php echo base_url();?>assets/images/aut_tutoriais_ativo.png" alt="Avatar usuário" />
                <?php if($this->ion_auth->in_group("u_lab",$this->ion_auth->user()->row()->id))?>
                <img class="user_aut" src="<?php echo base_url();?>assets/images/aut_normal_ativo.png" alt="Avatar usuário" />
        </div>
    </article>

<?php } ?>