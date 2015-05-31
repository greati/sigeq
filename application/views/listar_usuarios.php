<table>
    <tr>
        <th class="appear-high">Nome</th>
        <th>Login</th>
        <th class="appear-medium">E-mail</th>
        <th>Autoridades</th>
        <th></th>
        <th></th>
        <th></th>
    </tr>

    <?php foreach ($usuarios as $u) {?>
    
        <tr>
            
            <td class="appear-high"><?php echo $u->nome ?></td>
            <td><?php echo $u->username ?></td>
            <td class="appear-medium"><?php echo $u->email ?></td>
            <td>
                <?php if($this->ion_auth->in_group("g_usu",$u->id)) echo 'Gerente de usuários<br />'; 
                      if($this->ion_auth->in_group("g_equips",$u->id)) echo 'Gerente de equipamentos<br />';
                      if($this->ion_auth->in_group("g_tut",$u->id)) echo 'Escritor de tutoriais<br />';
                      if($this->ion_auth->in_group("u_lab",$u->id)) echo 'Usuário do laboratório<br />'; 
                ?>
            </td>
            <td><a href="<?php echo base_url() ?>users/<?php echo $u->id ?>"><i class="fa fa-info"></i></a></td>
            <td><a href="users/edit/<?php echo $u->id?>"><i class="fa fa-wrench"></i></a></td>
            <td><a href="users/delete/<?php echo $u->id?>"><i class="fa fa-remove"></i></a></td>
        </tr>
    
    <?php } ?>		

</table>