<?php
require_once('./models/User.php');
require_once('./models/message.php');

Class UserDao implements userDaoInterface{
    private $conn, $url,$message;
	
    public function __construct(PDO $conn,$url){
        $this->conn = $conn;
        $this->url = $url;
		$this->message = new Message($url);        

    }
	public function buildUser($data) {

        $user = new User;
        $user->id = $data['ID'];
        $user->name = $data['Nome'];
        $user->lastname = $data['Sobrenome'];
        $user->email = $data['Email'];
        $user->password = $data['Senha'];
        $user->image = $data['Imagem'];
        $user->bio = $data['Bio'];
        $user->token = $data['Token'];
        return $user;
	}

	public function Create(User $user, $authUser = false) {

		$stmt = $this->conn->prepare("INSERT INTO usuarios(Nome ,Sobrenome,Email,Senha,Token) Values (:name,:lastname,:email,:password,:token )");
		$stmt->bindParam(':name',$user->name);
		$stmt->bindParam(':lastname',$user->lastname);
		$stmt->bindParam(':email',$user->email);
		$stmt->bindParam(':password',$user->password);
		$stmt->bindParam(':token',$user->token);
		$stmt->execute();
		//autenticar usuario caso seja true 
		if($authUser){
			$this->setTokenToSession($user->token);
		}
	}
	

	public function Update(User $user,$redirect=true) {
		$stmt = $this->conn->prepare("UPDATE usuarios SET 
		Nome=:name, 
		Sobrenome=:lastname,
		Email=:email,
		Senha=:password,
		Imagem=:image,
		Bio=:bio,
		Token=:token
					WHERE ID=:id
		");
	
		$stmt->bindParam(':name',$user->name);
		$stmt->bindParam(':lastname',$user->lastname);
		$stmt->bindParam(':email',$user->email);
		$stmt->bindParam(':password',$user->password);
		$stmt->bindParam(':image',$user->image);
		$stmt->bindParam(':bio',$user->bio);
		$stmt->bindParam(':token',$user->token);
		$stmt->bindParam(':id',$user->id);
		$stmt->execute();

		if($redirect){
			//redireciona para o perfil do usuario.
			$this->message->setmessage("Dados atualizados com sucesso!","sucess","editprofile.php");
		}
	}
	
	
	public function verifyToken($protected = false) {

if(!empty($_SESSION['token'])){
//pega o token da session
			$token = $_SESSION['token'];
			$user = $this->findbyToken($token);

if($user){
			return $user;
	
}
else if($protected){
//redireciona usúario não autenticado.
$this->message->setmessage("Faça a autenticação para acessar essa página!","error","index.php");
}
}

else if($protected){
	//redireciona usúario não autenticado.
$this->message->setmessage("Faça a autenticação para acessar essa página!","error","index.php");
}

	
}
		

	public function setTokenToSession($token, $redirect = true) {

//Salvar token na sessão
		$_SESSION['token'] = $token;
		if($redirect){
			//redireciona para o perfil do usuario.
		}

	}
	
	public function autenticateUser($email, $password) {

		$user = $this->findbyEmail($email);
		if($user){
			//Checar se as senhas batem
			if(password_verify($password,$user->password)){

                //gerar um novo token
				$token = $user->generateToken();
				$this->setTokenToSession($token,false);
				//Atualizar token no usuário
				$user->token = $token;
				$this->Update($user,false);

				return true;
			}else{
			
				$this->message->setmessage("usuario e/ou senha incorretos!","error","back");
			}
		}else{
			$this->message->setmessage("Informações invalidas!","error","back");
			return false;
		}
	}
	
	
	public function findbyEmail($email) {

       if($email !=""){
			$stmt = $this->conn->prepare("SELECT * FROM usuarios WHERE Email = :email");
			$stmt->bindParam(":email", $email);
			$stmt->execute();
			if($stmt->rowcount()>0){
				$data = $stmt->fetch();
				$user = $this->buildUser($data);
				return $user;
			}
			else{
				return false;
			}
	   }
	   else{
			return false;
	   }

	}
	
	
	public function findbyId($id) {
		if($id !=""){
			$stmt = $this->conn->prepare("SELECT * FROM usuarios WHERE ID = :id");
			$stmt->bindParam(":id", $id);
			$stmt->execute();
			if($stmt->rowcount()>0){
				$data = $stmt->fetch();
				$user = $this->buildUser($data);
				return $user;
			}
			else{
				return false;
			}
	   }
	   else{
			return false;
	   }

	
	}
	
	public function findbyToken($token) {
		if($token !=""){
			$stmt = $this->conn->prepare("SELECT * FROM usuarios WHERE token = :token");
			$stmt->bindParam(":token", $token);
			$stmt->execute();
			if($stmt->rowcount()>0){
				$data = $stmt->fetch();
				$user = $this->buildUser($data);
				return $user;
			}
			else{
				return false;
			}
	   }
	   else{
			return false;
	   }
	}
	public function destroyToken() {
		//Remove o token da sessao;
		$_SESSION['token'] = "";
		//redirecionar e apresentar a mensagem de sucesso
		$this->message->setmessage("Voce fez logout","sucess","index.php");

	}
	
	
	public function findbypassword($password) {
	}
	
	
	public function changepassword(User $user) {

		$stmt = $this->conn->prepare("UPDATE usuarios SET 
		Senha =:password
		Where ID =:id
		");
     $stmt->bindParam(":password", $user->password);
	 $stmt->bindParam(":id", $user->id);
		$stmt->execute();
		//redirecionar e apresentar a mensagem de sucesso
		$this->message->setmessage("Senha alterada com sucesso!","sucess","editprofile.php");
	}
	
}


?>