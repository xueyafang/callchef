<?php
	//这个id为大厨的id
	//echo $_GET['id'];
	$id = $_GET['id'];
	include('./MysqlModel.class.php');
	include('./public/dbconfig.php');
	$chef = new MysqlModel('chef');
	$res_chef = $chef->where('cid='.$id)->find();
	//var_dump($res_chef);
	//var_dump($res_chef['cname']);
?>
<!doctype html>
<html>

	<head>
		<meta charset="UTF-8">
		<title></title>
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<link href="css/mui.min.css" rel="stylesheet" />
	</head>

	<body>
		<header class="mui-bar mui-bar-nav">
		    <a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left"></a>
		    <h1 class="mui-title">确认订单</h1>
		</header>
		<div class="mui-content">
			<form  method="post" action="do_order.php">
			    <div class="mui-input-row">
			        <label>用餐地址</label>
			        <input type="text" class="mui-input-clear" name="uaddress">
			    </div>
			    <div class="mui-input-row">
			        <label>用餐时间</label>
			        <input type="text" class="mui-input-clear" name="utime">
			    </div>
			    <div class="mui-input-row">
			        <label>用户姓名</label>
			        <input type="text" class="mui-input-clear" placeholder="请输入您的姓名" name="uname">
			    </div>
			    <div class="mui-input-row">
			        <label>用户电话 </label>
			        <input type="text" class="mui-input-clear" placeholder="请输入您的电话" name="uphone">
			    </div>
			    <div class="mui-input-row">
			        <label>厨师姓名</label>
			        <input type="text" class="mui-input-clear" value="<?php echo $res_chef['cname']?>" name="cname" readonly>
			    </div>
			    <div class="mui-input-row">
			        <label>订单总额</label>
			        <input type="text" class="mui-input-clear" value="84" name="price" readonly>
			    </div>
			    <input type="hidden" name="status" value="1">
				<input type="hidden" name="cid" value="<?php echo $id ?>">
			    <center><input type="submit" class="mui-input-clear" value="提交"></center>
			   
			</form>
			
			
		</div>
	</body>
	<script src="js/mui.min.js"></script>
	<script type="text/javascript">
		mui.init()
	</script>
</html>