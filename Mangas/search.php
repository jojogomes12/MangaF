<?php require_once('templates/header.php');
require_once('dao/MangaDao.php');
//Dao dos Mangas

$mangaDao= new MangaDao($conn,$Base_URL);

//Resgata busca do usuário
$q = filter_input(INPUT_GET, "q");

$Mangas= $mangaDao->findBytitle($q);
?>
<div id="main-container" class="container-fluid">
    <h2 class="section-title" id="search-title">Você está buscando por: <span id="search-result"><?=$q ?></span></h2>
    <p class="section-description">Resultados da sua busca:</p>
    <div class="mangas-conteiner">
        <?php  foreach($Mangas as $manga) :?>
          
            <?php require('templates/manga_card.php') ?>
            <?php endforeach; ?>
           <?php if(count($Mangas)==0): ?>
            <p class="empty-list">Não há mangás com esse nome <a class="back-link" href="./index.php">Voltar </a></p>
            <?php endif ?>

    </div>
</div>      
<?php require_once('templates/footer.php')?>
