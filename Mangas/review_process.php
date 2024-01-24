<?php 
 require_once("globals.php");
 require_once("config.php");
 require_once("models/manga.php");
require("models/review.php");
 require_once("models/Message.php");
 require_once("dao/MangaDao.php");
 require_once("dao/UserDao.php");
require_once('dao/ReviewDao.php');
 $message = new Message($BASE_URL);
 $userDao = new UserDao($conn, $BASE_URL);
  $mangaDao = new MangaDao($conn, $BASE_URL);
$reviewDao = new ReviewDao($conn,$BASE_URL);
$reviewData = new Review;
  $userData = $userDao->verifyToken(true);
 //Recebendo o tipo do formulario
$type = filter_input(INPUT_POST ,"type");

 if($type==="Create"){
    $manga_id = filter_input(INPUT_POST, "mangas_id");
    $user_id = $userData->id;
    $rating = filter_input(INPUT_POST,"rating");
    $review = filter_input(INPUT_POST, "review");
    if (!empty($rating) && !empty($review)) {
        $reviewData->user_id = $user_id;
        $reviewData->manga_id = $manga_id;
        $reviewData->rating = $rating;
        $reviewData->review = $review;
        $reviewDao->Create($reviewData);
    }
    else{
        $message->setmessage("Preencha todos os campos!","error","back");
    }

 }else{
    $message->setmessage("Informações invalidas!","error","back");

 }
 
 
 ?>

