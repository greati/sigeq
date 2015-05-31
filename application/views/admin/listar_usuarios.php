<table>
    <tr>
        <th>Nome</th>
        <th>Login</th>
        <th>E-mail</th>
        <th>Autoridades</th>
    </tr>

    <?php foreach ($usuarios as $u) {?>
    
        <tr>
            
            <td><?php echo $u->nome ?></td>
            <td><?php echo $u->username ?></td>
            <td><?php echo $u->email ?></td>
            <td>
                <?php if($this->ion_auth->in_group("g_usu",$u->id)) echo 'Gerente de usuários<br />'; 
                      if($this->ion_auth->in_group("g_equips",$u->id)) echo 'Gerente de equipamentos<br />';
                      if($this->ion_auth->in_group("g_tut",$u->id)) echo 'Escritor de tutoriais<br />';
                      if($this->ion_auth->in_group("u_lab",$u->id)) echo 'Usuário do laboratório<br />'; 
                ?>
            </td>
            <td><a href="users/edit/<?php echo $u->id?>">Editar</a></td>
            <td><a href="users/delete/<?php echo $u->id?>">Excluir</a></td>
        </tr>
    
    <?php } ?>		

</table>