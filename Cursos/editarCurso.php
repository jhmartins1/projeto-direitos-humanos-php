<?php
include "../validar.php";

require "../config.php";

    $id = $_GET['id_curso'] ?? '';
    $sql = "SELECT * FROM cursos WHERE id_curso = $id";
    $dados = mysqli_query($conn, $sql);
    
    $linha = mysqli_fetch_assoc($dados);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Editar Curso</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="shortcut icon" href="../img/8.png">
    <link rel="stylesheet" href="../bs5/css/bootstrap.min.css">
    <script src="../bs5/js/bootstrap.min.js"></script>
</head>
<body>
  <div class="container">
    <div class="page-header mt-3">
      <h2 id="direitostyle">Editar Curso</h2>
      <hr>
      <br>
    </div>
    <form action="editarCursoScript.php" method="post">
      <div class="form-group">
        <input type="hidden" name="id_curso" value="<?php echo $linha['id_curso']; ?>">
        <input type="text" class="form-control" name="curso" required placeholder="Insira um novo curso" value="<?= $linha['curso'] ?>">
      </div>
    <button type="submit" name="submit" class="btn btn-primary mt-2" style="float:right">Editar</button>
    </form>
    <br><br>
    <br>
    <a href="Cursos.php" class="btn btn-primary mt-2">Voltar</a>
  </div>
</body>
</html>