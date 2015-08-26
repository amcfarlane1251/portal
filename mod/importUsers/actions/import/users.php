<?php

$csvFileName = $_FILES['users']['tmp_name'];
$csvFile = fopen($csvFileName, 'r');
while($line = fgetcsv($csvFile)){
	//validation
	if(count($line) > 4){
		register_error('Too many fields in row');
		forward(REFERER);
	}
	elseif(count($line) < 4){
		register_error('Too few fields in row');
		forward(REFERER);
	}
	elseif(!strpos($line[1], "@"))
	{
		register_error('No email in second column');
		forward(REFERER);
	}
	//name,email,username,password for column headers
	$name = $line[0];
	$email = $line[1];
	$username = $line[2];
	$password = $line[3];
	register_user($username, $password, $name, $email, TRUE);
}
fclose($csvFile);
