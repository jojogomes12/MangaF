<?php

Class User{

    public $id, $name, $lastname, $email, $password, $image, $bio, $token;

public function generateToken(){
        return bin2hex(random_bytes(50));

}
public function generatePassword($password){

        return password_hash($password, PASSWORD_DEFAULT);


}
public function getfullname(User $user){

        return $user->name . " " . $user->lastname;

}
public function imageGenerateName(){
        return bin2hex(random_bytes(60)) . ".jpg";
}


}
interface userDaoInterface{
    function buildUser($data);
    function Create(User $user ,$auth=false);
    function Update(User $user,$redirect=true);
    function verifyToken($protected=false);
    function setTokenToSession($token,$redirect=true);
    function autenticateUser($email, $password);
    function findbyEmail($email);
    function findbyId($id);
    function findbyToken($token);
    function destroyToken();
    function findbypassword($password);
    function changepassword(User $user);
}



?>