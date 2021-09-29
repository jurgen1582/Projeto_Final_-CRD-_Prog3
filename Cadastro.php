<?php 
  require 'sis_back.php';
  try{
    if(!empty($_POST["fname"])){
        $nome = $_POST["fname"];
        $sobrenome = $_POST["lname"];
        $telefone = $_POST["phone"];
        $email = $_POST["email"]; 

        $t = $db->prepare("INSERT INTO Contato (nome, sobrenome, telefone, email) VALUES (:nome, :sobrenome, :telefone, :email)");
        $t->execute(array(':nome' => $nome, ':sobrenome' => $sobrenome,':telefone' => $telefone,':email' => $email));
        if($t->rowCount() > 0) {
            $msg = "<script>document.getElementById('sucesso').style.display='block';</script>"."Cadastro efetuado com Sucesso!";
            header('Refresh:5;url=Cadastro.php');	
        }
    }
  }
  catch (Throwable | PDOException $e) {
    echo "<p><b> Ocorreu um erro! </b></p>";
    echo "<p><b>".$e->getCode()."<br></p>";
    echo "<p><b>".$e->getMessage()."</b></p>";
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <script src="sis_new.js"></script>

    <title>Cadastro Novo Contato</title>
</head>
<body>
<div class="container-fluid">
    <nav class="navbar navbar-light bg-light justify-content-between">
        <a style="margin-left: 25px;" href="Index.php" class="btn btn-outline-success">HOME</a>
    </nav>
    <form action="" method="post" style="margin-left: 2%;">
        <header style="margin-bottom: 3%;">
            <h3>Cadastro de contatos</h3>
        </header>
        <div style="display:none" id="sucesso" class="alert alert-success" role="alert"><?= $msg ?></div>
        <div class="form-row">
            <div class="col-md-4 mb-3">
                <label for="validationDefault01">Nome</label>
                <input type="text" name="fname" class="form-control" id="validationDefault01" placeholder="Nome"  required>
            </div>
            <div class="col-md-4 mb-3">
                <label for="validationDefault02">Sobrenome</label>
                <input type="text" name="lname" class="form-control" id="validationDefault02" placeholder="Sobrenome"  required>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-4 mb-3">
                <label for="validationDefault03">Telefone</label>
                <input type="text" name="phone" class="form-control" id="telefone1"   required>
            </div>
            <div class="col-md-4 mb-3">
                <label for="validationDefault04">E-mail</label>
                <input type="text" name="email" class="form-control" id="validationDefault04" placeholder="E-mail" required>
            </div>
        </div>
        <button class="btn btn-primary" type="submit">Cadastrar</button>
      </form>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous"></script>
      <script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>
      <script src="sis_new.js"></script>
</div>
</body>
</html>