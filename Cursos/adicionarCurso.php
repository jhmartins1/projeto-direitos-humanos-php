<?php
include "../validar.php";

require "../config.php";

if(isset($_POST['submit'])){

  
  $curso = $_POST['curso'];

  $pegacurso = mysqli_query($conn, "SELECT * FROM cursos WHERE curso = '{$curso}'");
  
  if(mysqli_num_rows($pegacurso) > 0){
    echo "Ja existe um curso cadastrado com esse nome";
  }else{
    mysqli_query($conn, "INSERT INTO `cursos`(`curso`) VALUES ('$curso')");
    header("location: adicionarCurso.php");
  }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Curso</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="shortcut icon" href="../img/8.png">
    <link rel="stylesheet" href="../bs5/css/bootstrap.min.css">
    <script src="../bs5/js/bootstrap.min.js"></script>
</head>
<body>
  <div class="container">
    <div class="page-header mt-3">
      <h2 id="direitostyle">Adicionar Curso</h2>
      <hr>
      <br>
    </div>
    <form action="adicionarCurso.php" method="post">
      <div class="form-group">
        <input type="text" class="form-control" name="curso" required placeholder="Insira um novo curso">
      </div>
    <button type="submit" name="submit" class="btn btn-primary mt-2" style="float:right">Adicionar</button>
    </form>
    <br><br>
    <br>
    <a href="Cursos.php" class="btn btn-primary mt-2">Voltar</a>
  </div>
</body>
</html>