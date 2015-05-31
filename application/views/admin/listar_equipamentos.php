<table>
    <tr>
        <th>Equipamento</th>
        <th>Fabricante</th>
        <th>Tombamento</th>
        <th>Categoria</th>
        <th>Quantidade</th>
    </tr>

    <?php foreach ($equipamentos as $e) {?>
    
        <tr>
            
            <td><?php echo $e->nome ?></td>
            <td><?php echo $e->fabricante ?></td>
            <td><?php echo $e->tombamento ?></td>
            <td><?php echo $e->categoria->nome ?></td>
            <td><?php echo $e->quantidade ?></td>
            <td><a href="equips/edit/<?php echo $e->id ?>">Editar</a></td>
            <td><a href="equips/delete/<?php echo $e->id ?>">Excluir</a></td>
        </tr>
    
    <?php } ?>				

</table>