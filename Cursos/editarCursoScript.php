<?php
        include_once "../config.php";

        $id = $_POST['id_curso'];  
        $curso = $_POST['curso'];
        
        $sql = "UPDATE `cursos` set `curso` = '$curso' WHERE id_curso = $id";
        
        if(mysqli_query($conn, $sql)){
            header("location: Cursos.php");
        } else{
            header("location: editarCurso.php");
        }
?>       