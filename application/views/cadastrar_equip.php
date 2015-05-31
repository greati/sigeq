<?php echo form_open_multipart('admin/equips/new')?>
    <fieldset>
        <legend>Informações Gerais</legend>
        
        <?php echo form_error('nome') ?>
        <p>
            <label for="nome_equip">Nome</label><input type="text" name="nome" id="nome_equip" value="<?php echo set_value('nome') ?>" placeholder="Balança, Estufa, Béquer..."/>
        </p>

        <?php echo form_error('tombamento') ?>
        <p>
            <label for="tombamento">Tombamento</label><input size="18" type="text" name="tombamento" value="<?php echo set_value('tombamento') ?>" id="tombamento" placeholder=""/>
        </p>

        <p>
            <label for="fabricante_equip">Fabricante</label><input type="text" name="fabricante" value="<?php echo set_value('fabricante') ?>" id="fabricante_equip" placeholder="SPLabor, ProLab, Vidrolabor..."/>
        </p>    
        
        <?php echo form_error('categoria') ?>
        <p>
            <label for="categoria_equip">Categoria</label>
            <select name="categoria" id="categoria_equip">
                <?php foreach($categorias as $cat){ ?>
                    <option><?php echo $cat->nome?></option>
                <?php } ?>
            </select>
        </p>

        <?php echo form_error('quantidade') ?>
        <p>
            <label for="quantidade">Quantidade</label><input type="text" value="<?php echo set_value('quantidade') ?>" name="quantidade" id="quantidade" placeholder=""/>
        </p> 

        <?php echo form_error('descricao') ?>
        <p>
            <label for="descricao">Descrição</label><textarea name="descricao" id="descricao" placeholder="Funções, dimensões, precisão..."><?php echo set_value('descricao') ?></textarea>
        </p>
        
        <p>
            <label for="imagem">Imagem</label>
            <input type="file" id="imagem" name="userfile"/>
        </p>
    </fieldset>
                
    <fieldset>
        <legend>Sobre o uso</legend>
        <p>
            <label for="instrucoes">Instruções</label><textarea name="instrucoes" id="instrucoes" placeholder="Passo a passo"><?php echo set_value('instrucoes') ?></textarea>
        </p>

        <p>
            <label for="precaucoes">Precauções</label><textarea name="precaucoes" id="precaucoes" placeholder="Como não proceder"><?php echo set_value('precaucoes') ?></textarea>
        </p>

    </fieldset> 
    
    <input type="hidden" name="usuario_id" value="<?php echo $this->ion_auth->get_user_id() ?>"/>

    <fieldset class="bts">
        <button type="submit">Salvar</button>
        <button type="reset">Limpar</button>
    </fieldset>

</form>