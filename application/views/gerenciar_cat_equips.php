<!-- 
    Existe uma variável chamada $objeto, que identifica se serão gerenciadas
    categorias de ambientes, equipamentos ou tutoriais. 

    Valores possíveis: tuts, equips, ambs

-->

<form method="post">
    <fieldset>
        <legend>Editor de categoria</legend>
        <?php echo form_error('nome') ?>
        <p>
            <label for="nome">Nome</label><input type="text" id="nome" name="nome" placeholder="Nome da categoria" value="<?php echo $c->nome ?>"/>
        </p>
            
        <?php echo form_error('descricao') ?>
        <p>
            <label for="descricao">Descrição</label><textarea name="descricao" id="descricao"><?php echo $c->descricao ?></textarea>        
        </p>
    </fieldset>
    <fieldset class="bts">
        <button id="btSalvar">Salvar</button>
    </fieldset>
</form>

<table>
    <tr>
        <th>Nome</th>
        <th class="appear-medium">Descrição</th>
        <th></th>
        <th></th>
    </tr>

    <?php foreach ($cats as $c) {?>
    
        <tr>
            <td><?php echo $c->nome ?></td>
            <td class="appear-medium"><?php echo $c->descricao ?></td>
            <td><a href="<?php echo base_url() ?>admin/<?php echo $objeto ?>/cats/<?php echo $c->id?>"><i class="fa fa-wrench"></i></a></td>
            <td><a href="<?php echo base_url() ?>admin/<?php echo $objeto ?>/cats/delete/<?php echo $c->id?>"><i class="fa fa-remove"></i></a></td>
        </tr>
    
    <?php } ?>		

</table>