<?php
  include_once "../config.php";

  $id = $_POST['id'];
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

  $sql = "UPDATE `tese_dissertacao` set `instituicao` = '$instituicao', `curso` = '$curso', `classificacao_geral` = '$classificacao', `tipo` = '$tipo', `autor` = '$autor', `orientador` = '$orientador', `titulo` = '$titulo', `ano_defesa` = '$ano', `resumo` = '$resumo', `pdf` = '$pdf' WHERE id = $id";

  if(mysqli_query($conn, $sql)){
    header("location: ../index.php");
  }else{
    echo "Erro ao editar";
  }

  ?>