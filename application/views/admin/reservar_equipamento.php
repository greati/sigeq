<form method="post" action="reserve/do">

    <p>
        <label for="equip_reserva">Equipamento</label>
        <select name="equipamento" id="equip_reserva">
            <?php foreach ($equipamentos as $e) {?>
                <option><?php echo $e->nome ?></option>
            <?php } ?>
        </select>
    </p>

    <p>
        <label for="inicio">De</label><input style="padding:2px 5px;" type="date" name="inicio" id="inicio"/>
    </p>
    
    <p>    
        <label for="fim">Até</label><input type="date" style="padding:2px 8px;" name="fim" id="fim"/>
    </p>

    <p>
        <label class="label_textarea" for="descricao">Descrição</label><textarea name="texto" id="descricao"></textarea>
    </p>

    <p class="button_group">
        <button type="submit">Reservar</button>
        <button type="reset">Limpar</button>
    </p>

</form>