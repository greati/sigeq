<table>
    <tr>
        <th>Título</th>
        <th>Autor</th>
        <th>Categoria</th>
        <th>Data</th>
        <th></th>
        <th></th>
    </tr>

    <?php foreach ($tutoriais as $t) {?>
    
        <tr>
            <td><a href="<?php echo base_url() ?>tuts/<?php echo $t->id ?>"><?php echo $t->titulo ?></a></td>
            <td><?php echo $t->editores->nome ?></td>
            <td><?php echo $t->categoria->nome ?></td>
            <td><?php echo $t->data ?></td>
            <td><a href="tuts/edit/<?php echo $t->id ?>"><i class="fa fa-wrench"></i></a></td>
            <td><a href="tuts/delete/<?php echo $t->id ?>"><i class="fa fa-remove"></i></a></td>
        </tr>
    
    <?php } ?>					

</table>