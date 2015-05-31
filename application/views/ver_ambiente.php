<article class="ambiente">
    <header>
        <h3><?= $a->nome ?></h3>
        <a href="#"><?php echo $a->categoria->nome ?></a>
    </header>
    
    <section>
        <h4>Descrição</h4>
        <p class="descricao"><?php echo $a->descricao ?></p>
    </section>
    
    <section>
        <h4>Mapa do ambiente</h4>
        <div id="mapa-ambiente">
            <img id="mapa-img" 
                src="http://www.cazaincorporacoes.com.br/sites/default/files/styles/media_gallery_large/public/Planta%20baixa%2057m2-Model.png" 
                alt="Mapa do ambiente" usemap="#mapa-ambiente"/>

            <?php foreach($localizacoes as $l){ ?>
                <a id="ml<?php echo $l->id ?>" class="localizacao" style="position:absolute;" href="#" data-ratiox = "<?php echo $l->ratioX ?>" data-ratioy = "<?php echo $l->ratioY ?>"><i class="fa fa-map-marker"></i></a>
            <?php } ?>
        </div>
        
        <table id="localizacoes">
            <thead>
                <tr>
                    <th>Local</th>
                    <th class="appear-medium">Descricão</th>
                    <th>Equipamentos</th>
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
                </tr>
                <?php
            }
            ?>
        </table>
        
    </section>
    
    <section>
        <h4>Equipamentos presentes</h4>
        <ul id="equipamentos_presentes">
            <?php 
            foreach($localizacoes_c_equips as $l) {
                if($l->equipamentos->nome != ""){
                ?>
                    <li><a href="#"><?php echo $l->equipamentos->nome ?></a></li>
                <?php
                }
            }
            ?>
        </ul>
    </section>
    
</article>