<?php echo form_open("admin/tuts/edit/$t->id")?>
    <fieldset>
        <legend>Geral</legend>
        
        <?php echo form_error('titulo') ?>
        <p>
            <label for="titulo_tut">Título</label><input type="text" name="titulo" id="titulo_tut" placeholder="" value="<?php echo $t->titulo ?>"/>
        </p>

        <?php echo form_error('texto') ?>
        <p>
            <label class="label_textarea" for="texto_tut">Texto</label><textarea name="texto" id="texto_tut"><?php echo $t->texto ?></textarea>
        </p>

        <p class="select_set">
            <label for="categoria_tut">Categoria</label>
            <select name="categoria" id="categoria_tut">
                <?php foreach($categorias as $cat){ ?>
                    <option <?php 'checked' ? $cat->nome === $t->categoria->nome : '' ?>><?php echo $cat->nome?></option>
                <?php } ?>
            </select>
        </p>
    </fieldset>
    
    <input type="hidden" name="usuario_id" value="<?php echo $this->ion_auth->get_user_id()?>"/>
    <input type="hidden" name="id" value="<?php echo $t->id ?>"/>
    
    <fieldset class="bts">
        <button type="submit">Salvar</button>
        <button type="reset">Limpar</button>
    </fieldset>

</form>