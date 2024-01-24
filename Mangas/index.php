<?php require_once('templates/header.php');
require_once('dao/MangaDao.php');
//Dao dos Mangas

$mangaDao= new MangaDao($conn,$Base_URL);
$latestMangas = $mangaDao->getLastedMangas();
$shounemMangas = $mangaDao->getMangasbycategory('Shounem');
$seinemMangas = $mangaDao->getMangasbycategory('Seinem');
$sliceMangas = $mangaDao->getMangasbycategory('Slice of life');


?>
<div id="main-container" class="container-fluid">
    <h2 class="section-title">Mangás Novos</h2>
    <p class="section-description">Veja as criticas dos últimos Mangás adicionados no Mangás fã</p>
    <div class="mangas-conteiner">
        <?php  foreach($latestMangas as $manga) :?>
          
            <?php require('templates/manga_card.php') ?>
            <?php endforeach; ?>
           <?php if(count($latestMangas)==0): ?>
            <p class="empty-list">Ainda não há mangas cadastrados</p>
            <?php endif ?>

    </div>
<h2 class="section-title">Shounem</h2>
    <p class="section-description">Veja as criticas dos últimos Shounem adicionados no Mangás fã</p>
    <div class="mangas-conteiner">
    <?php  foreach($shounemMangas as $manga) :?>
          
          <?php require('templates/manga_card.php') ?>
          <?php endforeach; ?>
           <?php if(count($shounemMangas)==0): ?>
            <p class="empty-list">Ainda não há mangas cadastrados</p>
            <?php endif ;?>
            

    </div>   
 <h2 class="section-title">Seinem</h2>
    <p class="section-description">Veja as criticas dos últimos Seinem adicionados no Mangás fã</p>
    <div class="mangas-conteiner">

    <?php  foreach($seinemMangas as $manga) :?>
          
          <?php require('templates/manga_card.php') ?>
          <?php endforeach; ?>


 <?php if(count($seinemMangas)==0): ?>
            <p class="empty-list">Ainda não há mangas cadastrados</p>
            <?php endif ?>

 </div>

 <h2 class="section-title">Slice of life</h2>
    <p class="section-description">Veja as criticas dos últimos Slice of life adicionados no Mangás fã</p>
    <div class="mangas-conteiner">

    <?php  foreach($sliceMangas as $manga) :?>
          
          <?php require('templates/manga_card.php') ?>
          <?php endforeach; ?>


 <?php if(count($sliceMangas)==0): ?>
            <p class="empty-list">Ainda não há mangas cadastrados</p>
            <?php endif ?>

 </div>

    

</div>      
<?php require_once('templates/footer.php')?>
