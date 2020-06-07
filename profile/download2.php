<?php
$db = mysqli_connect('localhost:3306', 'root', '', 'TW');
if (session_status() == PHP_SESSION_NONE) {
		session_start();
} 
if(isset($_POST["ExportFav"]) && ($_SESSION['user_role']=='admin')){

			header('Content-Type: text/csv; charset=utf-8mb4_bin');  
			header('Content-Disposition: attachment; filename=favourites.csv');  
			$output = fopen("php://output", "w");  
			fputcsv($output, array('Username','Track_ID','Track_Name'));  
			$query = "SELECT username,track_id,track_name from favourites ORDER BY username ASC";  
			$result = mysqli_query($db, $query);  
			while($row = mysqli_fetch_assoc($result))  
			{  
				fputcsv($output, $row);  
			}  
			fclose($output);
}
else {header("location: ../index.php");}
?>