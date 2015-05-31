<?php foreach($tutoriais as $t){ ?>

    <article class="tut-list-item">
        <header>
            <h3><a href="tuts/<?php echo $t->id ?>"><i class="fa fa-file-text-o"></i><?php echo $t->titulo ?></a></h3>
            <div class="info_tutorial">
                <address>Publicado por <?php echo $t->editores->nome ?></address>
                <span class="data_tutorial">Em <?php echo $t->created ?></span>
            </div>
        </header>
    </article>

<?php } ?>