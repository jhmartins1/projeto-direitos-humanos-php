<?php
  session_start();
  if(isset($_SESSION['usuario'])){
    $user = $_SESSION['usuario'];
  }else{
    session_destroy();
    header("location: ../index.php");
  }