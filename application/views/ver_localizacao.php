<article class="localizacao">
    <header>
        <h3><i class="fa fa-map-marker"></i><?= $l->nome ?></h3>
        <h4>Em: <a href=""><?php echo $l->ambiente->nome ?></a></h4>
    </header>
    
    <section>
        <h5>Descrição</h5>
        <p class="descricao">
            <?php echo $l->descricao ?>
        </p>
    </section>
    
    <section>
    <h5>Local exato</h5>
        <div id="mapa-ambiente">
            <img id="mapa-img" 
                src="http://www.cazaincorporacoes.com.br/sites/default/files/styles/media_gallery_large/public/Planta%20baixa%2057m2-Model.png" 
                alt="Mapa do ambiente"/>

            <a class="localizacao" style="position:absolute;" href="#" data-ratiox = "<?php echo $l->ratioX ?>" data-ratioy = "<?php echo $l->ratioY ?>"><i class="fa fa-map-marker"></i></a>
        </div>
    </section>
    
    <section>
        <h5>Equipamentos presentes</h5>
        <table>
            <tr>
                <th>Nome</th>
                <th class="appear-high">Fabricante</th>
                <th class="appear-medium">Tombamento</th>
                <th class="appear-medium">Categoria</th>
                <th class="appear-medium">Quantidade</th>
                <th></th>
    <!--            <th></th>
                <th></th>-->
            </tr>

            <?php foreach ($l->equipamentos as $e) {?>
                <tr>
                    <td><?php echo $e->nome ?></td>
                    <td class="appear-high"><?php echo $e->fabricante ?></td>
                    <td class="appear-medium"><?php echo $e->tombamento ?></td>
                    <td class="appear-medium"><?php echo $e->categoria->nome ?></td>
                    <td class="appear-medium"><?php echo $e->quantidade ?></td>
                    <td><a href="equips/<?php echo $e->id ?>"><i class="fa fa-info"></i></a></td>
    <!--            <td><a href="equips/edit/<?php echo $e->id ?>"><i class="fa fa-wrench"></i></a></td>
                    <td><a href="equips/delete/<?php echo $e->id ?>"><i class="fa fa-remove"></i></a></td>-->
                </tr>

            <?php } ?>				
        </table>
    </section>
</article>
