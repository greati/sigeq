<?php foreach($usuarios as $u) {?>
    <article class="user-list-item">
        <div class="avatar">
            <img src="<?php echo base_url();?>assets/images/usuarios/3.jpg" alt="Avatar"/>
        </div>

        <div class="info">
            <h3><a href="ver_perfil.html"><?php echo $u->username ?></a></h3>

            <!--<img class="foto_perfil" src="<?php echo base_url();?>assets/images/usuarios/<?php echo $u->id ?>" alt="Avatar"/>-->

            <div class="autorizacoes">
                <?php if($this->ion_auth->in_group("g_usu",$u->id)){?>
                    <i class="fa fa-users"></i>
                <?php }?>
                <?php if($this->ion_auth->in_group("g_equips",$u->id)){?>
                    <i class="fa fa-cut"></i>
                <?php }?>
                <?php if($this->ion_auth->in_group("g_tut",$u->id)){?>
                    <i class="fa fa-file-text"></i>
                <?php }?>
                <?php if($this->ion_auth->in_group("u_lab",$u->id)){?>
                    <i class="fa fa-user"></i>
                <?php }?>
                <?php if($this->ion_auth->in_group("g_amb",$u->id)){?>
                    <i class="fa fa-map-marker"></i>
                <?php }?>
            </div>
        </div>
    </article>

<?php } ?>