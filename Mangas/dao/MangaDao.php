<?php
require_once('./models/manga.php');
require_once('./models/message.php');
require_once('./dao/ReviewDao.php');
require_once('./models/review.php');
//ReviewDao
Class MangaDao implements MangasInterface{

    private $conn, $url,$message;

 public function __construct(PDO $conn,$url){
        $this->conn=$conn;
        $this->url =$url;
        $this->message = new Message($url);   

 }

	public function buildManga($data) {
                $review = new Review;
        $manga = new Manga;
        $manga->id = $data['ID'];
        $manga->user_id = $data['ID_Usuario'];
        $manga->title = $data['Titulo'];
        $manga->descrition = $data['Descricao'];
        $manga->category = $data['Categoria'];
        $manga->image = $data['imagem'];
        $manga->chapters = $data['Capitulos'];
        $manga->link = $data['Link'];
       // Retorna a rating do filme - fazer depois
      $reviewDao = new ReviewDAO($this->conn, $this->url);

      $rating = $reviewDao->getrating($manga->id);

      $manga->rating = $rating;
                  
        return $manga;
	}
	
	
	public function findAll() {
	}
	
	
	public function getLastedMangas() {

                $mangas = [];
                $stmt = $this->conn->query("SELECT * FROM postagens ORDER  BY ID DESC");
                $stmt->execute();
                if($stmt->rowCount()>0){
                        $mangaArray = $stmt->fetchAll();
                        foreach($mangaArray as $manga){
                                $mangas[] = $this->buildManga($manga);
                        }
                }
                return $mangas;
	}
	
	
	public function getMangasbycategory($category) {
                $mangas = [];
                $stmt = $this->conn->prepare("SELECT * FROM postagens where Categoria= :category ORDER  BY ID DESC");
                $stmt->bindParam(":category",$category);
                $stmt->execute();
                if($stmt->rowCount()>0){
                        $mangaArray = $stmt->fetchAll();
                        foreach($mangaArray as $manga){
                                $mangas[] = $this->buildManga($manga);
                        }
                }
                return $mangas;

	}
	
	public function getMangasId($id) {
                $mangas = [];
                $stmt = $this->conn->prepare("SELECT * FROM postagens where ID_Usuario= :id_users ");
                $stmt->bindParam(":id_users",$id);
                $stmt->execute();
                if($stmt->rowCount()>0){
                        $mangaArray = $stmt->fetchAll();
                        foreach($mangaArray as $manga){
                                $mangas[] = $this->buildManga($manga);
                        }
                }
                return $mangas;
	}
	
	
	public function findByid($id) {

                $manga = [];
                $stmt = $this->conn->prepare("SELECT * FROM postagens where ID= :id ");
                $stmt->bindParam(":id",$id);
                $stmt->execute();
                if($stmt->rowCount()>0){
                        $mangaData = $stmt->fetch();
                        $manga = $this->buildManga($mangaData);
                        return $manga;
                        
                }else{
                        return false;
                }
             
	}

	public function findBytitle($title) {
                $mangas = [];
                $stmt = $this->conn->prepare("SELECT * FROM postagens where Titulo LIKE :title ");
                $stmt->bindValue(":title",'%'.$title.'%');
                $stmt->execute();
                if($stmt->rowCount()>0){
                        $mangaArray = $stmt->fetchAll();
                        foreach($mangaArray as $manga){
                                $mangas[] = $this->buildManga($manga);
                        }
                }
                return $mangas;
            
	}
	
	
	public function create(Manga $manga) {

        $stmt = $this->conn->prepare("INSERT INTO postagens (Titulo,Descricao,imagem,Categoria ,Link,Capitulos,ID_Usuario


        )Values( :title,:description,:image,:category,:link,:chapters,:user_id) ");

        $stmt->bindParam(":title" ,$manga->title);
        $stmt->bindParam(":description", $manga->descrition);
        $stmt->bindParam(":image", $manga->image);
        $stmt->bindParam(":category",$manga->category);
        $stmt->bindParam(":link",$manga->link);
        $stmt->bindParam(":chapters",$manga->chapters);
        $stmt->bindParam(":user_id",$manga->user_id);
        $stmt->execute();
        //Mensagem de sucesso
        $this->message->setmessage("Mangá Adicionado  com sucesso!","sucess","index.php");
	}
	
	
	public function destoy($id) {

                $stmt = $this->conn->prepare("DELETE FROM postagens WHERE ID= :id");
                $stmt->bindParam(":id", $id);
                $stmt->execute();
                $this->message->setmessage("Mangá deletado com sucesso!","sucess","dashboard.php");
	}
	/**
	 * @param Manga $manga
	 * @return mixed
	 */
	public function update(Manga $manga) {
                $stmt = $this->conn->prepare("UPDATE postagens Set Titulo=:title,Descricao=:description,imagem=:image,Categoria =:category,Link= :link ,Capitulos= :chapters Where ID=:id");
                $stmt->bindParam(":title",$manga->title);
                $stmt->bindParam(":description",$manga->descrition);
                $stmt->bindParam(":image",$manga->image);
                $stmt->bindParam(":category",$manga->category);
                $stmt->bindParam(":link",$manga->link);
                $stmt->bindParam(":chapters",$manga->chapters);
                $stmt->bindParam(":id",$manga->id);
                $stmt->execute();
                $this->message->setmessage("Mangá Atualizado com sucesso!","sucess","back");
               
	}
}



?>