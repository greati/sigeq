<form method="post" action="new/do">
    <p>
        <label for="titulo_tut">Título</label><input type="text" name="titulo" id="titulo_tut" placeholder=""/>
    </p>

    <p>
        <label class="label_textarea" for="texto_tut">Texto</label><textarea name="texto" id="texto_tut"></textarea>
    </p>

    <p class="select_set">
        <label for="categoria_tut">Categoria</label>
        <select name="categoria" id="categoria_tut">
            <?php foreach($categorias as $cat){ ?>
                <option><?php echo $cat->nome?></option>
            <?php } ?>
        </select>
    </p>
    
    <input type="hidden" name="usuario_id" value="<?php echo $this->ion_auth->get_user_id()?>"/>

    <p class="button_group">
        <button type="submit">Salvar</button>
        <button type="reset">Limpar</button>
    </p>

</form>