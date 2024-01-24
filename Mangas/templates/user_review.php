<?php

    require_once("./models/User.php");

    $userModel = new User();

    $fullName = $userModel->getFullName($review->user_id);

    // Checar se o filme tem imagem
    if($review->user_id->image == "") {
      $review->user_id->image = "usuario.jpg";
    }

?>
<div class="col-md-12 review">
  <div class="row">
    <div class="col-md-1">
      <div class="profile-image-container review-image" style="background-image: url('./img/usuarios/<?= $review->user_id->image ?>')"></div>
    </div>
    <div class="col-md-9 author-details-container">
      <h4 class="author-name" id="author-name">
        <a href="<?= $BASE_URL ?>profile.php?id=<?= $review->user_id->id ?>"><?= $fullName ?></a>
      </h4>
      <p><img src="img/abra-o-livro.png" class="img-fluid" alt=""> <?= $review->rating ?></p>
    </div>
    <div class="col-md-12">
      <p class="comment-title">Comentário:</p>
      <p><?= $review->review ?></p>
    </div>
  </div>
</div>