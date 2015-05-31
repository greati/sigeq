<article class="perfil">
    <header>
        <div class="avatar">
            <img src="<?php echo base_url();?>assets/images/usuarios/3.jpg" alt="Estufa"/>
        </div>
        <h3><?php echo $u->nome ?></h3>
        <div class="autorizacoes">
                <?php if($this->ion_auth->in_group("g_usu",$u->id))?>
                <i class="fa fa-users"></i>
                <?php if($this->ion_auth->in_group("g_equips",$u->id))?>
                <i class="fa fa-cut"></i>
                <?php if($this->ion_auth->in_group("g_tut",$u->id))?>
                <i class="fa fa-file-text"></i>
                <?php if($this->ion_auth->in_group("u_lab",$u->id))?>
                <i class="fa fa-user"></i>
        </div>
        
        <p><?= $u->descricao ?></p>
        
    </header>

    <table>
        <tr>
            <th>Usuário</th>
            <td><?= $u->username ?></td>
        </tr>
        <tr>
            <th>Data de Nascimento</th>
            <td><?= $u->data_nascimento ?></td>
        </tr>
        <tr>
            <th>E-mail</th>
            <td><?= $u->email ?></td>
        </tr>
        <tr>
            <th>Telefone</th>
            <td><?= $u->telefoneFixo ?></td>
        </tr>
        <tr>
            <th>Celular</th>
            <td><?= $u->celular ?></td>
        </tr>
        <tr>
            <th>CEP</th>
            <td><?= $u->cep ?></td>
        </tr>
        <tr>
            <th>Endereço</th>
            <td><?= $u->rua ?>, <?= $u->numeroCasa ?>, <?= $u->bairro?>, <?= $u->cidade ?>, <?= $u->estado ?></td>
        </tr>
    </table>

</article>