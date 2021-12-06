<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$autor = $orientador = $assunto = $titulo = $ano_defesa = $tipo = $instituicao = $classificacao_dh = $classificacao_edh = $classificacao_grupos = $resumo = $pdf = "";

$autor_err = $orientador_err = $assunto_err = $titulo_err = $ano_defesa_err = $instituicao_err = $classificacao_dh_err = $classificacao_edh_err = $classificacao_grupos_err = $resumo_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate autor
    $input_autor = trim($_POST["autor"]);
    if(empty($input_autor)){
        $autor_err = "Porfavor insira um autor.";     
    } else{
        $autor = $input_autor;
    }
    
    $input_orientador = trim($_POST["orientador"]);
    if(empty($input_orientador)){
        $orientador_err = "Porfavor insira um orientador.";     
    } else{
        $orientador = $input_orientador;
    }
    
    $input_assunto = trim($_POST["assunto"]);
    if(empty($input_assunto)){
        $assunto_err = "Porfavor insira um titulo.";     
    } else{
        $assunto = $input_assunto;
    }

    // Validate titulo
    $input_titulo = trim($_POST["titulo"]);
    if(empty($input_titulo)){
        $titulo_err = "Porfavor insira um titulo.";     
    } else{
        $titulo = $input_titulo;
    }
    
    // Validate ano_defesa
    $input_ano_defesa = trim($_POST["ano_defesa"]);
    if(empty($input_ano_defesa)){
        $ano_defesa_err = "Porfavor insira um ano.";     
    } elseif(!ctype_digit($input_ano_defesa)){
        $ano_defesa_err = "Porfavor insira um ano valido.";
    } else{
        $ano_defesa = $input_ano_defesa;
    }

    $input_tipo = trim($_POST["tipo"]);
             
    $tipo = $input_tipo;
    
    $input_instituicao = trim($_POST["instituicao"]);
    if(empty($input_instituicao)){
        $instituicao_err = "Porfavor insira uma instituicao.";     
    } else{
        $instituicao = $input_instituicao;
    }

    
    $input_classificacao_dh = trim($_POST["classificacao_dh"]);
    if(empty($input_classificacao_dh)){
        $classificacao_dh_err = "Porfavor insira uma classificacao dh.";     
    } else{
        $classificacao_dh = $input_classificacao_dh;
    }

    $input_classificacao_edh = trim($_POST["classificacao_edh"]);
    if(empty($input_classificacao_edh)){
        $classificacao_edh_err = "Porfavor insira uma classificacao edh.";     
    } else{
        $classificacao_edh = $input_classificacao_edh;
    }

    $input_classificacao_grupos = trim($_POST["classificacao_grupos"]);
    if(empty($input_classificacao_grupos)){
        $classificacao_grupos_err = "Porfavor insira uma classificacao de grupos.";     
    } else{
        $classificacao_grupos = $input_classificacao_grupos;
    }

    $input_resumo = trim($_POST["resumo"]);
    if(empty($input_resumo)){
        $resumo_err = "Porfavor insira um resumo.";     
    } else{
        $resumo = $input_resumo;
    }

    $input_pdf = trim($_POST["pdf"]);
             
    $pdf = $input_pdf;

    // Check input errors before inserting in database

        // Prepare an insert statement
        $sql = "INSERT INTO tese_dissertacao (autor_1, orientador_1, assunto, titulo, ano_defesa, tipo, instituicao, classificacao_dh, classificacao_edh, classificacao_grupos, resumo, pdf) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssssssssss", $param_autor, $param_orientador, $param_assunto, $param_titulo, $param_ano_defesa, $param_tipo, $param_instituicao, $param_classificacao_dh, $param_classificacao_edh, $param_classificacao_grupos, $param_resumo, $param_pdf);
            
            // Set parameters
            $param_autor = $autor;
            $param_orientador = $orientador;
            $param_assunto = $assunto;
            $param_titulo = $titulo;
            $param_ano_defesa = $ano_defesa;
            $param_tipo = $tipo;
            $param_instituicao = $instituicao;
            $param_classificacao_dh = $classificacao_dh;
            $param_classificacao_edh = $classificacao_edh;
            $param_classificacao_grupos = $classificacao_grupos;
            $param_resumo = $resumo;
            $param_pdf = $pdf;
        
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    
    
    // Close connection
    mysqli_close($conn);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Adicionar - Direitos Humanos</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="img/8.png">
    <link rel="stylesheet" href="bs3/bootstrap337.css">
 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

        <script>
    $(function() {
        $("#skill_input").autocomplete({
            source: "autocomplet.php",
        });
    });
    </script>
    <style type="text/css">
        .wrapper{
            width: 950px;
            height: 780px;
            margin: 0 auto
        }
    </style>


