<?php
	include './public/dbconfig.php';
	include './MysqlModel.class.php';
	$user = new MysqlModel('user');
	$result = $user->select();
	if($result){
		$arr = json_encode($result);
		echo $arr;
//		foreach($result as $v){
//			$arr = json_encode($result);
//		}
	}
?>