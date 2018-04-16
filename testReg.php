<?php
	include './public/dbconfig.php';
	include 'MysqlModel.class.php';
	$user = new MysqlModel('user');
	$result = $user->insert($_POST);
	if($result){
		echo '1';
	}else{
		echo '0';
	}
	
?>