<section class="index-section">
    <h4>Conheça os ambientes</h4>
    <nav id="index-lista-ambientes">
        <ul>
        <?php foreach($ambs as $a) {?>
            <li>
                <i class="fa fa-map-marker"></i><a href="<?php echo base_url() ?>ambs/<?php echo $a->id ?>"><?php echo $a->nome ?></a>
            </li>
        <?php } ?>
        </ul>
    </nav>
    <div class="clear"></div>
</section>

<section class="index-section">
    <h4>Novos equipamentos</h4>
    <table>
        <tr>
            <th>Equipamento</th>
            <th class="appear-high">Fabricante</th>
            <th class="appear-medium">Categoria</th>
            <th>Quantidade</th>
            <th></th>
        </tr>

        <?php foreach ($equips as $e) {?>
            <tr>
                <td><?php echo $e->nome ?></td>
                <td class="appear-high"><?php echo $e->fabricante ?></td>
                <td class="appear-medium"><?php echo $e->categoria->nome ?></td>
                <td><?php echo $e->quantidade ?></td>
                <td><a href="<?php echo base_url() ?>equips/<?php echo $e->id ?>"><i class="fa fa-info"></i></a></td>
            </tr>
        <?php } ?>				
    </table>
</section>

<section class="index-section">
    <h4>Últimas reservas</h4>
    <table>
        <tr>
            <th>Equipamento</th>
            <th class="appear-high">Por</th>
            <th class="appear-high">De</th>
            <th>Até</th>
            <th></th>
        </tr>

        <?php foreach ($reservas as $r) {?>
            <?php
            //defining date formats to dd/mm/yyyy
            $r->data_inicio = date_format(date_create_from_format('Y-m-d H:i:s', $r->data_inicio),'d/m/Y H:i');
            $r->data_final = date_format(date_create_from_format('Y-m-d H:i:s', $r->data_final),'d/m/Y H:i');
            ?>
            <tr>
                <td><?php echo $r->equipamento->nome ?></td>
                <td class="appear-high"><?php echo $r->usuario->username ?></td>
                <td class="appear-high"><?php echo $r->data_inicio ?></td>
                <td><?php echo $r->data_final ?></td>
                <td><a href="<?php echo base_url() ?>equips/reservs/<?php echo $r->id ?>"><i class="fa fa-info"></i></a></td>
            </tr>
        <?php } ?>				
    </table>
</section>