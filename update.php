<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$autor = $orientador = $assunto = $titulo = $ano_defesa = $tipo = $instituicao = $classificacao_dh = $classificacao_edh = $classificacao_grupos = $resumo = $pdf = "";

$autor_err = $orientador_err = $assunto_err = $titulo_err = $ano_defesa_err = $instituicao_err  = $classificacao_grupos_err = $resumo_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];
    
    // Validate name
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
        $assunto_err = "Porfavor insira um assunto.";     
    } else{
        $assunto = $input_assunto;
    }
    

    // Validate titulo titulo
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
        $classificacao_dh = $input_classificacao_dh;

    $input_classificacao_edh = trim($_POST["classificacao_edh"]);
        $classificacao_edh = $input_classificacao_edh;

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

    $vpdf = $_POST["pdf"];
        

    // Check input errors before inserting in database
        // Prepare an update statement
        $sql = "UPDATE tese_dissertacao SET autor_1=?, orientador_1=?, assunto=?, titulo=?, ano_defesa=?, tipo=?, instituicao=?, classificacao_dh=?, classificacao_edh=?, classificacao_grupos=?, resumo=?, pdf=? WHERE id=?";
         
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssssssssssi", $param_autor, $param_orientador, $param_assunto, $param_titulo, $param_ano_defesa, $param_tipo, $param_instituicao, $param_classificacao_dh, $param_classificacao_edh, $param_classificacao_grupos, $param_resumo, $param_pdf, $param_id);
            
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
            $param_pdf = $vpdf;
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Algo deu errado, tente novamente mais tarde.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    
    
    // Close connection
    mysqli_close($conn);
} else{
    // Check existence of id parameter before processing further
    $my_option = $_GET["id"];
	if(!empty($my_option)){
        // Get URL parameter
        $id =  trim($_GET["id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM tese_dissertacao WHERE id = ?";
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            // Set parameters
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $autor = $row["autor_1"];
                    $orientador = $row["orientador_1"];
                    $assunto = $row["assunto"];
                    $titulo = $row["titulo"];
                    $ano_defesa = $row["ano_defesa"];
                    $tipo = $row["tipo"];
                    $instituicao = $row["instituicao"];
                    $classificacao_dh = $row["classificacao_dh"];
                    $classificacao_edh = $row["classificacao_edh"];
                    $classificacao_grupos = $row["classificacao_grupos"];
                    $resumo = $row["resumo"];
                    $vpdf = $row['pdf'];
                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }
                
            } else{
                echo "Algo deu errado, tente novamente mais tarde.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
        
        // Close connection
        mysqli_close($conn);
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Editar - Direitos Humanos</title>
    <link rel="stylesheet" href="bs3/bootstrap337.css">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="img/9.png">
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
                        <h2 id="direitostyle">Editar Registro</h2>
                    </div>
                    <form method="post">
                        <div class="form-group col-md-6 <?php echo (!empty($autor_err)) ? 'has-error' : ''; ?>">
                            <span>Autor:</span>
                            <input type="text" name="autor" class="form-control" value="<?php echo $autor; ?>">
                            <span class="help-block"><?php echo $autor_err;?></span>
                        </div>
                        <div class="form-group col-md-6 <?php echo (!empty($orientador_err)) ? 'has-error' : ''; ?>">
                            <span>Orientador:</span>
                            <input type="text" name="orientador" class="form-control" value="<?php echo $orientador; ?>">
                            <span class="help-block"><?php echo $orientador_err;?></span>
                        </div>
                        
                        <div class="form-group col-md-12 <?php echo (!empty($assunto_err)) ? 'has-error' : ''; ?>">
                            <span>Assunto:</span>
                            <input type="text" name="assunto" class="form-control" value="<?php echo $assunto; ?>">
                            <span class="help-block"><?php echo $titulo_err;?></span>
                        </div>
                        <div class="form-group col-md-12 <?php echo (!empty($titulo_err)) ? 'has-error' : ''; ?>">
                            <span>Titulo:</span>
                            <input type="text" name="titulo" class="form-control" value="<?php echo $titulo; ?>">
                            <span class="help-block"><?php echo $titulo_err;?></span>
                        </div>
                        <div class="aqui">
                        <div class="form-group col-md-4 <?php echo (!empty($ano_defesa_err)) ? 'has-error' : ''; ?>">
                            <span>Ano:</span>
                            <input type="number" name="ano_defesa" class="form-control" min="1980" max="2021" style="width:90px"; value="<?php echo $ano_defesa; ?>">
                            <span class="help-block"><?php echo $ano_defesa_err;?></span>
                        </div>

                    <div class="form-group col-md-4">
                        <span class="form-check-label">Tipo:</span><br><br>
                        <input class="form-check-input" type="radio" name="tipo"  value="Mestrado" <?php if ($tipo == "Mestrado"){ echo "checked"; }?>> Mestrado
                        <input class="form-check-input" type="radio" name="tipo" value="Doutorado" <?php if ($tipo == "Doutorado"){ echo "checked"; }?>> Doutorado
                    </div>
                    
                    <div class="form-group col-md-4">
                        <span class="form-check-label">Instituição:</span><br><br>
                        <input class="form-check-input" type="radio" name="instituicao"  value="UNB" <?php if ($instituicao == "UNB"){ echo "checked"; }?>> UnB
                        <input class="form-check-input" type="radio" name="instituicao" value="UFG" <?php if ($instituicao == "UFG"){ echo "checked"; }?>> UFG
                        <input class="form-check-input" type="radio" name="instituicao" value="UFP" <?php if ($instituicao == "UFP"){ echo "checked"; }?>> UFP
                        </div>
                    </div>
                


                    <div class="form-group  col-md-12">
                    <span>Classificação Geral:</span><br><br>
                    <div class="form-check">
                    <input type="checkbox" checked id="dh" 
                    onchange="valueChanged()"> Direitos Humanos</label><br>
                    <input type="checkbox" checked id="edh" 
                    onchange="valueChangee()"> Educação em Direitos Humanos</label><br>
                    </div>
                    
                <script type="text/javascript">

                function valueChanged() {
                if (document.getElementById('dh').checked) {
                    document.getElementById("subnetmaskdiv1").style.display = 'block';
                }
                else {
                    document.getElementById("subnetmaskdiv1").style.display = 'none';
                }
                };

                function valueChangee() {
                if (document.getElementById('edh').checked) {
                    document.getElementById("subnetmaskdiv2").style.display = 'block';
                }
                else {
                    document.getElementById("subnetmaskdiv2").style.display = 'none';
                }
                }
                </script>                 
    </div>

        <div class="form-group  col-md-6">
        <div class="form-group" id="subnetmaskdiv1">
        <br>
        <input type="radio"   name="classificacao_dh" value="Direitos Sociais" <?php if ($classificacao_dh == "Direitos Sociais"){ echo "checked"; }?>>
        Direitos Sociais (DSOC)
        <br>
        <input type="radio"   name="classificacao_dh" value="Direitos Economicos" <?php if ($classificacao_dh == "Direitos Economicos"){ echo "checked"; }?>>
        Direitos Economicos (DECO)
        <br>
        <input type="radio"   name="classificacao_dh" value="Direitos Culturais" <?php if ($classificacao_dh == "Direitos Culturais"){ echo "checked"; }?>>
        Direitos Culturais (DCUL)
        <br>
        <input type="radio"   name="classificacao_dh" value="Direitos Politicos" <?php if ($classificacao_dh == "Direitos Politicos"){ echo "checked"; }?>>
        Direitos Politicos (DPOL)
        <br>
        <input type="radio"   name="classificacao_dh" value="Direitos Civis" <?php if ($classificacao_dh == "Direitos Civis"){ echo "checked"; }?>>
        Direitos Civis (DCIV)
        <br>
        <input type="radio"   name="classificacao_dh" value="Direitos Ambientais" <?php if ($classificacao_dh == "Direitos Ambientais"){ echo "checked"; }?>>
        Direitos Ambientais (DAMB)
        <br>
        <input type="radio"   name="classificacao_dh" value="Mais de um direito" <?php if ($classificacao_dh == "Mais de um direito"){ echo "checked"; }?>>
        Mais de um direito (MDIR)
        <br>
        <input type="radio"   name="classificacao_dh" value="" <?php if ($classificacao_dh == ""){ echo "checked"; }?>>
        Nenhum
        </div>
        </div>

        <div class="form-group  col-md-6 ">
                <div class="row" id="subnetmaskdiv2">
                <br><input type="radio"   name="classificacao_edh" value="Formação para conhecimento sobre direitos humanos" <?php if ($classificacao_edh == "Formação para conhecimento sobre direitos humanos"){ echo "checked"; }?>>
                Formação para conhecimento sobre direitos humanos (FCDH)
            <br>
                <input type="radio"   name="classificacao_edh" value="Formação de sujeito de direitos" <?php if ($classificacao_edh == "Formação de sujeito de direitos"){ echo "checked"; }?>>
                Formação de sujeito de direitos (FSDI)
            <br>
                <input type="radio"   name="classificacao_edh" value="Formação em atitude e pratica cidadãs" <?php if ($classificacao_edh == "Formação em atitude e pratica cidadãs"){ echo "checked"; }?>>
                Formação em atitude e pratica cidadãs (FAPC)
            <br>
                <input type="radio"   name="classificacao_edh" value="Formação de consciência cidadã ao nível cognitivo, social, ético e político" <?php if ($classificacao_edh == "Formação de consciência cidadã ao nível cognitivo, social, ético e político"){ echo "checked"; }?>>
                Formação de consciência cidadã ao nível cognitivo, social, ético e político (FCCI)
            <br>           
                <input type="radio"   name="classificacao_edh" value="Formação em metodologias de aprendizagem participativas" <?php if ($classificacao_edh == "Formação em metodologias de aprendizagem participativas"){ echo "checked"; }?>>
                Formação em metodologias de aprendizagem participativas (FMAP)
            <br>           
                <input type="radio"  name="classificacao_edh" value="Formação e fortalecimento de práticas individuais e sociais capazes de gerar instrumentos e ações a favorde promoção proteção defesa e reparação dos direitos humanos" <?php if ($classificacao_edh == "Formação e fortalecimento de práticas individuais e sociais capazes de gerar instrumentos e ações a favorde promoção proteção defesa e reparação dos direitos humanos"){ echo "checked"; }?>>
                Formação e fortalecimento de práticas individuais e sociais capazes de gerar instrumentos e ações a favorde promoção proteção defesa e reparação dos direitos humanos (FPIS)
                <br>
                <input type="radio"   name="classificacao_edh" value="" <?php if ($classificacao_edh == ""){ echo "checked"; }?>>
                Nenhum
        </div>
        </div>

                <div class="form-group col-md-12">
                    <h4 style=" font-size:20px;">Classificação dos grupos</h4>
                    </div>
                    <div class="form-group col-md-6">
                    <input type="radio" name="classificacao_grupos" value="Crianças e adolescentes" <?php if ($classificacao_grupos == "Crianças e adolescentes"){ echo "checked"; }?>> Crianças e adolescentes (CRAD)
                    <br>
                    <input type="radio" name="classificacao_grupos" value="Povos indígenas" <?php if ($classificacao_grupos == "Povos indígenas"){ echo "checked"; }?>> Povos indígenas (INDI)
                    <br>
                    <input type="radio" name="classificacao_grupos" value="Comunidades tradicionais" <?php if ($classificacao_grupos == "Comunidades tradicionais"){ echo "checked"; }?>> Comunidades tradicionais (CTRA)
                    <br>
                    <input type="radio" name="classificacao_grupos" value="Mulheres" <?php if ($classificacao_grupos == "Mulheres"){ echo "checked"; }?>> Mulheres (MULH)
                    <br>
                    <input type="radio" name="classificacao_grupos" value="LGBTQI+" <?php if ($classificacao_grupos == "LGBTQI+"){ echo "checked"; }?>> LGBTQI+ (LGBT)
                    <br>
                    <input type="radio" name="classificacao_grupos" value="Afrodecendentes" <?php if ($classificacao_grupos == "Afrodecendentes"){ echo "checked"; }?>> Afrodecendentes (AFRO)
                    <br>
                    <input type="radio" name="classificacao_grupos" value="Pessoas com deficiência" <?php if ($classificacao_grupos == "Pessoas com deficiência"){ echo "checked"; }?>> Pessoas com deficiência (PDEF)
                    <br>
                    <input type="radio" name="classificacao_grupos" value="População em situação em rua" <?php if ($classificacao_grupos == "População em situação em rua"){ echo "checked"; }?>> População em situação em rua (PRUA)
                    <br>
                    </div>
                    <div class="form-group col-md-6">
                    <input type="radio" name="classificacao_grupos" value="Catadores de material reciclável" style="margin-top:0px" <?php if ($classificacao_grupos == "Catadores de material reciclável"){ echo "checked"; }?>> Catadores de material reciclável (CMRE)
                    <br>
                    <input type="radio" name="classificacao_grupos" value="Idosos" <?php if ($classificacao_grupos == "Idosos"){ echo "checked"; }?>> Idosos (IDOS)
                    <br>
                    <input type="radio" name="classificacao_grupos" value="rabalhadores pobres" <?php if ($classificacao_grupos == "rabalhadores pobres"){ echo "checked"; }?>> Trabalhadores pobres (TRAMBP)
                    <br>
                    <input type="radio" name="classificacao_grupos" value="Refugiados" <?php if ($classificacao_grupos == "Refugiados"){ echo "checked"; }?>> Refugiados (REFU)
                    <br>
                    <input type="radio" name="classificacao_grupos" value="Migrantes" <?php if ($classificacao_grupos == "Migrantes"){ echo "checked"; }?>> Migrantes (MIGR)
                    <br>
                    <input type="radio" name="classificacao_grupos" value="Presos/as" <?php if ($classificacao_grupos == "Presos/as"){ echo "checked"; }?>> Presos/as (PRES)
                    <br>
                    <input type="radio" name="classificacao_grupos" value="Mais de um grupo vulnerável" <?php if ($classificacao_grupos == "Mais de um grupo vulnerável"){ echo "checked"; }?>> Mais de um grupo vulnerável (MUGV)<br>
                    <input type="radio" name="classificacao_grupos" value="" <?php if ($classificacao_grupos == ""){ echo "checked"; }?>> Nenhum
                    <br>
                    </div>

                    <div class="form-group col-md-12 <?php echo (!empty($resumo_err)) ? 'has-error' : ''; ?>">
                        <br><span>Resumo</span>
                        <textarea name="resumo" rows="6" cols="44" class="form-control"><?php echo $resumo; ?></textarea>
                        <span class="help-block"><?php echo $resumo_err;?></span>
                    </div>
                    </div class="form-group col-md-12">
                    <br><span>PDF:</span>
                    <input type="text" name="pdf" style="width:500px;" value="<?= $vpdf; ?>">
                    </div>
                    <div class="form-group col-md-12">
                    <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                    <input type="submit" class="btn btn-primary" value="Atualizar" style="float:right; margin-left:10px;">
                    <a href="index.php" class="btn btn-default" style="float:right;">Cancelar</a>
                    </div>
                    </form>
            </div>    
        </div>
    </div>
</body>
</html>