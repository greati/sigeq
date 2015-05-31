

<?php foreach($equipamentos as  $e) {?>
    <article class="equipamento">
        <header>
            <a href="ver_equipamento.html"><h1><?php echo $e->nome ?><span>Tombamento: <?php echo $e->tombamento ?></span></h1></a>
            <div class="info_equipamento">
                <span class="fabricante">Fabricante: <?php echo $e->fabricante ?></span><span class="categoria">Categoria: <?php echo $e->categoria->nome ?></span>
            </div>
        </header>

        <img src="<?php echo base_url();?>assets/images/equips/<?php echo $e->id ?>.jpg" alt="Estufa"/>

        <h2>Descrição</h2>
        <p class="descricao">
            <?php echo $e->descricao ?>
        </p>
    </article>			
<?php } ?>