<?php
include "../validar.php";

require_once "../config.php";

$id = $_GET['id'] ?? '';
$select = "SELECT * FROM tese_dissertacao WHERE id = $id";
$dados = mysqli_query($conn, $select);

$linha = mysqli_fetch_array($dados);

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Editar - Direitos Humanos</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="shortcut icon" href="../img/8.png">
    <link rel="stylesheet" href="../bs5/css/bootstrap.min.css">
    <script src="../bs5/js/bootstrap.min.js"></script>
    <script>
    $(function() {
        $("#skill_input").autocomplete({
            source: "autocomplet.php",
        });
    });
    </script>
</head>
<body>
<div class="container">
  <div class="page-header mt-3">
    <h2 id="direitostyle">Editar Registro</h2>
    <hr>
  </div>
  <form action="editarScript.php" method="POST">
    <div class="form-group">
      <label>Universidade: </label>
      <select class="form-control mb-2" name="instituicao" value="<?= $linha['instituicao'] ?>">
      <option value="Universidade de Brasília (UnB)" <?php if($linha['instituicao']=="Universidade de Brasília (UnB)") echo 'selected="selected"'; ?>>Universidade de Brasília (UnB)</option>

      <option value="Universidade Federal de Pernambuco (UFPE)" <?php if($linha['instituicao']=="Universidade Federal de Pernambuco (UFPE)") echo 'selected="selected"'; ?>>Universidade Federal de Pernambuco (UFPE)</option>

      <option value="Universidade Federal de Goiás (UFG)" <?php if($linha['instituicao']=="Universidade Federal de Goiás (UFG)") echo 'selected="selected"'; ?>>Universidade Federal de Goiás (UFG)</option>
      </select>
    </div>
    <div class="form-group">
      <label>Curso: </label>
      <select class="form-control mb-2" name="curso">
      <?php
        $sqlw = "SELECT DISTINCT curso FROM cursos";
        $dados = mysqli_query($conn, $sqlw);                  
        while($cursolinha = mysqli_fetch_array($dados)){
        if($linha['curso'] == $cursolinha['curso']){ ?>
        <option name="curso" value="<?= $cursolinha['curso'] ?>" selected><?=$cursolinha['curso'];}else{?></option>
        <option name="curso" value="<?= $cursolinha['curso'] ?>"><?=$cursolinha['curso'];?></option>
        <?php }} ?>  
      </select>
    </div>

    <label>Area:</label>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="classificacao_geral" value="Direitos humanos" <?php if ($linha['classificacao_geral'] == "Direitos humanos"){ echo "checked"; }?>>
      <label class="form-check-label">
        Direitos Humanos
      </label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="classificacao_geral" value="Educação em direitos humanos" <?php if ($linha['classificacao_geral'] == "Educação em direitos humanos"){ echo "checked"; }?>>
      <label class="form-check-label mb-2">
        Educação em Direitos Humanos
      </label>
    </div>
    <label>Tipo:</label>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="tipo" value="Mestrado" <?php if ($linha['tipo'] == "Mestrado"){ echo "checked"; }?>>
      <label class="form-check-label">
        Mestrado
      </label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="tipo"  value="Doutorado" <?php if ($linha['tipo'] == "Doutorado"){ echo "checked"; }?>>
      <label class="form-check-label mb-2">
        Doutorado
      </label>
    </div>
    <div class="form-group">
      <label>Autor:</label>
      <input type="text" class="form-control mb-2" name="autor" value="<?= $linha['autor'] ?>" required placeholder="Insira um autor">
    </div>
    <div class="form-group">
      <label>Orientador:</label>
      <input type="text" class="form-control mb-2" name="orientador" value="<?= $linha['orientador'] ?>" required placeholder="Insira um orientador">
    </div>
    <div class="form-group">
      <label>Titulo:</label>
      <input type="text" class="form-control mb-2" name="titulo" value="<?= $linha['titulo'] ?>" required placeholder="Insira um titulo">
    </div>
    <div class="form-group">
      <label>Ano:</label>
      <input type="number" min="1980" max="2099" step="1" class="form-control mb-2" name="ano" value="<?= $linha['ano_defesa'] ?>" required placeholder="Insira um titulo">
    </div>
    <div class="form-group">
      <label>Resumo:</label>
      <textarea class="form-control mb-2" name="resumo" rows="5" required><?php echo $linha['resumo'] ?></textarea>
    </div>
    <div class="form-group">
      <label>PDF:</label>
      <input type="text" name="pdf" value="<?= $linha['pdf'] ?>" class="form-control">
    </div>
    <br>
    <input type="hidden" name="id" value="<?= $linha['id']; ?>">
    <input type="submit" name="submit" class="btn btn-primary mb-3" style="float:right">  
  </form>
    <a href="../index.php" class="btn btn-primary">Voltar</a>
</div>
</body>
</html>
