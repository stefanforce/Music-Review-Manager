<?php
$db = mysqli_connect('localhost:3306', 'root', '', 'TW');
if(isset($_POST["Export"])){
     
    header('Content-Type: text/csv; charset=utf-8mb4_bin');  
    header('Content-Disposition: attachment; filename=reviews.csv');  
    $output = fopen("php://output", "w");  
    fputcsv($output, array('ID','User_ID','User_Name','Type','Entity_ID','Entity_Name','Text','Written_At'));  
    $query = "SELECT * from reviews ORDER BY id DESC";  
    $result = mysqli_query($db, $query);  
    while($row = mysqli_fetch_assoc($result))  
    {  
         fputcsv($output, $row);  
    }  
    fclose($output);  
}  
?>