<DOCTYPE html>
	<html lang="fr">
	<head>
		<meta charset="tfs-8">
		<title> connexion_DataBase</title>
	</head>

	<body>
		<?php
			$hostname = "127.0.0.1";
			$username = "root";
			$password = "";
			$dbname = "covoiturage";
	
			$link_login = mysqli_connect($hostname, $username, $password, $dbname );

			if ($link_login == false) 
			{   echo "Erreur de connexion : " . mysqli_connect_errno() ; 
				die(); 
			} 
			
			 return $link_login  ?>

	</body>
	</html>