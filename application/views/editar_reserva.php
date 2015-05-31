<?php echo form_open("admin/equips/reservs/edit/$r->id") ?>
    <?php echo form_error("equipamento") ?>
    <p>
        <label for="equip_reserva">Equipamento</label>
        <select name="equipamento" id="equip_reserva">
            <?php foreach ($equipamentos as $e) {?>
                <option value="<?php echo $e->id ?>" <?php if($e->id === $r->equipamento->id) echo "selected" ?>><?php echo $e->nome ?></option>
            <?php } ?>
        </select>
    </p>
    
    <?php echo form_error("inicio") ?>
    <p>
        <label for="inicio">De</label><input type="text" class="datetime" name="inicio" id="inicio" 
                                             value="<?php echo $r->data_inicio ?>"/>
    </p>

    <?php echo form_error("fim") ?>
    <p>    
        <label for="fim">Até</label><input type="text" class="datetime" name="fim" id="fim" value="<?php echo $r->data_final ?>"/>
    </p>
    
    <?php echo form_error("descricao") ?>
    <p>
        <label class="label_textarea" for="descricao">Descrição</label><textarea name="descricao" id="descricao"><?php echo $r->descricao ?></textarea>
    </p>

    <fieldset class="bts">
        <button type="submit">Salvar</button>
        <button type="reset">Limpar</button>
    </fieldset>

</form>