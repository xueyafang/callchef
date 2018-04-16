<!doctype html>
<html>

	<head>
		<meta charset="UTF-8">
		<title></title>
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<link href="css/mui.min.css" rel="stylesheet" />
		<style type="text/css">
			#item1,#item2,#item3{
				border-bottom:0px;
			}
			#tupian{
				background:yellow;
				margin:0 auto;
				width:50px;
				height:50px;
				margin-top:80px;
				margin-bottom:20px;
			}
			.mui-slider-item p{
				text-align:center;
			}
			.mui-bar-tab .mui-tab-item.mui-active{
    			color:#f56d02;
    		}
		</style>
	</head>

	<body>
		<header class="mui-bar mui-bar-nav">
		    <h1 class="mui-title">我的订单</h1>
		    <?php
			session_start();
			//echo $_SESSION['uid'];
			//看uid的order
			$uid = $_SESSION['uid'];
			//echo $uid;
			include "./public/dbconfig.php";
			include "./MysqlModel.class.php";
			$orders = new MysqlModel('`order`');
			$result = $orders->where('uid='.$uid)->select();
			//$res_chef = $chef->where('cid='.$id)->find();
			//var_dump($result);
			
			
		?>
		</header>
		
		<div class="mui-content">
			<?php
				if($result){
					//遍历数据	
					//var_dump($result);
					foreach($result as $v){	
						$chef = new MysqlModel('chef');
						$res_chef = $chef->where('cid='.$v['cid'])->find();	
						//var_dump($res_chef);
			?>
			<ul class="mui-table-view">
			    <li class="mui-table-view-cell mui-media">
			        <a href="javascript:;">
			            <img class="mui-media-object mui-pull-right" width="100%" src="<?php echo $res_chef['person_pic']?>">
			            <div class="mui-media-body">
			               	 <p>姓名:<?php echo $v['uname'] ?></p>
			               	<p>地址:<?php echo $v['uaddress']?></p>
			               	<p>用餐时间:<?php echo $v['utime']?></p>
			                <p>御用大厨:<?php echo $v['cname']?></p>
			                <p>大厨号码:<?php echo $res_chef['phone']?></p>
			            </div>
			        </a>
			    </li>
			</ul>
			<?php
				}
				}else{
			?>
			<div class="mui-slider">
		    <div class="mui-slider-group">
		        <div id="item1" class="mui-slider-item">
		        	<div id="tupian">
		        		<img src="images/dingdan.gif">
		        	</div>
		        	<p>你还没有相关订单</p>
		        </div>
		    </div>
			</div>
			<?php }   ?> 
		</div>
		<nav class="mui-bar mui-bar-tab">
	        <a class="mui-tab-item " href="http://192.168.43.154/chef/main.php" id="index" >
	            <span class="mui-icon mui-icon-home"></span>
	            <span class="mui-tab-label">首页</span>
	        </a>
	        <a class="mui-tab-item" href="http://192.168.43.154/chef/selectchef.php" id="index">
	            <span class="mui-icon mui-icon-person"></span>
	            <span class="mui-tab-label">厨师</span>
	        </a>
	        <a class="mui-tab-item mui-active" href="http://192.168.43.154/chef/orders.php" id="index">
	            <span class="mui-icon  mui-icon-locked"></span>
	            <span class="mui-tab-label">订单</span>
	        </a>
	        <a class="mui-tab-item" href="http://192.168.43.154/chef/setting.php" id="index">
	            <span class="mui-icon mui-icon-gear"></span>
	            <span class="mui-tab-label">我的</span>
	        </a>
	    </nav>
	</body>
	<script src="js/mui.min.js"></script>
	<script type="text/javascript">
		mui.init();
		mui('.mui-bar-tab').on('tap','a',function(){document.location.href=this.href;});
			//mui.alert("b");
		
	</script>
</html>