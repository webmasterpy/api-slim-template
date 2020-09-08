<?php 
	
	require_once ROOT_PATH . "config/config.php";

 	try {
 		$fileScript = DBUpdateSeedScript;
 		$log = "";
	 	$fileContent = "";

 		$log = "Comenzando a actualizar la estructura de la base de datos... \n \n";
 		file_put_contents(ROOT_PATH . "logs/log_" . date("j.n.Y") . ".txt", $log, FILE_APPEND);

 		$fileContent = file_get_contents($fileScript);

 		$dbConection = Connection::connect();
 		$stmt = $dbConection->prepare($fileContent);

	 	if ($stmt->execute()) {
			$log = "La estructura de la base de datos se ha modificado correctamente";
	    	file_put_contents(ROOT_PATH . "logs/log_" . date("j.n.Y") . ".txt", $log, FILE_APPEND);
	 	} else {
	 		$log = "Error al actualizar la estructura de la base de datos. " . mysqli_error($dbConnection) . "\n \n";
		    file_put_contents(ROOT_PATH . "logs/log_" . date("j.n.Y") . ".txt", $log, FILE_APPEND);

		    die();
	 	}
	} catch (Exception $e) {
		$log = $e->getMessage() . "\n \n";

		file_put_contents(ROOT_PATH . "logs/log_" . date("j.n.Y") . ".txt", $log, FILE_APPEND);
	}

?>