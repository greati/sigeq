<article class="equipamento">
    <header>
        <h3><?= $e->nome ?></h3>
    </header>

    <div class="equip-img">
        <img src="<?php echo base_url();?>assets/images/equips/<?php echo $e->id ?>.jpg" alt="<?php echo $e->nome ?>"/>
    </div>

    <table id="equip_info">
        <tr>
            <th>Categoria</th>
            <td><?= $e->categoria->nome ?></td>
        </tr>        
        <tr>
            <th>Tombamento</th>
            <td><?= $e->tombamento ?></td>
        </tr>
        <tr>
            <th>Fabricante</th>
            <td><?= $e->fabricante ?></td>
        </tr>
        <tr>
            <th>Quantidade</th>
            <td><?= $e->quantidade ?></td>
        </tr>
    </table>
    
    <section class="bts">
        <a href="<?php echo base_url() ?>equips/use/<?php echo $e->id ?>">Vou usar agora</a>
        <a href="<?php echo base_url() ?>admin/equips/reservs/new/<?php echo $e->id ?>">Reservar</a>
    </section>
    
    <section>
        <h4>Reservas</h4>
        <table>
            <tr>
                <th>Por</th>
                <th>De</th>
                <th>Até</th>
            </tr>
            <?php if (!empty($reservas)){?>
                <?php foreach($reservas as $r){ ?>
                    <?php
                    //defining date formats to dd/mm/yyyy
                    $r->data_inicio = date_format(date_create_from_format('Y-m-d H:i:s', $r->data_inicio),'d/m/Y H:i');
                    $r->data_final = date_format(date_create_from_format('Y-m-d H:i:s', $r->data_final),'d/m/Y H:i');
                    ?>
                    <tr>
                        <td><?php echo $r->usuario->username ?></td>
                        <td><?php echo $r->data_inicio ?></td>
                        <td><?php echo $r->data_final ?></td>
                    </tr>
                <?php }?>
            <?php }else{}?>
        </table>
    </section>
    
    <section>
        <h4>Descrição</h4>
        <p class="descricao">
            <?= $e->descricao ?>
        </p>
    </section>

    <section>
        <h4>Instruções</h4>
        <p>
            <?= $e->instrucoes ?>
        </p>
    </section>

    <section>
        <h4>Precauções</h4>
        <p>
            <?= $e->precaucoes ?>
        </p>
    </section>
</article>
