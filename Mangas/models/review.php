<?php
Class Review {


    public $id, $rating, $review, $user_id, $manga_id;

}
interface reviewInterface {
    public function buildreview($data);
    public function Create(Review $review);
    public function getMangaReviews($id);
    public function hasalreadyreview($id,$user_id);
    public function getrating($id);



}


?>