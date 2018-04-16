<?php
	include './public/dbconfig.php';
	include 'MysqlModel.class.php';
	
	$id = $_GET['id'];
	//$id = 1;
	//1.获取到厨师信息
	$chef = new MysqlModel('chef');
	$res_chef = $chef->where('cid='.$id)->find();
	
	//2.获取到该厨师的菜单
	$menu = new MysqlModel('menu');
	$res_menu = $menu->where('cid='.$id)->select();
	//开始去铺页面
	
?>
<!doctype html>
<html>

	<head>
		<meta charset="UTF-8">
		<title></title>
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<link href="css/mui.min.css" rel="stylesheet" />
		<style type="text/css">
			.mui-slider-indicator{
    			text-align:right;
    		}
    		.mui-slider-item img{
				height:200px;
			}
			.mui-table-view span{
				color:orange;
			}
			#chef{
				margin-top:25px;
				margin-bottom:20px;
				font-size:15px;
				line-height:25px;
				color:#666;
			}
			.mui-table-view{
				/*background:gainsboro;*/
			}
		</style>
	</head>

	<body>
		<header class="mui-bar mui-bar-nav">
		    <a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left"></a>
		    <h1 class="mui-title">大厨信息</h1>
		</header>
		<div class="mui-content">
			<!--遍历出了菜-->
		    <!--轮播图-->
		    <div id="slider" class="mui-slider" >
	      <div class="mui-slider-group mui-slider-loop">
	        <!-- 额外增加的一个节点(循环轮播：第一个节点是最后一张轮播) -->
	        <div class="mui-slider-item mui-slider-item-duplicate">
	          <a href="#">
	            <img src="<?php echo $res_menu[4]['mpic'];?>">
	          </a>
	        </div>
	        <!-- 第一张 -->
	        <?php	
	        	foreach($res_menu as $v){
	        ?>
	        <div class="mui-slider-item">
	          <a href="#">
	            <img src="<?php	echo $v['mpic']?>">
	          </a>
	          <center><span><?php echo $v['mname']?></span></center>
	        </div>
	        <?php	
	        	}
	        ?>
	        <!-- 额外增加的一个节点(循环轮播：最后一个节点是第一张轮播) -->
	        <div class="mui-slider-item mui-slider-item-duplicate">
	          <a href="#">
	            <img src="<?php echo $res_menu[0]['mpic'];?>">
	          </a>
	        </div>
	      </div>
	    	
	      <!--<div class="mui-slider-indicator">
	      	<?php	
	      		for($i=0;$i<count($res_menu);$i++){
	      	?>
	      		<div class="mui-indicator"></div>
	      	<?php		
	      		}
	      	?>
	      </div>-->
	      </div>
	      <!--遍历出了厨师的信息-->
	    
	      <div class="mui-row" id="chef">
	          <div class="mui-col-xs-8">
	          	<ul class="mui-table-view">
	          <li>
	              	<div><span>大厨:</span><?php echo $res_chef['cname']?></div>
	              	
	              	<div><span>擅长的菜品描述:</span><?php echo $res_chef['description']?></div>
	              	<div>
	              		<span>手机号:</span><?php echo $res_chef['phone']?>
	              		<div class="mui-icon mui-icon-phone" onclick="dial(<?php echo $res_chef['phone']?>)"></div>	
	              	</div>
	          </li>    
	      		</ul>
	          </div>
	          <div class="mui-col-xs-4">
	          	<img src="<?php echo $res_chef['person_pic']?>" width="100%">
	          </div>
	      </div>
	      <center><button type="button" id="order" class="mui-btn mui-btn-primary mui-btn-outlined">
	      	<a href="http://192.168.43.154/chef/order.php?id=<?php echo $res_chef['cid']?>">预定</a>
	      	</button></center>
	   
	</body>
	<script src="js/mui.min.js"></script>
	<script type="text/javascript">
		mui.init();
		var gallery = mui("#slider");
		gallery.slider({
			interval:3000//自动轮播
		});
		function dial(a){
			plus.device.dial(a,false);
		}
//		var orderButton = document.getElementById('order');
//		orderButton.addEventListener('tap', function(event) {
//			mui.openWindow({
//				url:'http://192.168.1.32/chef/order.php';
//			});	
//				
//		})
	</script>
</html>