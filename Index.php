<?php 
  require 'sis_back.php';
  try{
    $resultado = [];
    $delet = '';
    if(isset($_POST["contact"])){
      $nomes = $_POST["contact"];
      $r = $db->prepare("SELECT * FROM Contato WHERE nome like '%$nomes%'");

      $r->execute(array(':nome' => $nomes));
      $resultado = $r->fetchAll(PDO::FETCH_ASSOC);
    
    }else{
        $resultado = $db->query('SELECT * FROM contato');
        $resultado = $resultado->fetchAll(PDO::FETCH_ASSOC);
    }

    if (isset($_GET['deleta'])) {

      $del = $_GET['deleta'];
      $excluir = $db->exec("DELETE FROM contato WHERE id = '$del'");
      $delet = "<script>document.getElementById('excluido').style.display='block';</script>"."Cadastro excluido com Sucesso!"; 
      header('Refresh:5;url=Index.php');

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
    <link rel="stylesheet" href="sis_style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

    <title>Seus contatos</title>
</head>
<body>
  <div class="container-fluid">
    <nav class="navbar navbar-light bg-light justify-content-between">
        <a href="Cadastro.php" class="btn btn-outline-success my-2 my-sm-0">Novo Contato</a>
        <h1 style="color: #198754" >Meus Contatos</h1>
        <form action="" method="post" class="form-inline">
          <input class="form-control mr-sm-2" type="search" name="contact" value="<?php if(empty($nomes)){ $nomes = '';} else { echo $nomes;} ?>" placeholder="Pesquisar" aria-label="Pesquisar">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Pesquisar</button>
        </form>
      </nav>
    <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">Nome</th>
            <th scope="col">Sobrenome</th>
            <th scope="col">Telefone</th>
            <th scope="col">E-mail</th>
            <th class="text-center" scope="col">Excluir</th>
          </tr>
        </thead>
        <tbody>
            <?php
               foreach($resultado as $result){
              ?>
                <tr>
                        <td><?= $result['nome']; ?></td>
                        <td><?= $result['sobrenome']; ?></td>
                        <td><?= $result['telefone']; ?></td>
                        <td><?= $result['email']; ?></td>
                        <td class="text-center"><a onclick="return confirm('Deseja excluir este cadastro ?')" href="Index.php?deleta=<?= $result['id']?>"><div class="deleta" ><img class="image" width="20" height="20" src="./img/delete-button 2.png" alt=""></div></a></td>
                </tr>
              <?php
              }
            ?>
            <div style="display:none" id="excluido" class="alert alert-danger" role="alert"><?= $delet ?></div>
        </tbody>
      </table>
  </div>
</body>
</html>

