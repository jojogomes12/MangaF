<?php 
require_once('templates/header.php');
 require_once("models/User.php");
 require_once("dao/UserDAO.php");
//veirifica se usuario está autenticado
 $user = new User();

 $userDao = new UserDao($conn, $Base_URL);

 $userData = $userDao->verifyToken(true);
?>
<div id="main-container" class="container-fluid">
<div  class="offset-md-4 col-md-4 new-manga-container">
    <h1 class="page-title">Adicionar Mangá!</h1>
    <p class="page-description">Adicione sua critica e compartilhe com o mundo!</p>
    <form action="manga_process.php" id="add-manga-form" method="post" enctype="multipart/form-data">
        <input type="hidden" name="type" value="create">
        <div class="form-group">
        <label for="tittle"> Titulo</label>
        <input type="text" class="form-control" id="title" name="title" placeholder="Digite o titulo do mangá">
        </div>

        <div class="form-group">
        <label for="image"> Imagem</label>
       <input type="file" class="form-control-file" name="image" id="image">
        </div>
        
        <div class="form-group">
        <label for="length"> Capitulos:</label>
       <input type="text" class="form-control" name="length" id="length" placeholder="Digite a quantidade de capitulos">
        </div>

        <div class="form-group">
        <label for="category"> Categoria</label>
   <select name="category" id="category" class="form-control">
    <option value="">Selecione</option>
    <option value="Shounem">Shounem</option>
    <option value="Seinem">Seinem</option>
    <option value="Shoujo">Shoujo</option>
    <option value="Slice of life">Slice of life</option>
   </select>
    </div>

    <div class="form-group">
        <label for="link"> Link:</label>
       <input type="text" class="form-control" name="link" id="link" placeholder="Adicione o Link para o capitulo">
        </div>
    <div class="form-group">
        <label for="description"> Descrição:</label>
        <textarea name="description" id="description" rows="5" class="form-control" placeholder="Digite a sinopse do mangá"></textarea>
        </div>
        <input type="submit" class="btn card-btn" value="enviar"  id="card-btn">
    </form>
</div>
</div>   
<?php require_once('templates/footer.php')?>
