<?php foreach($equipamentos as  $e) {?>
    <article class="equip-list-item">
        <header role="banner">
            <h3><a href="<?php echo base_url(); ?>equips/<?php echo $e->id ?>"><?php echo $e->nome ?></a></h3>
        </header>

        <!--<img src="<?php echo base_url();?>assets/images/equips/<?php echo $e->id ?>.jpg" alt="Estufa"/>-->
        
        <div class="equip-img">
            <img src="http://www.comercialcellab.com.br/image/AY.jpg" alt="Estufa"/>
        </div>
            
        
        <div class="info_equipamento" role="main">
            <h6>Tombamento</h6>
            <p><?php echo $e->tombamento ?></p>
            <h6>Localização</h6>    
            <p>Laboratório de Química</p>
        </div>
        
        <footer role="contentinfo">
            <h6>Categoria:</h6> <?php echo $e->categoria->nome ?>
        </footer>
    </article>			
<?php } ?>
