<form method="post" action="do">
    
    <p>
        <label for="nome_equip">Nome</label>
        <input type="text" name="nome" value="<?php echo $e->nome ?>" id="nome_equip" placeholder="Balança, Estufa, Béquer..."/>
        
        <label for="tombamento">Tombamento</label>
        <input type="text" name="tombamento" id="tombamento" value="<?php echo $e->tombamento ?>" placeholder=""/>
    </p>

    <p>
        <label for="fabricante_equip">Fabricante</label><input type="text" value="<?php echo $e->fabricante ?>" name="fabricante" id="fabricante_equip" placeholder="SPLabor, ProLab, Vidrolabor..."/>
        <label for="categoria_equip">Categoria</label>
        <select name="categoria" id="categoria_equip">
            <?php foreach($categorias as $cat){ ?>
                <option <?php echo "checked" ? $e->categoria->nome === $cat->nome : "" ?>><?php echo $cat->nome?></option>
            <?php } ?>
        </select>
    </p>

    <p>
        <label class="label_textarea" for="descricao">Descrição</label>
        <textarea name="descricao" id="descricao" placeholder="Funções, dimensões, precisão..."><?php echo $e->descricao ?></textarea>
    </p>				

    <p>
        <label class="label_textarea" for="instrucoes">Instruções</label>
        <textarea name="instrucoes" id="instrucoes" placeholder="Passo a passo"><?php echo $e->instrucoes ?></textarea>
    </p>

    <p>
        <label class="label_textarea" for="precaucoes">Precauções</label>
        <textarea name="precaucoes" id="precaucoes" placeholder="Como não proceder"><?php echo $e->precaucoes ?></textarea>
    </p>

    <p class="select_set">
        <label for="quantidade">Quantidade</label>
        <input type="text" name="quantidade" id="quantidade" placeholder="" value="<?php echo $e->quantidade ?>"/>
    </p>
    
    <input type="hidden" name="usuario_id" value="<?php echo $this->ion_auth->get_user_id() ?>"/>
    <input type="hidden" name="id" value="<?php echo $e->id ?>"/>
    
    <p class="button_group">
        <button type="submit">Salvar</button>
        <button type="reset">Limpar</button>
    </p>

</form>