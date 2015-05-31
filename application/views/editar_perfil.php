<?php echo form_open("admin/users/edit/$u->id") ?>
    <fieldset>
        <legend>Informações gerais</legend>
        
        <?php echo form_error('nome'); ?>
        <p>
            <label for="nome_usu">Nome</label><input type="text" name="nome" id="nome_usu" value="<?php echo $u->nome ?>"  placeholder=""/>
        </p>
        
        <p>
            <label for="nasc_usu">Data de nascimento</label>
            <input type="text" class="dateonly" name="data_nascimento" id="nasc_usu" value="<?php echo $u->data_nascimento ?>"  placeholder=""/>
        </p>
        
        <p>
            <label class="label_textarea" for="texto_tut">Sobre</label><textarea name="descricao" id="texto_tut"><?php echo $u->descricao ?></textarea>
        </p>
        
        <p>
            <label for="foto">Foto do perfil</label><input type="file" name="foto" id="foto"/>
        </p>
        
        <p>
            <label class="label-checkbox" for="publicar">Tornar público meu perfil.</label>
            <input type="checkbox" name="publicar" id="publicar" <?php $is_publico = TRUE; if ($is_publico == TRUE) {?> checked <?php } ?>/>
        </p>
    </fieldset>
    
    <fieldset>
        <legend>Contato</legend>
        
        <?php echo form_error('email'); ?>
        <p>
            <label for="email_usu">E-mail</label><input type="text" name="email" id="email_usu" value="<?php echo $u->email ?>" placeholder=""/>
        </p>
        
        <?php echo form_error('telefoneFixo'); ?>
        <p>
            <label for="tel_usu">Telefone</label><input type="text" name="telefoneFixo" id="tel_usu" value="<?php echo $u->telefoneFixo ?>" placeholder=""/>
        </p>
        
        <?php echo form_error('celular'); ?>
        <p>
            <label for="cel_usu">Celular</label><input type="text" name="celular" id="cel_usu" value="<?php echo $u->celular ?>" placeholder=""/>
        </p>
    </fieldset>
    
    <fieldset>
        <legend>Endereço</legend>
        <p>
            <label for="end_rua">Rua</label><input type="text" name="rua" id="end_rua" value="<?php echo $u->rua ?>"  placeholder=""/>
        </p>
        
        <?php echo form_error('numeroCasa'); ?>
        <p>
            <label for="end_num">Número da casa</label><input type="text" name="numeroCasa" id="end_num" value="<?php echo $u->numeroCasa ?>"  placeholder=""/>
        </p>
        
        <p>
            <label for="end_bairro">Bairro</label><input type="text" name="bairro" id="end_rua" value="<?php echo $u->bairro ?>"  placeholder=""/>
        </p>
        
        <p>
            <label for="end_estado">Estado</label><input type="text" name="estado" id="end_estado" value="<?php echo $u->estado ?>"  placeholder=""/>
        </p>
        
        <p>
            <label for="end_cidade">Cidade</label><input type="text" name="cidade" id="end_cidade" value="<?php echo $u->cidade ?>"  placeholder=""/>
        </p>
        
        <?php echo form_error('cep'); ?>
        <p>
            <label for="end_cep">CEP</label><input type="text" name="cep" id="end-cep" value="<?php echo $u->cep ?>"  placeholder=""/>
        </p>
    
    </fieldset>
    
    <fieldset class="bts">
        <button type="submit">Salvar</button>
        <button type="reset">Limpar</button>
    </fieldset>

</form>