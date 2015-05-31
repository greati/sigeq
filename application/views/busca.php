<!-- search bar -->
<form id="page-search-form" method="get" action="<?php echo base_url() ?>busca">
        <input type="text" name="q" placeholder="Digite um termo">
        <button>Buscar</button>
</form>

<nav id="nav-abas-search">
    <ul>
        <li><a href="#">Equipamentos</a></li>
        <li><a href="#">Tutoriais</a></li>
        <li><a href="#">Ambientes</a></li>
    </ul>
    <div class="clear"></div>
</nav>

<section class="tab-search">
    <?php if(isset($equips)) {?>
    <nav>
        <ul>
    <?php foreach($equips as $e) {?>
            <li><a href=""><?php echo $e->nome ?></a>
    <?php }?>
        </ul>
    </nav>
    <?php }else if(!isset($equips)){?>
        <p>Nenhum resultado.</p>
    <?php }?>
</section>

<section class="tab-search">
    <?php if(isset($tuts)) {?>
    <nav>
        <ul>
    <?php foreach($tuts as $t) {?>
            <li><a href=""><?php echo $t->nome ?></a>
    <?php }?>
        </ul>
    </nav>
    <?php }else if(!isset($tuts) || empty($tuts)){?>
        <p>Nenhum resultado.</p>
    <?php }?>
</section>

<section class="tab-search">
    <?php if(isset($ambs)) {?>
    <nav>
        <ul>
    <?php foreach($ambs as $a) {?>
            <li><a href=""><?php echo $a->nome ?></a>
    <?php }?>
        </ul>
    </nav>
    <?php }else if(!isset($ambs) || empty($ambs)){?>
        <p>Nenhum resultado.</p>
    <?php }?>
</section>