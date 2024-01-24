<?php require_once('templates/header.php')?>
<div id="main-container" class="container-fluid">
    <div class="col-md-12">
        <div class="row" id="auth-row">
            <div class="col-md-4" id="login-conteiner">
          <h2>Entrar</h2>
          <form action="<?=$Base_URL?>auth_Process.php" method="post">
          <input type="hidden" name="type" value="login">
      <div class="form-group">
        <label for="Email">Email:</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="digite seu email">
      </div>
      <div class="form-group">
        <label for="Senha">Senha:</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="digite sua senha">
      </div>
      <input type="submit" class="btn card-btn" id="card-btn" value="Entrar">
          </form>
         </div>
         <div class="col-md-4" id="register-conteiner">
          <h2>Criar Conta</h2>
          <form action="<?=$Base_URL?>auth_Process.php" method="post">
    <input type="hidden" name="type" value="register">
    <div class="form-group">
        <label for="Email">Email:</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="digite seu email">
      </div>
      <div class="form-group">
        <label for="name">Nome:</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="digite seu nome">
      </div>
      <div class="form-group">
        <label for="lastname">Sobrenome:</label>
        <input type="text" class="form-control" id="lastname" name="lastname" placeholder="digite seu sobrenome">
      </div>
      <div class="form-group">
        <label for="Senha">Senha:</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="digite sua senha">
      </div>
      <div class="form-group">
        <label for="confirmpassword">Confirmação de senha:</label>
      <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" placeholder="Confirme sua senha">
      </div>
      <input type="submit" class="btn card-btn" id="card-btn" value="Registrar">

          </form>
         </div>
    </div> 
    </div>
</div>   
<?php require_once('templates/footer.php')?>
