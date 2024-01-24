<?php 
require_once('templates/header.php');
 require_once("models/User.php");
 require_once("dao/UserDAO.php");
 require_once("dao/MangaDao.php ");
require_once("globals.php");
$user = new User();
$mangaDao = new MangaDao($conn,$BASE_URL);
$userDao = new UserDao($conn,$BASE_URL);

//Receber id do usuário
$id = filter_input(INPUT_GET, "id");
if(empty($id)){
    if(!empty($userData)){
        $id = $userData->id;
    }else{
        $message->setmessage("Usuário não encontrado!","error","index.php");
    }

}else{
    $userData = $userDao->findbyId($id);
    if(!$userData){
        //Se não encontrar usuário
        $message->setmessage("Usuário não encontrado!","error","index.php");
    }

}

$fullName = $user->getFullName($userData);

  if($userData->image == "") {
    $userData->image = "usuario.jpg";
  }
//Mangas que o usuario adicionou
$userManga = $mangaDao->getMangasId($id);

 ?>
 <div id="main-container" class="container-fluid">
    <div class="col-md-8 offset-md-2">
        <div class="row profile-container">
            <div class="col-md-12 about-container">
                <h1 class="page-title">
                    <?=$fullName ?></h1>
                    <div id="profile-image-container" class="profile-image" style="background-image: url('img/usuarios/<?= $userData->image ?>')">

                    </div>
                  
                    <h3 class="about-title">Sobre:</h3>
                    <?php if(!empty($userData->bio) ):?>
                        <p class="profile-description"><?=$userData->bio  ?></p>
                        <?php else: ?>
                            <p class="profile-description">O usuario ainda não colocou nenhuma bio</p>
                        <?php endif;?>
                    
            </div>

            <div class="col-md-12 added-mangas-container">
                <h3>Mangás que o o usuário adicionou:</h3>
                <div class="mangas-container">

                <?php foreach ($userManga as $manga):?>
                    <?php require('templates/manga_card.php'); ?>

                   <?php endforeach; ?> 

                  <?php if(count($userManga)===0): ?>
                    <p class="empty-list"> O usuario ainda não enviou mangás</p>
                <?php endif; ?> 
                </div>
            </div>
        </div>
    </div>
</div>   
<?php require_once('templates/footer.php')?>