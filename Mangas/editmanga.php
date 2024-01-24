<?php 
require_once('templates/header.php');
 require_once("models/User.php");
 require_once("dao/UserDAO.php");
 require_once("dao/MangaDao.php ");
//veirifica se usuario está autenticado
 $user = new User();

 $userDao = new UserDao($conn, $Base_URL);
$mangaDao = new MangaDao($conn, $Base_URL);
$id = filter_input(INPUT_GET, "id");
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

 $userData = $userDao->verifyToken(true);
 if($manga->image == "") {
    $manga->image = "mangá.jpg";
  }

?>


<div id="main-container" class="container-fluid">
<div class="col-md-12">
    <div class="row">
        <div class="col-md-6 offset-col-md-1">
            <h1><?= $manga->title ?></h1>
            <p class="page-description">Altere os Dados do mangá no formulário abaixo:</p>
            <form id="edit-manga-form" action="manga_process.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="type" value="update">
            <input type="hidden"  name="id" value="<?= $manga->id?>"  id="id">
        <div class="form-group">
        <label for="tittle"> Titulo</label>
        <input type="text" class="form-control" id="title" name="title" value="<?=$manga->title ?>" placeholder="Digite o titulo do mangá">
        </div>

        <div class="form-group">
        <label for="image"> Imagem</label>
       <input type="file" class="form-control-file" value="<?=$manga->image ?>" name="image" id="image">
        </div>
        
        <div class="form-group">
        <label for="length"> Capitulos:</label>
       <input type="text" class="form-control" name="length" value="<?=$manga->chapters ?>" id="length" placeholder="Digite a quantidade de capitulos">
        </div>

        <div class="form-group">
        <label for="category"> Categoria</label>
   <select name="category"  id="category" class="form-control">
    <option value="">Selecione</option>
    <option value="Shounem" <?=$manga->category==="Shounem" ? "selected":" " ?>>Shounem</option>
    <option value="Seinem" <?=$manga->category==="Seinem" ? "selected":" " ?>>Seinem</option>
    <option value="Shoujo" <?=$manga->category==="Shoujo" ? "selected":" " ?>>Shoujo</option>
    <option value="Slice of life" <?=$manga->category==="Slice of life" ? "selected":" " ?>>Slice of life</option>
   </select>
    </div>

    <div class="form-group">
        <label for="link"> Link:</label>
       <input type="text" class="form-control" name="link" id="link" value="<?=$manga->link ?>" placeholder="Adicione o Link para o capitulo">
        </div>

    <div class="form-group">
        <label for="description"> Descrição:</label>
        <textarea name="description" id="description"  rows="5" class="form-control" placeholder="Digite a sinopse do mangá"> <?=$manga->descrition ?></textarea>
        </div>
        <input type="submit" class="btn card-btn" value="enviar"  id="card-btn">
        

            </form>
        </div>
        
        <div class="col-md-6"  id="edit-card">
        <div id="card-content">
        <img  class="img-fluid" src="img/mangas/<?=$manga->image ?>" alt="">
        <div class="card-title"><h2><?=$manga->title ?></h2></div>
        <h3>Capitulos:<?= $manga->chapters?> </h3>
        <h4><?=$manga->descrition ?></h4>
        </div>
    </div>
    </div>
    
</div>

</div>   
<?php require_once('templates/footer.php')?>