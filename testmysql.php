<?php
	include './public/dbconfig.php';
	include 'MysqlModel.class.php';
	$user = new MysqlModel('user');
	//var_dump($user);
	$result = $user->select();
	//var_dump($result);
	$a = json_encode($result);
	echo $a;
	
?>