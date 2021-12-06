<?php
include "../validar.php";

include_once "../config.php";
  
$curso = $_POST['curso'];
$sql = "DELETE FROM `cursos` WHERE curso = '$curso'";


if(mysqli_query($conn, $sql)){
    header("location: ../adicionar/adicionarCurso.php");
} else{
    echo "Erro ao excluir curso";
}
?>       
