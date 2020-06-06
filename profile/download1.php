<?php
$db = mysqli_connect('localhost:3306', 'root', '', 'TW');
if (session_status() == PHP_SESSION_NONE) {
		session_start();
} 
if(isset($_POST["ExportRev"]) && ($_SESSION['user_role']=='admin')){

			header('Content-Type: text/csv; charset=utf-8mb4_bin');  
			header('Content-Disposition: attachment; filename=reviews.csv');  
			$output = fopen("php://output", "w");  
			fputcsv($output, array('Username','Entity_Type','Entity_ID','Entity_Name','Text','Date'));  
			$query = "SELECT user_name,type,entity_id,entity_name,text,written_at from reviews ORDER BY written_at DESC";  
			$result = mysqli_query($db, $query);  
			while($row = mysqli_fetch_assoc($result))  
			{  
				fputcsv($output, $row);  
			}  
			fclose($output);
}
else {header("location: ../index.html");}
?>