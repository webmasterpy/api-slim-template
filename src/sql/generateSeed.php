<?php
 
	include_once ROOT_PATH . "config/conection.php";

 	try {
 		$dbConnection = mysqli_connect(HOST, USER, PASS);
 		$createDB = "CREATE DATABASE " . DBNAME;
 		$dropDB = "DROP DATABASE " . DBNAME; // in case any failure
 		$fileScript = DBSeedScript;
 		$log = "";
	 	$fileContent = "";

		if ($dbConnection === false){
		    $log = "Error de conexion. " . mysqli_connect_error() . "\n \n";
		    file_put_contents(ROOT_PATH . "logs/log_" . date("j.n.Y") . ".txt", $log, FILE_APPEND);
		    
		    die();
		}

		if(mysqli_query($dbConnection, $createDB)){
		    $log = "Creando base de datos... \n \n";
		    file_put_contents(ROOT_PATH . "logs/log_" . date("j.n.Y") . ".txt", $log, FILE_APPEND);
		} else{
		    $log = "Error al crear la base de datos. " . mysqli_error($dbConnection) . "\n \n";
		    file_put_contents(ROOT_PATH . "logs/log_" . date("j.n.Y") . ".txt", $log, FILE_APPEND);

			$log = "La base de datos sera borrada \n \n";
		    file_put_contents(ROOT_PATH . "logs/log_" . date("j.n.Y") . ".txt", $log, FILE_APPEND);	    	

		    mysqli_query($dbConnection, $dropDB);

		    die();
		}	

 		$log = "Comenzando a generar base de datos... \n \n";
 		file_put_contents(ROOT_PATH . "logs/log_" . date("j.n.Y") . ".txt", $log, FILE_APPEND);

 		$fileContent = file_get_contents($fileScript);

 		$dbConection = Connection::connect();
 		$stmt = $dbConection->prepare($fileContent);

	 	if ($stmt->execute()) {
			$log = "La estructura de la base de datos se ha generado correctamente \n \n";
	    	file_put_contents(ROOT_PATH . "logs/log_" . date("j.n.Y") . ".txt", $log, FILE_APPEND);
	 	} else {
	 		$log = "Error al generar la estructura de la base de datos. " . mysqli_error($dbConnection) . "\n \n";
		    file_put_contents(ROOT_PATH . "logs/log_" . date("j.n.Y") . ".txt", $log, FILE_APPEND);

		   	$log = "La base de datos sera borrada \n \n";
		    file_put_contents(ROOT_PATH . "logs/log_" . date("j.n.Y") . ".txt", $log, FILE_APPEND);	    	

		    mysqli_query($dbConnection, $dropDB);

		    die();
	 	}
	} catch (Exception $e) {
		$log = $e->getMessage() . "\n \n";

		file_put_contents(ROOT_PATH . "logs/log_" . date("j.n.Y") . ".txt", $log, FILE_APPEND);
	}

?>