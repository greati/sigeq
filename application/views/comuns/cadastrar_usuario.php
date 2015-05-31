<form method="post" action="new/do">
    <p>
        <label for="nome_usu">Nome</label><input type="text" name="nome" id="nome_usu" placeholder=""/>
    </p>

    <p>
        <label for="email_usu">E-mail</label><input type="text" name="email" id="email_usu" placeholder=""/>
    </p>

    <p>
        <label for="login">Login</label><input type="text" name="login" id="login" placeholder=""/>
    </p>

    <p>
        <label for="senha">Senha</label><input type="password" name="senha" id="senha" placeholder=""/>
    </p>				

    <p class="checkbox_set">
        <label class="titulo_set">Autoridades</label>
        <input type="checkbox" name="autoridade[]" value="1" id="super"/><label for="super">Gerente de usuários</label>
        <input type="checkbox" name="autoridade[]" value="2" id="equip"/><label for="equip">Gerente de equipamentos</label>
        <input type="checkbox" name="autoridade[]" value="3" id="tutoriais"/><label for="tutoriais">Escritor de tutoriais</label>
        <input type="checkbox" name="autoridade[]" value="4" id="normal"/><label for="normal">Usuário do laboratório</label>
    </p>

    <p class="button_group">
        <button type="submit">Salvar</button>
        <button type="reset">Limpar</button>
    </p>

</form>