<?php
session_start();
    include ('../../config.php');


    if($_POST['usuario'] == '' || $_POST['senha'] == ''){
        header('Location: ../../index.php');
        exit();
    } 


    $usuario = mysqli_real_escape_string($conn, $_POST['usuario']);
    $senha = mysqli_real_escape_string($conn, $_POST['senha']);
    $query = "SELECT * from loginusuario where usuario = '{$usuario}' and senha = '{$senha}'";


    $result = mysqli_query($conn, $query);
    $row = mysqli_num_rows($result);

if($row == 1) {
    $_SESSION['usuario'] = $usuario;
    header('Location: ../../index.php');
    exit();
} else {
    $_SESSION['nao_autenticado'] = true;
    header('Location: loginadmin.php');
    exit();
}

function logar(){
    $_SESSION['usuario'] = true;
}


