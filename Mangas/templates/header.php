<?php
require_once('./globals.php');
require_once('./config.php');
require_once('./models/message.php');
require_once('./dao/UserDao.php');

$message = new Message($Base_URL);
$flashMessage= $message->getmessage();
if(!empty($flashMessage['msg'])){

    //Limpar a mensagem
    $message->clearmessage();
}
$userDao = new UserDao($conn,$Base_URL);
$userData=$userDao->verifyToken(false);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mangás-fã</title>
    <!--Css do projeto-->
    <link rel="stylesheet" href="<?=$Base_URL?>css/style.css">
    <link rel="short icon" href="<?=$Base_URL?>img/open-book.png">
    <!--Bootstrap css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.3/css/bootstrap.css" integrity="sha512-bR79Bg78Wmn33N5nvkEyg66hNg+xF/Q8NA8YABbj+4sBngYhv9P8eum19hdjYcY7vXk/vRkhM3v/ZndtgEXRWw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.css" integrity="sha512-FA9cIbtlP61W0PRtX36P6CGRy0vZs0C2Uw26Q1cMmj3xwhftftymr0sj8/YeezDnRwL9wtWw8ZwtCiTDXlXGjQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://example.com/fontawesome/v6.2.1/js/fontawesome.js" data-auto-replace-svg="nest"></script>
<script src="https://example.com/fontawesome/v6.2.1/js/solid.js"></script>
<script src="https://example.com/fontawesome/v6.2.1/js/brands.js"></script>

</head>
<body>

     <!-- Header Perfeito-->

     <header>
    <nav id="main-navbar" class="navbar navbar-expand-lg">
      <a href="<?= $BASE_URL ?>" class="navbar-brand">
        <img src="<?= $BASE_URL ?>img/open-book.png" alt="MangaF" id="logo">
        <span id="mangaF-title">MangáF</span>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-bars"></i>
      </button>
      
      <form action="<?= $BASE_URL ?>search.php" method="GET" id="search-form" class="form-inline my-2 my-lg-0">
      <button class="btn my-2 my-sm-0" id="search-button" type="submit">Buscar
          
        </button>
        <input type="text" name="q" id="search" class="form-control mr-sm-2" type="search" placeholder="Buscar mangas" aria-label="Search">
        
       
      </form>
      <div class="collapse navbar-collapse" id="navbar">
        <ul class="navbar-nav">
          <?php if($userData): ?>
            <li class="nav-item">
              <a href="<?= $BASE_URL ?>newmanga.php" class="nav-link">
                <i class="far fa-plus-square"></i> Incluir Manga
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= $BASE_URL ?>dashboard.php" class="nav-link">Meus Mangas</a>
            </li>
            <li class="nav-item">
              <a href="<?= $BASE_URL ?>editprofile.php" class="nav-link bold">
              <div id="image-icon"><img src="./img/usuarios/<?=$userData->image ?> "alt=""> <?=$userData->name ?> </div>
                
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= $BASE_URL ?>logout.php" class="nav-link">Sair</a>
            </li>
          <?php else: ?>
            <li class="nav-item">
              <a href="<?= $BASE_URL ?>auth.php" class="nav-link">Entrar / Cadastrar</a>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    </nav>
  </header>
  <?php if(!empty($flashMessage["msg"])): ?>
    <div class="msg-container">
      <p class="msg <?= $flashMessage["type"] ?>"><?= $flashMessage["msg"] ?></p>
    </div>
  <?php endif; ?>
     <!-- Header Perfeito-->
    
    