</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                    <div class="page-header col-md-12" style="margin-top:0px;">
                        <h2 id="direitostyle">Adicionar Registro</h2>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group col-md-6">
                            <span>Autor:</span><br>
                            <input type="text" name="autor" id="skill_input" class="form-control" placeholder="insira um autor..." required value="<?php echo $autor; ?>">
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group col-md-6">
                            <span>Orientador:</span>
                            <input type="text" name="orientador" id="orientador" class="form-control" placeholder="insira um orientador..." required value="<?php echo $orientador; ?>">
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group col-md-12">
                            <span>Assunto:</span>
                            <input type="text" name="assunto" class="form-control" placeholder="insira um assunto..." required value="<?php echo $assunto; ?>"></textarea>
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group col-md-12">
                            <span>Titulo:</span>
                            <input type="text" name="titulo" class="form-control" placeholder="insira um titulo..." required value="<?php echo $titulo; ?>"></textarea>
                            <span class="help-block"></span>
                        </div>
                    
                    <div class="aqui">
                        <div class="form-group col-md-4">
                            <span>Ano:</span>
                            <input type="number" name="ano_defesa" class="form-control" required value="<?php echo $ano_defesa; ?>" min="1980" max="2021" style="width:90px";>
                            <span class="help-block"></span>
                        </div>

                    <div class="form-group  col-md-4 ">
                        <span>Tipo:</span><br><br>
                        <input class="form-check-input" type="radio" name="tipo" value="Mestrado" checked> Mestrado
                        <input class="form-check-input" type="radio" name="tipo" value="Doutorado"> Doutorado
                        </div>
                    </div>
                    
                    <div class="form-group  col-md-4">
                    <span>Instituição:</span><br><br>
                        <input class="form-check-input" type="radio" name="instituicao" value="UNB" checked> UNB
                        <input class="form-check-input" type="radio" name="instituicao" value="UFG"> UFG
                        <input class="form-check-input" type="radio" name="instituicao" value="UFP"> UFP
                        </div>
                    <br>
                    <div class="form-group col-md-12" style="margin-top:24px">
                    <label>Classificação Geral:</label><br><br>
                    <div class="form-check">
                    <input type="checkbox" id="dh" > Direitos Humanos</label><br>
                    <input type="checkbox" id="edh"> Educação em Direitos Humanos</label><br>
                    </div>                  
                        <div class="form-group col-md-12">
                        <br><span>Resumo:</span>
                            <textarea name="resumo" rows="6" cols="44" class="form-control" placeholder="insira um resumo..." required><?php echo $resumo; ?></textarea>
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group col-md-12">
                        <br><span>PDF:</span>
                        <input type="text" name="pdf" style="width:500px;">
                        </div>
                        </div>
                        <div class="form-group col-md-12">
                        <input type="submit" class="btn btn-primary" value="Registrar" style="float:right; margin-left:10px;">
                        <a href="index.php" class="btn btn-default" style="float:right;">Cancelar</a>
                        </div>
                    </form>
                </div>
                </div>
    </div>
</body>
</html>
