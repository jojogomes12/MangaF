<?php 
require_once('templates/header.php');
 require_once("models/User.php");
 require_once("dao/UserDAO.php");
require_once("dao/MangaDao.php");
require_once("dao/ReviewDao.php");



//veirifica se usuario está autenticado
 $user = new User();

 $userDao = new UserDao($conn, $Base_URL);

 $userData = $userDao->verifyToken(true);
 $mangaDao= new MangaDao($conn,$Base_URL);
$MangaUser = $mangaDao->getMangasId($userData->id);



?>
<div id="main-container" class="container-fluid">
<h2 class="section-title">Dashboard</h2>
<p class="section-description">Adicione ou atualize as informações dos mangás que você adicionou</p>
<div class="col-md-12" id="mangas-dashboard">
    <div class="col-md-12" id="add-manga-conteiner">
<a href="newmanga.php" class="btn card-btn"><i class="fas fa-plus"></i>Adicionar Mangá</a>

    </div>
<table class="table">
<thead>
    <th scope="col">#</th>
    <th scope="col">Titulo</th>
    <th scope="col">Nota</th>
    <th scope="col" class="actions-column" >Ações</th>
</thead>
<tbody>
<?php  foreach($MangaUser as $mUser):?>
    <tr >
     
    <td scope="row"><a href="#" class="table-manga-title"><?=$mUser->id ?></a></td>
    <td><a href="manga.php?id=<?=$mUser->id ?>" class="table-manga-title"><?=$mUser->title ?></a></td>
<td><img src="img/abra-o-livro.png" alt=""><?=$mUser->rating ?></td>
<td class="actions-column">
              <a href="<?= $BASE_URL ?>editmanga.php?id=<?= $mUser->id ?>" class="edit-btn">
                <i class="far fa-edit"></i> Editar
              </a>
              <form action="<?= $BASE_URL ?>manga_process.php" method="POST">
                <input type="hidden" name="type" value="delete">
                <input type="hidden" name="id" value="<?= $mUser->id ?>">
                <button type="submit" class="delete-btn">
                  <i class="fas fa-times"></i> Deletar
                </button>
              </form>
            </td>

    </tr>
    <?php endforeach ?>
</tbody>
</table>

</div>
</div>      
<?php require_once('templates/footer.php')?>