<?php
include "../validar.php";

require "../config.php";

// ADICIONAR CURSOS
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
    <title>Cursos</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="shortcut icon" href="../img/8.png">
    <link rel="stylesheet" href="../bs5/css/bootstrap.min.css">
    <script src="../bs5/js/bootstrap.min.js"></script>
</head>
<body>
  <div class="container">
    <div class="page-header mt-3">
      <a href="adicionarCurso.php" id="adicionarstyle" class="btn btn-primary" style="font-size: 14px; padding:4px 10px; float:right; margin-top: 12px">Adicionar Curso</a>
      <h2 id="direitostyle">Cursos</h2>
      <hr>
    </div>
    <!-- TABELA DE CURSOS -->
    <table class="table">
      <thead class="table-info">
        <tr>
        </tr>
      </thead>
      <tbody>
          <?php
          // LISTA DE CURSOS
          $sql = "SELECT DISTINCT id_curso, curso FROM cursos";
          $listaCursos = mysqli_query($conn, $sql);
          while($temcurso = mysqli_fetch_array($listaCursos)){
            echo "<tr>";
              echo "<td>".$temcurso['curso']."</td>";
              echo "<td>";
              echo "<a style='margin-right:10px;' href='editarCurso.php?id_curso=".$temcurso['id_curso']."'>Editar</a>";
              echo "<a href='deletarCurso.php?id_curso=".$temcurso['id_curso']."' >Excluir</a>";
            echo "</tr>";
          }
          ?>
      </tbody>
    </table>
    <br>
    <a href="../index.php" class="btn btn-primary mt-2">Voltar</a>
  </div>
</body>
</html>