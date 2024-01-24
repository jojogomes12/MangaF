<?php
require_once('models/User.php');
require_once('models/message.php');

require_once('dao/UserDao.php');
require_once('config.php');
require_once('globals.php');

$message = new Message($Base_URL);
$useDao = new UserDao($conn,$Base_URL);


//resgata o tipo do formulario
$type = filter_input(INPUT_POST, "type");

if($type==="register"){
   
    $name = filter_input(INPUT_POST, "name");
    $lastname = filter_input(INPUT_POST, "lastname");
    $email = filter_input(INPUT_POST, "email");
    $password = filter_input(INPUT_POST, "password");
    $confirmpassword = filter_input(INPUT_POST, "confirmpassword");
    //Verificação de Dados Minimos
    if($name && $lastname && $email && $password){
        //Verificar se as senhas batem
        if($password===$confirmpassword){
           
            //Verificar se o email já existe no sistema
             if($useDao->findbyEmail($email)===false){

             $user = new User();

             //Crianção de token e senha
                $usertoken = $user->generateToken();
                $finalpassword = $user->generatePassword($password);
                $user->name=$name;
                $user->lastname = $lastname;
                $user->email = $email;
                $user->password = $finalpassword;
                $user->token = $usertoken;
                $auth = true;
                $useDao->Create($user, $auth);
                $message->setmessage("Seja bem vindo","sucess","editprofile.php");          
             }
             else{

         //Mensagem de erro se email já existir
            $message->setmessage("Usuario já cadastrado , tente outro e-mail.","error","back");

             }

        }
        else{
                    //Mensagem de erro de senhas não batem
            $message->setmessage("As senhas não são iguais","error","back");

        }
    }
    else{
        //Mensagem de erro de dados faltantes
        $message->setmessage("Por favor preencha todos os campos","error","back");
    }


}else if($type==="login"){
    $email = filter_input(INPUT_POST, "email");
    $password = filter_input(INPUT_POST, "password");
    //Tenta autenticar um úsuario.
    if($useDao->autenticateUser($email,$password)){
        $message->setmessage("Seja bem vindo","sucess","editprofile.php");
    }else{
        //Redireciona usuario caso não consiga autenticar
    }

}

?>