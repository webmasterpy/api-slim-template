<?php 

	define("HOST", "localhost");
    define("USER", "root");
    define("PASS", "");
    define("DBNAME", "testAPI");

    define("DBSeedScript", ROOT_PATH . "sql/generateSeedScript.sql"); // script with all queries to create the tables and initialize the db
    define("DBUpdateSeedScript", ROOT_PATH . "sql/updateSeedScript.sql"); // script with all alter tables to update the db structure