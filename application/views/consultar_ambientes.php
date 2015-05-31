<?php foreach($ambientes as  $a) {?>
    <article class="equip-list-item">
        <header role="banner">
            <h3><a href="<?php echo base_url(); ?>ambs/<?php echo $a->id ?>"><?php echo $a->nome ?></a></h3>
        </header>

        <!--<img src="<?php echo base_url();?>assets/images/equips/<?php echo $e->id ?>.jpg" alt="Estufa"/>-->
        
        <div class="equip-img">
            <img src="http://www.comercialcellab.com.br/image/AY.jpg" alt="Estufa"/>
        </div>
        
        <div class="info_equipamento" role="main">
            <h6>Equipamentos(<?php echo $countEquips ?>)</h6>
            <p>                       
                <?php
                    $count = 0;
                    foreach($a->localizacoes as $l){
                        foreach($l->equipamentos as $e){
                            if($count<=5){
                                echo "<a href=''>$e->nome</a>";
                                $count++;
                            }else{
                                break;
                            }
                        }
                        if($count>5) break;
                    }
                ?>
            </p>
        </div>
        
        <footer role="contentinfo">
            <h6>Categoria:</h6> <?php echo $a->categoria->nome ?>
        </footer>
    </article>			
<?php } ?>