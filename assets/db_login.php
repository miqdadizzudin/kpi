<?php
	$db_host='localhost';
	$db_database='kpi';
	$db_username='root';
	$db_password='';
	
	// Connect
	$db = new mysqli($db_host, $db_username, $db_password, $db_database);
	if ($db->connect_errno){
		die ("Could not connect to the database: <br />".
		$db->connect_error);
	} 
?>