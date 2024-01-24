<?php 
 require_once("globals.php");
 require_once("config.php");
 require_once("models/manga.php");
 require_once("models/Message.php");
 require_once("dao/MangaDao.php");
 require_once("dao/UserDao.php");
 $message = new Message($BASE_URL);
$userDao = new UserDao($conn, $BASE_URL);
 $mangaDao = new MangaDao($conn, $BASE_URL);
 $userData = $userDao->verifyToken(true);
// Resgata o tipo do formulário
$type = filter_input(INPUT_POST, "type");

 // Cadastra Mangá
if ($type === "create") {
    $manga = new Manga();
// Receber dados do post
$title = filter_input(INPUT_POST, "title");
$chapters = filter_input(INPUT_POST, "length");
$category = filter_input(INPUT_POST, "category");
$description = filter_input(INPUT_POST, "description");
$link=filter_input(INPUT_POST, "link");

if(!empty($title) && !empty($chapters) && !empty($category)){
        $manga->title = $title;
        $manga->chapters = $chapters;
        $manga->category = $category;
        $manga->descrition = $description;
        $manga->link=$link;
        $manga->user_id = $userData->id;
        //Upload de imagem do filme
        if(isset($_FILES['image']) && !empty($_FILES['image']['tmp_name'])){
            $image = $_FILES['image'];
            $imageTypes = ["image/jpeg", "image/jpg", "image/png"];
            $jpgArray = ["image/jpeg", "image/jpg"];
            //Checando o tipo de imagem
            if(in_array($image['type'],$imageTypes)){
                $imageFile = imagecreatefromjpeg($image['tmp_name']);
                //Gerando nome da imagem
                $imageName = $manga->imageGenerateName();
                imagejpeg($imageFile, "img/mangas/".$imageName,100);
                $manga->image = $imageName;

            }else{
                $message->setmessage("Não aceitamos esse tipo de arquivo!","error","back");
            }
           
        }
      
        $mangaDao->create($manga);

}


else{
    $message->setmessage("Insira dados restantes!","error","back");
}

}
elseif($type==="delete"){
 // Recebe os dados do form
 $id = filter_input(INPUT_POST, "id");

 $manga = $mangaDao->findById($id);

 if($manga) {

   // Verificar se o filme é do usuário
   if($manga->user_id === $userData->id) {

     $mangaDao->destoy($manga->id);

   } else {

     $message->setMessage("Informações inválidas!", "error", "index.php");

   }

 } else {

   $message->setMessage("Informações inválidas!", "error", "index.php");

 }
}
elseif($type==='update'){
    $manga = new Manga();
    // Receber dados do post
    $title = filter_input(INPUT_POST, "title");
    $chapters = filter_input(INPUT_POST, "length");
    $category = filter_input(INPUT_POST, "category");
    $description = filter_input(INPUT_POST, "description");
    $link=filter_input(INPUT_POST, "link");
    $id = filter_input(INPUT_POST, "id");    
    $mangaData = $mangaDao->findByid($id);
    if(!empty($title) && !empty($chapters) && !empty($category)){
//Verifica se encontrou um filme
if($mangaData){
            if ($mangaData->user_id === $userData->id) {
                //Edição do filme
                $mangaData->title = $title;
                $mangaData->chapters = $chapters;
                $mangaData->descrition = $description;
                $mangaData->category = $category;
                $mangaData->link=$link;
                //Upload de imagem do filme
                if(isset($_FILES['image']) && !empty($_FILES['image']['tmp_name'])){
                    $image = $_FILES['image'];
                    $imageTypes = ["image/jpeg", "image/jpg", "image/png"];
                    $jpgArray = ["image/jpeg", "image/jpg"];
                    //Checando o tipo de imagem
                    if(in_array($image['type'],$imageTypes)){
                        $imageFile = imagecreatefromjpeg($image['tmp_name']);
                        //Gerando nome da imagem
                        $imageName = $manga->imageGenerateName();
                        imagejpeg($imageFile, "img/mangas/".$imageName,100);
                        $mangaData->image = $imageName;
        
                    }else{
                        $message->setmessage("Não aceitamos esse tipo de arquivo!","error","back");
                    }
                   
                }
                $mangaDao->update($mangaData);

                }

                
            }
            else{
                $message->setMessage("Informações inválidas!", "error", "index.php");

            }
}




else{
    $message->setmessage("Voce precisa adicionar Mais campos!","error","back");


}


}


else{
    $message->setmessage("Faça login!","error","index.php");
}
?>