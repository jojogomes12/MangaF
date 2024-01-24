<?php 
require_once('templates/header.php');
require_once('globals.php');
 require_once("models/User.php");
 require_once("dao/UserDAO.php");
require_once("models/manga.php");
 require_once("dao/MangaDao.php");
 require_once("dao/ReviewDao.php");
$userDao = new UserDao($conn, $BASE_URL);


//veirifica se usuário está autenticado
$id = filter_input(INPUT_GET,"id");
$manga="";
$mangaDao = new MangaDao($conn,$BASE_URL);
$reviewDao = new ReviewDao($conn,$BASE_URL);
if(empty($id)){

    $message->setmessage("O mangá não foi encontrado!","error","index.php");
    
}
else{
    $manga = $mangaDao->findByid($id);
    //Verifica se usuário existe
    
    if(!$manga){
        $message->setmessage("O mangá não foi encontrado!","error","index.php");
    }
}
//Checar se o Mangá tem imagem

if($manga->image == "") {
    $manga->image = "mangá.jpg";
  }



//Checar se o filme é do usuário 
$userOwnsManga = false;

if(!empty($userData)){
    if($userData->id===$manga->user_id){

       
        $userOwnsManga = true; 

    }
    
  // Resgatar as revies do filme
  $alreadyreviews = $reviewDao->hasalreadyreview($id, $userData->id);
 
}


//Resgatar as reviews dos mangás
$mangaReviews=$reviewDao->getMangaReviews($manga->id);



?>
<div id="main-container" class="container-fluid">
    <div class="row">
<div class="offset-md-1 col-md-6 manga-container">
    <h1 class="page-title"><?= $manga->title?></h1>
    <p class="manga-details">
       <span>Capitulos: <?= $manga->chapters ?></span>
       <span class="pipe"></span>
       <span><?=$manga->category ?></span>
       <span class="pipe"></span>
       <span><img src="img/abra-o-livro.png" class="img-fluid" alt=""><?= $manga->rating ?> </span> 
    </p>
   <img src="img/mangas/<?=$manga->image ?>"class="img-fluid" width="560" height="315" alt="Responsive image">
   <p> <?= $manga->descrition?></p>
   
</div>
<div class="offset-md-1 col-md-4" id="reviews-container">
   <h3 class="review-title">Avaliações</h3>
   <!--- Verifica se habilita review para o usuario ou não --->
   <?php if(!empty($userData) && !$userOwnsManga && !$alreadyreviews): ?>
   <div class="col-md-12" id="review-form-container">
    <h4>Envie sua avaliação:<h4>
        <p class="page-description">Preencha o formulario com a nota e comentario sobre o mangá</p>
        <form action="review_process.php" id="review-form" method="post">
            <input type="hidden" name="type" value="Create">
            <input type="hidden" name="mangas_id" value="<?=$manga->id ?>">
            <div class="form-group">
                <label for="rating">Nota do mangá:</label>
                <select class="form-control" name="rating" id="rating">

                <option value="">Selecione</option>
                <option value="10">10</option>
                <option value="9">9</option>
                <option value="8">8</option>
                <option value="7">7</option>
                <option value="6">6</option>
                <option value="5">5</option>
                <option value="4">4</option>
                <option value="3">3</option>
                <option value="2">2</option>
                <option value="1">1</option>
                </select>

            </div>
            <div class="form-group">
                <label for="review">Seu comentario:</label>
                <textarea name="review" id="review"  rows="3" class="form-control" placeholder="Coloque aqui seu comentario"></textarea>
            </div>
            <input type="submit" class="card-btn" value="Enviar Comentario">
        </form>
   </div>
   <?php endif; ?>

   <!--Comentarios -->
    <!-- Comentários -->
    <?php foreach($mangaReviews as $review): ?>
        <?php require("templates/user_review.php"); ?>
      <?php endforeach; ?>
      <?php if(count($mangaReviews) == 0): ?>
        <p class="empty-list">Não há comentários para este mangá ainda...</p>
      <?php endif; ?>
    </div>
  </div>
</div>
<?php 
require_once('templates/footer.php');?>