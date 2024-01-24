<?php
if(empty($manga->image)){
    $manga->image = "mangá.jpg";
   
}
?>

<div class="card manga-card" id="manga-card" >

<div class=" card-img-top" style="background-image: url('img/mangas/<?=$manga->image ?>') "></div>
<div class="card-body">
   <p class="card-rating">
   <img src="img/open-book.png" width="14%" alt="">
   <span class="rating"><?=$manga->rating  ?></span>
   </p>
   <h5 class="card-title"><a href="manga.php?id=<?=$manga->id ?>"><?=$manga->title ?></a></h5>
   <a class="btn btn-primary rate-btn" href="manga.php?id=<?=$manga->id ?>" id="rate-btn">Avaliar</a>
   <a class="btn btn-primary card-btn" href="<?=$manga->link ?>">Conhecer</a>
</div>
</div>