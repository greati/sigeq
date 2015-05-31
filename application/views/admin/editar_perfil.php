<form method="post" action="edit/do">
    <p>
        <label for="nome_usu">Nome</label><input type="text" name="nome" id="nome_usu" value="<?php echo $u->nome ?>"  placeholder=""/>
    </p>

    <p>
        <label for="email_usu">E-mail</label><input type="text" name="email" id="email_usu" value="<?php echo $u->email ?>" placeholder=""/>
    </p>

    <p>
        <label class="label_textarea" for="texto_tut">Sobre</label><textarea name="descricao" id="texto_tut"><?php echo $u->descricao ?></textarea>
    </p>

    <p class="select_set">
        <label for="foto">Foto do perfil</label><input type="file" name="foto" id="foto"/>
    </p>

    <p class="select_set">
        <input type="checkbox" name="publicar" id="publicar" <?php $is_publico = TRUE; if ($is_publico == TRUE) {?> checked <?php } ?>/><label class="sem_borda" for="publicar">Tornar público meu perfil.</label>
    </p>


    <p class="button_group">
        <button type="submit">Salvar</button>
        <button type="reset">Limpar</button>
    </p>

</form>