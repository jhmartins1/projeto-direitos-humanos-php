<?php

// Check existence of id parameter before processing further

$my_option = $_GET["id"];

if( !empty($my_option) ){

    // Include config file

    require_once "config.php";

    

    // Prepare a select statement

    $sql = "SELECT * FROM tese_dissertacao WHERE id = ?";

    

    if($stmt = mysqli_prepare($conn, $sql)){

        // Bind variables to the prepared statement as parameters

        mysqli_stmt_bind_param($stmt, "i", $param_id);

        

        // Set parameters

        $param_id = trim($_GET["id"]);

        

        // Attempt to execute the prepared statement

        if(mysqli_stmt_execute($stmt)){

            $result = mysqli_stmt_get_result($stmt);

    

            if(mysqli_num_rows($result) == 1){

                /* Fetch result row as an associative array. Since the result set

                contains only one row, we don't need to use while loop */

                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                

                // Retrieve individual field value

                $instituicao = $row['instituicao'];

                $curso = $row['curso'];

                $classificacao = $row['classificacao_geral'];

                $tipo = $row["tipo"];

                $autor = $row["autor"];

                $orientador = $row["orientador"];

                $titulo = $row["titulo"];

                $ano_defesa = $row["ano_defesa"];

                $resumo = $row["resumo"];

                $classificacao_geral = $row["classificacao_geral"];

                $pdf = $row["pdf"];

            } else{

                // URL doesn't contain valid id parameter. Redirect to error page

                header("location: error.php");

                exit();

            }

            

        } else{

            echo "Oops! Something went wrong. Please try again later.";

        }

    }

     

    // Close statement

    mysqli_stmt_close($stmt);

    

    // Close connection

    mysqli_close($conn);

} else{

    // URL doesn't contain id parameter. Redirect to error page

    header("location: error.php");

    exit();

}

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <title>Detalhes - Direitos Humanos</title>

    <link href="bs5/css/bootstrap.css" rel="stylesheet">

    <link rel="shortcut icon" href="img/3.png">

</head>

<body>

    <div class="header mt-2">

      <img src="img/logodetalhes.jpeg" class="img-fluid" style="width:220px;height:160px;margin-bottom:20px; margin-left: 10px;">

    </div>

    <div class="row" style="margin-left:14px;margin-top: 12px;">   

    <div class="col-md-2">

        <b>Nome da Universidade:</b>

    </div>

    <div class="col-md-10">

        <p><?= $instituicao ?></p>

    </div>



    <div class="col-md-2">

        <b>Curso:</b>

    </div>

    <div class="col-md-10">

        <p><?= $curso ?></p>

    </div>

  

    <div class="col-md-2">

        <b>Área:</b>

    </div>

    <div class="col-md-10">

        <p><?= $classificacao ?></p>

    </div>



    <div class="col-md-2">

        <b>Tipo:</b>

    </div>

    <div class="col-md-10">

        <p><?= $tipo ?></p>

    </div>



    <div class="col-md-2">

        <b>Autor:</b>

    </div>

    <div class="col-md-10">

        <p><?= $autor ?></p>

    </div>

    

    <div class="col-md-2">

        <b>Orientador:</b>

    </div>

    <div class="col-md-10">

        <p><?= $orientador ?></p>

    </div>



    <div class="col-md-2">

        <b>Titulo:</b>

    </div>

    <div class="col-md-10">

        <p><?= $titulo ?></p>

    </div>



    <div class="col-md-2">

        <b>Ano:</b>

    </div>

    <div class="col-md-10">

        <p><?= $ano_defesa ?></p>

    </div>



    <div class="col-md-2">

        <b>Resumo:</b>

    </div>

    <div class="col-md-10">

        <p><?= $resumo ?></p>

    </div>



    <div class="col-md-2">

        <b>Anexo:</b>

    </div>

    <div class="col-md-10">

      <a href="<?=$pdf; ?>">pdf</a>

    </div>

  </div>

  <br>

  <a href="index.php" class="btn btn-primary" style="margin-left: 18px">Voltar</a>

</body>

</html>