<div class="reserva-equip-img">
    <img src="http://www.prolab.com.br/produtos_img/gde_219d65f55dcaa057fd71b2f17e1a6e74_sxdtme.jpg" alt="Estufa"/>
</div>

<div class="reserva-info">
    <?php
    //defining date formats to dd/mm/yyyy
    $r->data_inicio = date_format(date_create_from_format('Y-m-d H:i:s', $r->data_inicio),'d/m/Y H:i');
    $r->data_final = date_format(date_create_from_format('Y-m-d H:i:s', $r->data_final),'d/m/Y H:i');
    ?>
    <label>Equipamento:</label>
    <p><?php echo $r->equipamento->nome?></p>
    <label>Período:</label>
    <p><?php echo $r->data_inicio ?> a <?php echo $r->data_final ?></p>
    <label>Usuário:</label>
    <p><?php echo $r->usuario->username ?></p>
    <label>Descrição:</label>
    <p><?php echo $r->descricao ?></p>
</div>