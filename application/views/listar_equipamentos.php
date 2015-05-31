<table>
    <tr>
        <th>Equipamento</th>
        <th class="appear-high">Fabricante</th>
        <th class="appear-medium">Tombamento</th>
        <th class="appear-medium">Categoria</th>
        <th class="appear-medium">Quantidade</th>
        <th>Localização</th>
        <th></th>
        <th></th>
        <th></th>
    </tr>

    <?php foreach ($equipamentos as $e) {?>
        <tr>
            <td><?php echo $e->nome ?></td>
            <td class="appear-high"><?php echo $e->fabricante ?></td>
            <td class="appear-medium"><?php echo $e->tombamento ?></td>
            <td class="appear-medium"><?php echo $e->categoria->nome ?></td>
            <td class="appear-medium"><?php echo $e->quantidade ?></td>
            <td>end</td>
            <td><a href="<?php echo base_url() ?>equips/<?php echo $e->id ?>"><i class="fa fa-info"></i></a></td>
            <td><a href="<?php echo base_url() ?>admin/equips/edit/<?php echo $e->id ?>"><i class="fa fa-wrench"></i></a></td>
            <td><a href="<?php echo base_url() ?>admin/equips/delete/<?php echo $e->id ?>"><i class="fa fa-remove"></i></a></td>
        </tr>
    
    <?php } ?>				
</table>