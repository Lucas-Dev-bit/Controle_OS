<?php

require_once '../../Controller/UsuarioCTRL.php';
//echo password_hash('123', PASSWORD_DEFAULT);
if(isset($_POST['btnAcessar'])){

    $senha = $_POST['senha'];
    $cpf = $_POST['cpf'];

    $ctrl = new UsuarioCTRL();

    $ret = $ctrl->ValidarLogin($senha, $cpf);

}

?>
<!DOCTYPE html>
<html>
<head>
    <?php
        include_once '../../Template/_head.php';
    ?>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <b>Controle de Chamados</b>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Faça seu Acesso</p>

      <form action="acessar.php" method="post">
        <div class="input-group mb-3">
          <input class="form-control num cpf" name="cpf" id="cpf" placeholder="Seu CPF" value="<?= isset($cpf) ? $cpf : '' ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-key"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Sua senha" name="senha" id="senha">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        
        <center><button type="submit" name="btnAcessar" onclick="return ValidarTela(4)" class="btn btn-info btn-block">Acessar</button></center> 
          
      </form>
    </div>
  </div>
</div>


<?php 
    include_once '../../Template/_scripts.php';
    include_once '../../Template/_msg.php';
?>

</body>
</html>
