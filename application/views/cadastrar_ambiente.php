<?php echo form_open('admin/ambs/new')?>
    <fieldset>
        <legend>Informações de acesso</legend>
        
        <?php echo form_error('nome') ?>
        <p>
            <label for="nome_amb">Nome</label><input type="text" name="nome" id="nome_amb" placeholder="" value="<?php echo set_value("nome") ?>"/>
        </p>
        
        <?php echo form_error('descricao') ?>        
        <p>
            <label for="descricao">Descrição</label><textarea name="descricao" id="descricao" placeholder="Descreva a localização e a função, principalmente"><?php echo set_value("descricao") ?></textarea>
        </p>

        <p>
            <label for="categoria_equip">Categoria</label>
            <select name="categoria" id="categoria_equip">
                <?php foreach($categorias as $cat){ ?>
                    <option value="<?php echo $cat->id ?>"><?php echo $cat->nome?></option>
                <?php } ?>
            </select>
        </p>
        
    </fieldset>
    
    <fieldset class="bts">
        <button type="submit">Salvar</button>
        <button type="reset">Limpar</button>
    </fieldset>

</form>