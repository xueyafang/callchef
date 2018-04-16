<!doctype html>
<html>

	<head>
		<meta charset="UTF-8">
		<title></title>
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<link href="css/mui.min.css" rel="stylesheet" />
	</head>

	<body>
		<script src="js/mui.min.js"></script>
		<script type="text/javascript">
			mui.init()
		</script>
		<?php
		try{
				$dsn = 'mysql:host=192.168.43.154;dbname=chef;charset=utf8';
				$pdo = new PDO($dsn,'root','');
				$pdo->setAttribute(3,1);
				session_start();	
				$uid = $_SESSION['uid'];
				$cid = $_POST['cid'];
				$uname = $_POST['uname'];
				$cname = $_POST['cname'];	
				$uaddress = $_POST['uaddress'];	
				$uphone = $_POST['uphone'];	
				$price = $_POST['price'];	
				$utime = $_POST['utime'];	
				$status = $_POST['status'];																			
				$sql = "INSERT INTO `order`(uid,cid,uname,cname,uaddress,uphone,price,utime,status) VALUES('{$uid}','{$cid}','{$uname}','{$cname}','{$uaddress}','{$uphone}','{$price}','{$utime}','{$status}')";
				//echo $sql;
				$result  = $pdo->exec($sql);
				if($result){
					echo '<script>mui.toast("支付成功");
						location="http://192.168.43.154/chef/orders.php";
					</script>';
				}else{
					echo '<script>mui.toast("支付失败,人品不好,再来一遍");</script>';
				}
			}catch(PDOException $e){
					echo $e->getMessage();
			}
?>
	</body>

</html>