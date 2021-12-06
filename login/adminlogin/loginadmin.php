<?php
    session_start();
?>

<!doctype html>
<html lang="en">
  <head>
  	<title>Login - Direitos Humanos</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="shortcut icon" href="../../img/4.png">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="css/style.css">

	</head>
	<body>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">				
			</div>
			<div class="row justify-content-center">
				<div class="col-md-7 col-lg-5">
					<div class="login-wrap p-4 p-md-5">
		      	<div class="icon d-flex align-items-center justify-content-center">
		      		<span class="fa fa-user-o"></span>
		      	</div>
		      	<h3 class="text-center mb-4">LOGIN</h3>

						<form action="login.php" method="POST" class="login-form">
		      		<div class="form-group">
		      			<input type="text" name="usuario" class="form-control rounded-left" placeholder="Usuario" required>
		      		</div>
	            <div class="form-group d-flex">
	              <input type="password" name="senha" class="form-control rounded-left" placeholder="Senha" required>
	            </div>
	            <div class="form-group">
	            	<button type="submit" class="form-control btn btn-primary rounded submit px-3">Logar</button>
	            </div>
				
				<?php
                    if(isset($_SESSION['nao_autenticado'])):
                    ?>
                    <div class="alert alert-danger">
                      <p>ERRO: Usuário ou senha inválidos.</p>
                    </div>
                    <?php
                    endif;
                    unset($_SESSION['nao_autenticado']);
                    ?>

	        
					<div class="form-group d-md-flex">
					<div class="w-50">
					<a href="../../index.php" class="btn btn-primary rounded submit ">Voltar</a>
					</div>
								
	          </form>
	        </div>
				</div>
			</div>
		</div>
	</section>

	<script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>







	</body>
</html>

