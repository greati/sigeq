<?php echo form_open_multipart(base_url().'admin/ambs/edit/'.$a->id);?>
    
    <?php echo $error;?>

    <script type="text/javascript">
        var idAmb = <?php echo $a->id ?>;
    </script>
    
    <fieldset>
        <legend>Informações de acesso</legend>
        
        <?php echo form_error('nome') ?>
        <p>
            <label for="nome_amb">Nome</label><input type="text" name="nome" id="nome_amb" placeholder="" value="<?php echo $a->nome ?>"/>
        </p>
        
        <?php echo form_error('descricao') ?>        
        <p>
            <label for="descricao">Descrição</label><textarea name="descricao" id="descricao" placeholder="Descreva a localização e a função, principalmente"><?php echo $a->descricao ?></textarea>
        </p>
        
        <p>
            <label for="categoria_equip">Categoria</label>
            <select name="categoria" id="categoria_equip">
                <?php foreach($categorias as $cat){ ?>
                    <option value="<?php echo $cat->id ?>" <?php echo "checked" ? $a->categoria->nome === $cat->nome : "" ?>><?php echo $cat->nome?></option>
                <?php } ?>
            </select>
        </p>
        
    </fieldset>
    
    <fieldset>
        <legend>Mapa do ambiente</legend>
        
        <nav id="ambiente-pallet">
            <ul>
                <li><button type="button"><i class="fa fa-map-marker"></i></button></li>
                <li><button type="button"><i class="fa fa-map-marker"></i></button></li>
                <li><button type="button"><i class="fa fa-map-marker"></i></button></li>
            </ul>
        </nav>
        
        <noscript>
            <p>Ative o Javascript em seu browser para poder criar novas localizações.</p>
        </noscript>
        
        <?php if(file_exists("./assets/images/ambs/$a->id.jpg")) {?>
            <div id="mapa-ambiente">
                <img id="mapa-img" 
                    src="http://www.cazaincorporacoes.com.br/sites/default/files/styles/media_gallery_large/public/Planta%20baixa%2057m2-Model.png" 
                    alt="Mapa do ambiente" usemap="#mapa-ambiente"/>

                <?php foreach($localizacoes as $l){ ?>
                    <a class="localizacao" style="position:absolute;" href="#" data-ratiox = "<?php echo $l->ratioX ?>" data-ratioy = "<?php echo $l->ratioY ?>"><i class="fa fa-map-marker"></i></a>
                <?php } ?>
            </div>
        
            <table id="localizacoes">
                <thead>
                    <tr>
                        <th>Local</th>
                        <th class="appear-medium">Descricão</th>
                        <th>Equipamentos</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <?php 
                foreach($localizacoes as $l) {
                    ?>
                    <tr id="rl<?php echo $l->id ?>">
                        <td><a href="#"><?php echo $l->nome ?></a></td>
                        <td class="appear-medium"><?php echo $l->descricao ?></td>
                        <td>
                            <?php 
                            $e = new Equipamento_model();
                            $equipsRelated = $e->where_related('localizacoes',$l)->get(); ?>
                            <?php foreach($equipsRelated as $eq) {?>
                                <a href="#"><?php echo $eq->nome ?></a><br/>
                            <?php }?>
                        </td>
                        <td><i id="il<?php echo $l->id ?>" class="fa fa-map-marker"></i></td>
                        <td><a href="<?php echo base_url() ?>admin/ambs/<?php echo $a->id ?>/locs/edit/<?php echo $l->id ?>"><i id="il<?php echo $l->id ?>" class="fa fa-wrench"></i></a></td>
                        <td><a onclick="return confirm('Deseja mesmo realizar esta operação?')" href="<?php echo base_url() ?>admin/ambs/<?php echo $a->id ?>/locs/delete/<?php echo $l->id ?>"><i id="il<?php echo $l->id ?>" class="fa fa-remove"></i></a></td>
                    </tr>
                    <?php
                }
                ?>
            </table>
        
        <?php }else{?>
                <p>
                    <input type="file" name="userfile"/>
                </p>
        <?php }?>
        
    </fieldset>
    
    <fieldset class="bts">
        <button type="submit">Salvar</button>
        <button type="reset">Limpar</button>
    </fieldset>

</form>

<div id='panel-location' class="dialog">
   <form method="post" action="#">
        <p>  
            <label for="nome">Nome:</label><input id="nome" type='text' name='nome'/>
        </p>
        <p>
            <label for="descricao_loc">Descrição:</label><textarea id="descricao_loc" name='descricao_loc'></textarea>
        </p>

        <table>
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nome</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>                    

        <select id="select-equip">
            <option>Balança determinadora de umidade</option>
        </select>
        <button type="button" id="add-equip"><i class="fa fa-plus"></i></button>

        <fieldset class="bts">
            <button type='button' id="salvar">Salvar</button>
            <button type='button' id="cancelar">Cancelar</button>
        </fieldset>
   </form>
</div>