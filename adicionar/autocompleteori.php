<?php

require_once "../config.php";

$procurarterm = $_GET['term'];

$sql = $conn->query("SELECT * FROM tese_dissertacao WHERE orientador LIKE '%".$procurarterm."%' ORDER BY orientador ASC");

$orientadordata = array();

if($sql->num_rows > 0){
  while($linha = $sql->fetch_assoc()){
    $dat['id'] = $linha['id'];
    $dat['value'] = $linha['orientador'];
    array_push($orientadordata, $dat);
  }
}

echo json_encode($orientadordata);