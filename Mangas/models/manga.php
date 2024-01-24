<?php 

class Manga{
    public $id,$title, $chapters, $descrition, $image,$category,$user_id,$rating,$link;

    public function imageGenerateName(){
        return bin2hex(random_bytes(60)) . ".jpg";
}
}
interface MangasInterface {
    public function buildManga($data);
    public function findAll();
    public function getLastedMangas();
    public function getMangasbycategory($category);
    public function getMangasId($id);
    public function findByid($id);
    public function findBytitle($title);
    public function create(Manga $manga);
    public function update(Manga $manga);
    public function destoy($id);

}

?>