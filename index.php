<?php
    include('config.php');
    session_start();
?>
<!DOCTYPE html>
  <html lang="en">
  <head>
  <meta charset="UTF-8">
  <title>Direitos Humanos</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="stylesheet" href="style.css">
  <link rel="shortcut icon" href="img/3.png">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>          
    <style>
        .MUDANDO{
            background-color: black;
        }
    </style>
<div class="container">
<div class="row">     
    <div class="col-md-12">    
        <!-- Cabeçario --> 
        <div class="header">
            <img src="img/cabecario.jpeg" class="img-fluid" style="margin-bottom:5px;">                 
            <div style="text-align:right">
            <?php
            if ( isset($_SESSION['usuario']))
            { ?>
                <right><h4 id="bemvindo" style="font-size:19px" >Bem vindo, <?php echo ucfirst($_SESSION['usuario']);?></h2>
                <a href="login/adminlogin/logout.php"><u style="font-size:16px";>Sair</u></right>
                <hr>
                <nav class="navbar">
                    <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                    <a href="Cursos/Cursos.php" id="adicionarstyle" class="btn btn-primary pull-right" style="font-size: 14px; padding:4px 14px;">Cursos</a>

                    <a href="adicionar/adicionarRegistro.php" id="adicionarstyle" class="btn btn-primary pull-right" style="font-size: 14px; padding:4px 14px;">Adicionar Registro</a>
                    </li>
                    </ul>
                </nav>

                <?php 
            } else { 
                ?>  
                <a href="login/adminlogin/loginadmin.php"><i class="fas fa-user-cog fa-2x" style="margin-bottom:10px;"></i></a>
                </right>
                
            <?php ;}
            ?>
            </div>
            </div>
            <div class="">
                <form class="" action="index.php" method="POST">
                <input class="form-control me-2" type="search" placeholder="Inserir termo..." aria-label="Search" name="busca" autofocus>
                <button class="btn btn-success" type="submit" style="float:right; margin-top:5px; padding:4px 24px;">Buscar</button>
                </form>
            </div>
    </div>
    <!-- Checkbox -->
    <div class="col-md-3" style="margin-top:4px;" >

    <form action="" method="POST">           
        <div class="card  mt-3" style="width:270px;">
        <div class="card-header">
            <h4 id="tiposcheck" style="font-size:22px";>Filtrar
                <button type="submit" class="btn btn-primary btn-sm" style="float:right; padding: 4px 13px" name="submit">Buscar</button>
            </h4>
            </form>
            <a href="index.php"><img src="img/6.png" title="Resetar" style="width:18px; height:18px; margin-top:8px; float:right; margin-right:3px;"></a>
        </div>

        <div class="card-body">
        <br>
        <h4 id="filtrarstyle">Universidade</h4>
            <hr>
            <?php   
                $sql = "SELECT COUNT(instituicao) as QTDunb FROM tese_dissertacao where instituicao = 'Universidade de Brasília (UnB)'"; 
                $dados = mysqli_query($conn, $sql);
                $linha = mysqli_fetch_array($dados)
            ?>
                <input type="checkbox" name="instituicao[]" value="Universidade de Brasília (UnB)"> UnB           
                <span style="font-size:12px;  float:right;" class="circulo"><?php echo $linha['QTDunb'] ?></span>
                <br>
                <br>
                
            <?php   
                $sql = "SELECT COUNT(instituicao) as QTDufp FROM tese_dissertacao where instituicao = 'Universidade Federal de Pernambuco (UFPE)'"; 
                $dados = mysqli_query($conn, $sql);
                $linha = mysqli_fetch_array($dados)
            ?>
                <input type="checkbox" name="instituicao[]" value="Universidade Federal de Pernambuco (UFPE)"> UFPE 
                <span style="font-size:12px;  float:right" class="circulo"><?php echo $linha['QTDufp'] ?></span>
                <br>
                <br>
            <?php
                $sql = "SELECT COUNT(instituicao) as QTDufg FROM tese_dissertacao where instituicao = 'Universidade Federal de Goiás (UFG)'"; 
                $dados = mysqli_query($conn, $sql);
                $linha = mysqli_fetch_array($dados)
            ?>
                <input type="checkbox" name="instituicao[]" value="Universidade Federal de Goiás (UFG)"> UFG
                <span style="font-size:12px;  float:right;" class="circulo"><?php echo $linha['QTDufg'] ?></span>
                
            <br>
            <br>
            <br>
            <h4 id="filtrarstyle">Cursos</h4>
            <hr>
            <?php
                $sql = "SELECT DISTINCT curso FROM cursos";
                $dados = mysqli_query($conn, $sql);                  
                while($linha = mysqli_fetch_array($dados)){       
            ?>
                <input type="checkbox" name="curso[]" value="<?=$linha['curso'] ?>">

            <?= $linha['curso']; 
                $sql = "SELECT COUNT(curso) as qtdCurso FROM tese_dissertacao WHERE curso = '".$linha['curso']."'";
                $dadosCurso = mysqli_query($conn, $sql);
                $linhaCurso = mysqli_fetch_array($dadosCurso)   
            ?>
                <span style="font-size:12px; float:right;" class="circulo"><?= $linhaCurso['qtdCurso'] ?></span>                 
                <br>
                <br>
                    <?php } ?>
            <br>
            <h4 id="filtrarstyle">Área</h4>
            <hr>
            <?php   
                $sql = "SELECT COUNT(classificacao_geral) as QTDclass FROM tese_dissertacao where classificacao_geral = 'Direitos humanos'"; 
                $dados = mysqli_query($conn, $sql);
                $linha = mysqli_fetch_array($dados)
            ?>
            <input type="checkbox" style="margin-bottom:10px" id="dh" name="classificacao_geral[]" value="Direitos humanos"> Direitos Humanos
            <span style="font-size:12px;  float:right" class="circulo"><?php echo $linha['QTDclass'] ?></span>
            <br>
            <br>
            <?php   
                $sql = "SELECT COUNT(classificacao_geral) as QTDclass FROM tese_dissertacao where classificacao_geral = 'Educação em direitos humanos'"; 
                $dados = mysqli_query($conn, $sql);
                $linha = mysqli_fetch_array($dados)
            ?>
            <input type="checkbox" id="edh" name="classificacao_geral[]" value="Educação em direitos humanos"> Educação em Direitos Humanos
            <span style="font-size:12px;  float:right" class="circulo"><?php echo $linha['QTDclass'] ?></span>
            <br>
            <br>
            <br>
            <h4 id="filtrarstyle">Tipo</h4>
            <hr>                               
                <?php   
                    $sql = "SELECT COUNT(tipo) as QTD FROM tese_dissertacao where tipo = 'Mestrado'"; 
                    $dados = mysqli_query($conn, $sql);
                    $linha = mysqli_fetch_array($dados)
                ?>
                
                <input type="checkbox" name="tipo[]" value="Mestrado">
                Mestrado 
                <span style="font-size:12px; float:right;" class="circulo"><?php echo $linha['QTD']?></span>
                </span>
                <br>
                <br>
                <?php   
                    $sql = "SELECT COUNT(tipo) as QTDD FROM tese_dissertacao where tipo = 'Doutorado'"; 
                    $dados = mysqli_query($conn, $sql);
                    $linha = mysqli_fetch_array($dados)
                ?>
                <input type="checkbox" name="tipo[]" value="Doutorado">
                Doutorado
                <span style="font-size:12px; float:right;" class="circulo"><?php echo $linha['QTDD']?></span>
                <br>
                <br>                                                            
                <br>
            <h4 id="filtrarstyle">Ano</h4>
            <hr>          
            <?php
                $sql = "SELECT DISTINCT ano_defesa FROM tese_dissertacao";
                $dados = mysqli_query($conn, $sql);                  
                while($linha = mysqli_fetch_array($dados)){       
            ?>
                <input type="checkbox" name="anodef[]" value="<?=$linha['ano_defesa'] ?>">
                
            <?php echo $linha['ano_defesa']; 
                $sql = "SELECT COUNT(ano_defesa) as qtdAno FROM tese_dissertacao WHERE ano_defesa = '".$linha['ano_defesa']."'";
                $dadosAno = mysqli_query($conn, $sql);
                $linhaAno = mysqli_fetch_array($dadosAno)   
            ?>
                <span style="font-size:12px; float:right;" class="circulo"><?php echo $linhaAno['qtdAno'] ?></span>                 
                <br>
                <br>
                    <?php } ?>               
            </div>
        </div>
    </div>
    <!-- Registros da Tabela -->
        <div class="col-md-9 mt-3">                             
              <!-- /.card-header -->
        <table id="example2" class="table table-hover">
            <thead>
            <tr>
            <th>ID</th> 
            <th>Autor</th>
            <th>Titulo</th>
            <th width="10">Ano</th>
            <th width="70">Ação</th>
            </thead>

            <tbody>
            <?php
               $sql = "SELECT * FROM tese_dissertacao WHERE 1 = 1 ";
               if(isset($_POST['busca'])){
                $buscando = $_POST['busca'];
                $sql = "SELECT * FROM tese_dissertacao WHERE autor LIKE '%".$buscando."%'
                 OR  titulo LIKE '%".$buscando."%' ";
                 
                } else{
                
                $buscando = "nada encontrado";
                
                }
                         
                $num_tipo_check = '';
                $num_ano_check = '';
                $num_inst_check = '';
                $num_class_check = '';
                $num_curso_check = '';
 
                if(isset ($_POST['tipo'])){
                    $tipocheck = $_POST['tipo'];   
                    
                    
                    foreach($tipocheck as $linharesult) :{
                        
                        if (count($tipocheck) == 1){
                            $num_tipo_check = $num_tipo_check . "'" . $linharesult . "'";
                        } else{
                            $num_tipo_check = $num_tipo_check . "'" . $linharesult . "'" . ",";
                        }
                        
                                
                    } endforeach;

                    if(substr($num_tipo_check, -1) == ","){
                        $num_tipo_check = substr($num_tipo_check, 0, -1);    
                    }


                    $sql = $sql . " AND tipo IN (" .$num_tipo_check . ")";
                    
                }

                if(isset ($_POST['anodef'])){
                    $anocheck = $_POST['anodef'];   
                    
                    
                    foreach($anocheck as $linharesult) :{
                        
                        if (count($anocheck) == 1){
                            $num_ano_check =  $num_ano_check . "'" . $linharesult . "'" ;
                        } else{
                            $num_ano_check =  $num_ano_check . "'" . $linharesult . "'" . ",";
                        }
                        
                                
                    } endforeach;

                    if(substr($num_ano_check, -1) == ","){
                        $num_ano_check = substr($num_ano_check, 0, -1);    
                    }

                    $sql = $sql . "AND ano_defesa IN (" .$num_ano_check . ")";
                    
                    
                }

                if(isset ($_POST['instituicao'])){
                    $insticheck = $_POST['instituicao'];   
                    
                    
                    foreach($insticheck as $linharesult) :{
                        
                        if (count($insticheck) == 1){
                            $num_inst_check =  $num_inst_check . "'" . $linharesult . "'" ;
                        } else{
                            $num_inst_check =  $num_inst_check . "'" . $linharesult . "'" . ",";
                        }
                        
                                
                    } endforeach;

                    if(substr($num_inst_check, -1) == ","){
                        $num_inst_check = substr($num_inst_check, 0, -1);    
                    }

                    $sql = $sql . "AND instituicao IN (" .$num_inst_check . ")";
                    
                    
                }

                if(isset ($_POST['classificacao_geral'])){
                    $classcheck = $_POST['classificacao_geral'];   
                    
                    
                    foreach($classcheck as $linharesult) :{
                        
                        if (count($classcheck) == 1){
                            $num_class_check =  $num_class_check . "'" . $linharesult . "'" ;
                        } else{
                            $num_class_check =  $num_class_check . "'" . $linharesult . "'" . ",";
                        }
                        
                                
                    } endforeach;

                    if(substr($num_class_check, -1) == ","){
                        $num_class_check = substr($num_class_check, 0, -1);    
                    }

                    $sql = $sql . "AND classificacao_geral IN (" .$num_class_check . ")";
                    
                    
                }

                if(isset ($_POST['curso'])){
                    $classcheck = $_POST['curso'];   
                    
                    
                    foreach($classcheck as $linharesult) :{
                        
                        if (count($classcheck) == 1){
                            $num_curso_check =  $num_curso_check . "'" . $linharesult . "'" ;
                        } else{
                            $num_curso_check =  $num_curso_check . "'" . $linharesult . "'" . ",";
                        }
                        
                                
                    } endforeach;

                    if(substr($num_curso_check, -1) == ","){
                        $num_curso_check = substr($num_curso_check, 0, -1);    
                    }

                    $sql = $sql . "AND curso IN (" .$num_curso_check . ")";
                    
                    
                }
                
                // ENVIANDO DADOS
                $dados = mysqli_query($conn, $sql);                  
                while($linha = mysqli_fetch_array($dados)){
                echo "<tr>";
                    echo "<td>" . $linha['id'] . "</td>";
                    echo "<td>" . $linha['autor'] . "</td>";
                    echo "<td>" . $linha['titulo'] . "</td>";
                    echo "<td>" . $linha['ano_defesa'] . "</td>";
                    echo "<td>";
                        echo "<a href='detalhes.php?id=".$linha['id']."' class='btn btn-primary btn-sm'>Detalhes</a>";
                        if (isset ($_SESSION['usuario'])){
                            echo "<a href='editar/editar.php?id=".$linha['id']."' class='btn btn-warning btn-sm'  style='margin-top:3px'>Editar</a>";
                            echo "<a href='excluir/delete.php?id=".$linha['id']."' class='btn btn-danger btn-sm' style='margin-top:3px'>Excluir</a>";
                        }
                    echo "</td>";
                echo "</tr>";
            }  ?>
            
            </tbody>           
            </table>              
        </div>
    </div>
    <!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->


<script>
 $(function () {
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
</body>
</html>