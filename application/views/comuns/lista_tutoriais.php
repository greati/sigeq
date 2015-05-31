<?php foreach($tutoriais as $t){ ?>

    <article class="tutorial">
        <header>
            <a href="tuts/<?php echo $t->id ?>"><h1><?php echo $t->titulo ?></h1></a>
            <div class="info_tutorial">
                <address>Publicado por <?php echo $t->editores->nome ?></address><span class="data_tutorial"><?php echo $t->created ?></span>
            </div>
        </header>
        <p>
            <?php echo $t->texto ?>
        </p>
    </article>

<?php } ?>