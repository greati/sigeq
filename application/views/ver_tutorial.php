<article class="tutorial">
    <header>
        <h3><?= $t->titulo ?></h3>
    </header>
    <footer>
            <address>Publicado por <?php echo $t->editores->nome ?></address>, em <span class="data_tutorial"><?php echo $t->created ?></span>
    </footer>
    
    <p>
        <?php echo $t->texto ?>
    </p>
</article>