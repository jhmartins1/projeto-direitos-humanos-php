<?php

include "../validar.php";

require_once "../config.php";

if(isset($_POST['submit'])){

$instituicao = $_POST['instituicao'];
$curso = $_POST['curso'];
$classificacao = $_POST['classificacao_geral'];
$tipo = $_POST['tipo'];
$autor = $_POST['autor'];
$orientador = $_POST['orientador'];
$titulo = $_POST['titulo'];
$ano = $_POST['ano'];
$resumo = $_POST['resumo'];
$pdf = $_POST['pdf'];

$sql = "INSERT INTO `tese_dissertacao`(`instituicao`, `curso`, `classificacao_geral`, `tipo`, `autor`, `orientador`, `titulo`, `ano_defesa`, `resumo`, `pdf`) VALUES ('$instituicao', '$curso', '$classificacao', '$tipo', '$autor', '$orientador', '$titulo', '$ano', '$resumo', '$pdf')";



if(mysqli_query($conn, $sql)){
  header("location: ../index.php");
}else{
  echo "houve um erro";
}
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Registro</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="shortcut icon" href="../img/8.png">
    <link rel="stylesheet" href="../bs5/css/bootstrap.min.css">
    <script src="../bs5/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script>
    $(function() {
        $("#completar").autocomplete({
            source: "autocomplet.php",
        });
    });
    </script>
    <script>
      $(function(){
        $("#completarori").autocomplete({
          source: "autocompleteori.php"
        });
      });
    </script>
</head>
<body>
<div class="container">
  <div class="page-header mt-3">
    <h2 id="direitostyle">Adicionar Registro</h2>
    <hr>
  </div>
  <form action="adicionarRegistro.php" method="POST">
    <div class="form-group">
      <label>Universidade: </label>
      <select class="form-control mb-2" name="instituicao">
        <option value="Universidade de Brasília (UnB)">Universidade de Brasília (UnB)</option>
        <option value="Universidade Federal de Pernambuco (UFPE)">Universidade Federal de Pernambuco (UFPE)</option>
        <option value="Universidade Federal de Goiás (UFG)">Universidade Federal de Goiás (UFG)</option>
      </select>
    </div>
    <div class="form-group">
      <label>Curso: </label>
      <select class="form-control mb-2" name="curso">
      <?php
          $sqlw = "SELECT DISTINCT curso FROM cursos";
          $dados = mysqli_query($conn, $sqlw);                  
          while($cursolinha = mysqli_fetch_array($dados)){ ?>
          <option name="curso" value="<?= $cursolinha['curso'] ?>"><?= $cursolinha['curso'] ?></option>
        <?php } ?>     
      </select>
      <a href="adicionarCurso.php" class="btn btn-success" style="float: right;">Gerenciar cursos</a>
    </div>
    
    <label>Area:</label>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="classificacao_geral" value="Direitos humanos" checked>
      <label class="form-check-label">
        Direitos Humanos
      </label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="classificacao_geral" value="Educação em direitos humanos">
      <label class="form-check-label mb-2">
        Educação em Direitos Humanos
      </label>
    </div>
    <label>Tipo:</label>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="tipo" value="Mestrado" checked>
      <label class="form-check-label">
        Mestrado
      </label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="tipo"  value="Doutorado">
      <label class="form-check-label mb-2">
        Doutorado
      </label>
    </div>
    <div class="form-group">
      <label>Autor:</label>
      <input type="text" class="form-control mb-2" id="completar" name="autor" required placeholder="Insira um autor">
    </div>
    <div class="form-group">
      <label>Orientador:</label>
      <input type="text" id="completarori" class="form-control mb-2" name="orientador" required placeholder="Insira um orientador">
    </div>
    <div class="form-group">
      <label>Titulo:</label>
      <input type="text" class="form-control mb-2" name="titulo" required placeholder="Insira um titulo">
    </div>
    <div class="form-group">
      <label>Ano:</label>
      <input type="number" min="1980" max="2099" step="1" class="form-control mb-2" name="ano" required placeholder="Insira um ano">
    </div>
    <div class="form-group">
      <label for="">Resumo:</label>
      <textarea class="form-control mb-2" name="resumo" rows="8" required placeholder="Insira um resumo"></textarea>
    </div>
    <div class="form-group">
      <label>PDF:</label>
      <input type="text" name="pdf" class="form-control">
    </div>
    <br>
    <input type="submit" name="submit" class="btn btn-primary mb-3" style="float:right">  
  </form>
    <a href="../index.php" class="btn btn-primary">Voltar</a>
</div>
</body>
</html>
