<table>
    <tr>
        <th>Nome</th>
        <th>Categoria</th>
        <th></th>
        <th></th>
    </tr>

    <?php foreach ($ambientes as $a) {?>
    
        <tr>
            <td><a href="<?php echo base_url() ?>ambs/<?php echo $a->id ?>"><?php echo $a->nome ?></a></td>
            <td><?php echo $a->categoria->nome ?></td>
            <td><a href="ambs/edit/<?php echo $a->id ?>"><i class="fa fa-wrench"></i></a></td>
            <td><a href="ambs/delete/<?php echo $a->id ?>"><i class="fa fa-remove"></i></a></td>
        </tr>
    
    <?php } ?>					

</table>