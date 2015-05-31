<?php echo form_open('admin/users/new') ?>
    <fieldset>
        <legend>Informações de acesso</legend>
        
        <?php echo form_error('nome'); ?>
        <p>
            <label for="nome_usu">Nome</label><input type="text" name="nome" id="nome_usu" placeholder="" value="<?php echo set_value('nome') ?>"/>
        </p>

        <?php echo form_error('email'); ?>
        <p>
            <label for="email_usu">E-mail</label><input type="text" name="email" id="email_usu" value="<?php echo set_value('email')?>" placeholder=""/>
        </p>

        <?php echo form_error('login'); ?>
        <p>
            <label for="login">Login</label><input type="text" name="login" id="login" value="<?php echo set_value('login') ?>" placeholder=""/>
        </p>

        <?php echo form_error('senha'); ?>
        <p>
            <label for="senha">Senha</label><input type="password" name="senha" id="senha" placeholder=""/>
        </p>
        
        <?php echo form_error('confirmar_senha'); ?>
        <p>
            <label for="senha">Confirmar senha</label><input type="password" name="confirmar_senha" id="senha" placeholder=""/>
        </p>
    </fieldset>
    
    <fieldset>
    <?php echo form_error('autoridade[]'); ?>
    <legend>Autoridades</legend>
        <p>
            <input type="checkbox" name="autoridade[]" value="1" id="super"/><label class="label-checkbox" for="super">Gerente de usuários</label>
        </p>
        <p> 
            <input type="checkbox" name="autoridade[]" value="2" id="equip"/><label class="label-checkbox" for="equip">Gerente de equipamentos</label>
        </p>    
        <p>
            <input type="checkbox" name="autoridade[]" value="3" id="tutoriais"/><label class="label-checkbox" for="tutoriais">Escritor de tutoriais</label>
        </p>
        <p>
            <input type="checkbox" name="autoridade[]" value="4" id="normal" checked="checked"/><label class="label-checkbox" for="normal">Usuário do laboratório</label>
        </p>
        <p>
            <input type="checkbox" name="autoridade[]" value="5" id="ambientes"/><label class="label-checkbox" for="ambientes">Gerente de ambientes</label>
        </p>        
    </fieldset>
    
    <fieldset class="bts">
        <button type="submit">Salvar</button>
        <button type="reset">Limpar</button>
    </fieldset>

</form>