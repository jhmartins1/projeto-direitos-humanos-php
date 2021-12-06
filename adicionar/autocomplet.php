<?php

require_once "../config.php";
 

$searchTerm = $_GET['term']; 
 
// Fetch matched data from the database 
$query = $conn->query("SELECT * FROM tese_dissertacao WHERE autor LIKE '%".$searchTerm."%' ORDER BY autor ASC"); 
 

// Generate array with skills data 
$skillData = array(); 
if($query->num_rows > 0){ 
    while($row = $query->fetch_assoc()){ 
        $data['id'] = $row['id']; 
        $data['value'] = $row['autor']; 
        array_push($skillData, $data); 
    } 
} 
 
// Return results as json encoded array 
echo json_encode($skillData); 
?>