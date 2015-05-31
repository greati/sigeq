<table>
    <tr>
        <th>Título</th>
        <th>Autor</th>
        <th>Categoria</th>
        <th>Data</th>
    </tr>

    <?php foreach ($tutoriais as $t) {?>
    
        <tr>
            
            <td><?php echo $t->titulo ?></td>
            <td><?php echo $t->editores->nome ?></td>
            <td><?php echo $t->categoria->nome ?></td>
            <td><?php echo $t->data ?></td>
            <td><a href="tuts/edit/<?php echo $t->id ?>">Editar</a></td>
            <td><a href="tuts/delete/<?php echo $t->id ?>">Excluir</a></td>
        </tr>
    
    <?php } ?>					

</table>