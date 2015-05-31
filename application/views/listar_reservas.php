<table>
    <tr>
        <th>Nome</th>
        <th>Início</th>
        <th>Fim</th>
        <th class="appear-medium">Status</th>
        <th></th>
        <th></th>
    </tr>

    <?php foreach ($reservas as $r) {?>
        <?php
            if($now >= $r->data_inicio && $now <= $r->data_final){
                $estado = "<span class='disappear-medium'><i class='fa fa-spinner'></i></span><span class='appear-medium'>Ativo</span>";
            }else if($now <= $r->data_inicio){
                $estado = "<span class='disappear-medium'><i class='fa fa-clock-o disappear-medium'></i></span><span class='appear-medium'>Reservado</span>";
            }else if($now >= $r->data_final){
                $estado = "<span class='disappear-medium'><i class='fa fa-check disappear-medium'></i></span><span class='appear-medium'>Finalizado</span>";
            }
        
            $r->data_inicio = date_format(date_create_from_format('Y-m-d H:i:s', $r->data_inicio),'d/m/Y H:i');
            $r->data_final = date_format(date_create_from_format('Y-m-d H:i:s', $r->data_final),'d/m/Y H:i');
        ?>
        <tr>
            <td><a href="<?php echo base_url() ?>ambs/<?php echo $r->id ?>"><?php echo $r->equipamento->nome ?></a></td>
            <td><?php echo $r->data_inicio ?></td>
            <td><?php echo $r->data_final ?></td>
            <td><?php echo $estado ?></span></td>
            <td><a href="<?php echo base_url() ?>admin/equips/reservs/edit/<?php echo $r->id ?>"><i class="fa fa-wrench"></i></a></td>
            <td><a href="<?php echo base_url() ?>admin/equips/reservs/delete/<?php echo $r->id ?>"><i class="fa fa-remove"></i></a></td>
        </tr>
    
    <?php } ?>					

</table>