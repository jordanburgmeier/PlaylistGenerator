<?php

function connectDB(){
	$dbConnection = mysqli_connect("sql205.epizy.com", "epiz_26541440", "P2cBhocLKVs", "epiz_26541440_playlistgenerator");
	if (mysqli_connect_errno()){
		die(mysqli_connect_error());
	}
	//echo "Database connected successfully . . . <br>";
	return $dbConnection;
}


?>
