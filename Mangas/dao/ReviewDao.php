<?php
require_once('models/review.php');


Class ReviewDao implements reviewInterface{
    private $conn, $url,$message;

    public function __construct( PDO $conn,$url){

        $this->conn = $conn;
        $this->url = $url;
        $this->message = new Message($url); 


    }
	
	public function buildreview($data) {
        $review = new Review();
        $review->id = $data['ID'];
        $review->rating = $data['Nota'];
        $review->user_id = $data['ID_Usuario'];
        $review->manga_id = $data['ID_Postagens'];
        $review->review = $data['texto'];
        return $review;
      
	}
	
	
	public function Create(Review $review) {
        $stmt = $this->conn->prepare("INSERT INTO analises(Nota,texto,ID_Usuario,ID_Postagens ) Values (:rating,:text,:user_id,:manga_id)");
        $stmt->bindParam(":rating",$review->rating );
        $stmt->bindParam(":text",$review->review );
        $stmt->bindParam(":user_id",$review->user_id);
        $stmt->bindParam(":manga_id",$review->manga_id);
        $stmt->execute();
        //Mensagem de sucesso
        $this->message->setmessage("Analise adicionada com sucesso!","sucess","index.php");
    
    }
	
	
	public function getMangaReviews($id) {
      
        
      $reviews = [];

      $stmt = $this->conn->prepare("SELECT * FROM analises WHERE ID_Postagens = :id_post");

      $stmt->bindParam(":id_post", $id);

      $stmt->execute();

      if($stmt->rowCount() > 0) {

        $reviewsData = $stmt->fetchAll();

        $userDao = new UserDao($this->conn, $this->url);

        foreach($reviewsData as $review) {
      
      $reviewObject=$this->buildreview($review);
         //Chamar dados do usuário
         $user=$userDao->findbyId($reviewObject->user_id);
         $reviewObject->user_id=$user;
                $reviews[]=$reviewObject;
                

        }

      }

      return $reviews;
	}
	
	
	public function hasalreadyreview($id, $user_id) {

        $stmt = $this->conn->prepare("SELECT *  FROM analises WHERE ID_Postagens = :mangas_id  AND ID_Usuario = :users_id");
      $stmt->bindParam(":mangas_id", $id);
      $stmt->bindParam(":users_id", $user_id);

      $stmt->execute();

      if($stmt->rowCount() > 0) {
    
        return true;
      } 
      else {
        
        return false;
      }

    }
	
	
	public function getrating($id) {
    $stmt = $this->conn->prepare("SELECT * FROM analises Where ID_Postagens =:id");
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    if($stmt->rowCount()>0){
      $rating = 0;
      $reviews = $stmt->fetchAll();
      foreach($reviews as $review){
        $rating += $review['Nota'];
      }
      $rating =round($rating / count($reviews),1);
    

    }else{
      $rating = "Não avaliado";
    }
    return $rating;

  }
}


?>