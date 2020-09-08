<?php

	require_once ROOT_PATH . "config/config.php";

	try {
		$dbConnection = mysqli_connect(HOST, USER, PASS);
		$dropDB = "DROP DATABASE " . DBNAME; // in case any failure

		if ($dbConnection === false){
		    die();
		}

		mysqli_query($dbConnection, $dropDB);

		echo DBNAME . " was deleted successfully";
	} catch (Exception $e) {
		echo "Something goes wrong";

		die();
	}
?>