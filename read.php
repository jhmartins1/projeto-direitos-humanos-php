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
                $tipo = $row["tipo"];
                $autor = $row["autor"];
                $orientador = $row["orientador"];
                $titulo = $row["titulo"];
                $ano_defesa = $row["ano_defesa"];
                $instituicao = $row["instituicao"];
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
    <style type="text/css">
        .container-fluid{
            width: 100%;
            height: 100%;
            margin: 0px 0px 0px 20px;
            max-width: 1328px;
        }
        .img-fluid{
            margin-top: 5px;
            margin-left: 10px;
        }
    </style>
</head>
<body>
    <div class="wrapper">
            <div class="col-md-12">
            <div class="header">
            <img src="img/logodetalhes.jpeg" class="img-fluid" style="width:220px;height:160px;margin-bottom:20px;">
            </div>
        <div class="container-fluid">
                <div class="row">   
                    <div class="form-group">
                        <b>Tipo:</b>
                        <p class="form-control-static" style="display:inline;"><?php echo $tipo; ?></p>
                    </div>
                    <br><br>
                    <div class="form-group">
                        <b>Ano:</b>
                        <p class="form-control-static" style="display:inline;"><?php echo $ano_defesa; ?></p>
                    </div>
                    <br><br>
                    <div class="form-group">
                        <b>Autor:</b>
                        <p class="form-control-static" style="display:inline;"><?php echo $autor; ?></p>
                    </div>
                    <br><br>
                    <div class="form-group" id="orientadorJ">
                        <b>Orientador:</b>
                        <p class="form-control-static" style="display:inline;"><?php echo $orientador; ?></p>
                    </div>
                    <br><br>
                    <div class="form-group">
                        <b>Comunidade Reposítorio:</b>
                        <p class="form-control-static" style="display:inline;">Instituto de Ciências Humanas</p>
                    </div>
                    <br><br>
                    <div class="form-group">
                        <b>Unidade Acadêmica:</b>
                        <p class="form-control-static" style="display:inline;">Serviço Social</p>
                    </div>
                    <br><br>
                    <div class="form-group">
                        <b>Nome do Programa:</b>
                        <p class="form-control-static" style="display:inline;">Programa de Pós-Graduação em Política Social</p>
                    </div>
                    <br><br>
                    <div class="form-group">
                        <b>Instituição:</b>
                        <p class="form-control-static" style="display:inline;"><?php echo $instituicao; ?></p>
                    </div>
                    <br><br>
                    <div class="form-group">
                        <b>Assunto:</b>
                        <p class="form-control-static" style="display:inline;"><?php echo $assunto; ?></p>
                    </div>
                    <br><br>
                    <div class="form-group">
                        <b>Titulo:</b>
                        <p class="form-control-static" style="display:inline;"><?php echo $titulo; ?></p>
                    </div>
                    <br><br>
                    <div class="form-group">
                        <b>Resumo:</b>
                        <p class="form-control-static" style="display:inline;"><?php echo $resumo; ?></p>
                    </div>
                    <div class="form-group" style="margin-top:15px">
                        <b>Classificação Geral:</b>
                        <p class="form-control-static" style="display:inline;">
                        <br>
                        <?php if($classificacao_dh != ''){
                            echo "Direitos Humanos: " . $classificacao_dh;
                            echo '<br>';
                         } ; ?>
                        <?php if($classificacao_edh != ''){
                            echo "Educação em Direitos Humanos: " . $classificacao_edh;
                         } ; ?>
                        </p>
                    </div>
                    <br>
                    <div class="form-group" style="margin-top:15px">
                    <b>Classificação dos grupos:</b><br>
                    <p class="form-control-static" style="display:inline;"><?php echo $classificacao_grupos ?>
                    </div>
                    </div>
                    <br>
                <a href="<?=$pdf; ?>">pdf</a><br><br>
                <a href="index.php" class="btn btn-primary" style="margin-top:10px">Voltar</a>        
                </div>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>