<script type="text/javascript">
    var idAmb = <?php echo $l->ambiente->id ?>;
    var idLoc = <?php echo $l->id ?>;
</script>

<form method="post" action="#">
        <p>  
            <label for="nome">Nome:</label><input id="nome" type='text' name='nome' value="<?php echo $l->nome ?>"/>
        </p>
        <p>
            <label for="descricao_loc">Descrição:</label><textarea id="descricao_loc" name='descricao_loc'><?php echo $l->descricao ?></textarea>
        </p>

        <div id='panel-location' style='display:block'>
            <table>
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nome</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($equipsRelated as $eq) {?>
                        <tr>
                            <td><?php echo $eq->id ?></td>
                            <td><a href="#"><?php echo $eq->nome ?></a></td>
                            <td><a class='delete' href="#"><i class='fa fa-remove'></i></a></td>
                        </tr>
                    <?php }?>
                </tbody>
            </table>                    

            <select id="select-equip">
                <?php foreach($equipamentos as $e) {?>
                    <option value="<?php echo $e->id ?>"><?php echo $e->nome ?></option>
                <?php }?>
            </select>
            <button type="button" id="add-equip"><i class="fa fa-plus"></i></button>

            <input type='hidden' name='mode' value='edit'/>

            <fieldset class="bts">
                <button type='button' id="salvar">Salvar</button>
                <button type='button' id="cancelar">Cancelar</button>
            </fieldset>
        </div>
</form>