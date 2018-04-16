<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title></title>
		<link href="css/mui.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="./css/iconfont.css" />
		<style>
			ul {
				font-size: 14px;
				color: #8f8f94;
			}
			.mui-btn {
				padding: 10px;
			}
			.mui-slider-item img{
				height:180px;
			}
			.mui-slider-indicator{
    			text-align:right;
    		}
    		.mui-media-object{
    			
    			height:20px;
    		}
    		.foot{
    			width:200px;
    			height:50px;
    		}
    		/*设置底部激活*/
    		.mui-bar-tab .mui-tab-item.mui-active{
    			color:#f56d02;
    		}
		</style>
	</head>

	<body>
		
		<header class="mui-bar mui-bar-nav">
		    <h1 class="mui-title">召唤大厨</h1>
		    <?php
		    	session_start();
		    	if(isset($_GET['id'])){
		    		$id = $_GET['id'];
		    	}else{
					$id = $_SESSION['uid'];
		    	}
		    	$_SESSION['uid'] = $id; 
		    ?>
		</header>
		<div class="mui-content">
		    <!--轮播图-->
		    <div id="slider" class="mui-slider" >
	      <div class="mui-slider-group mui-slider-loop">
	        <!-- 额外增加的一个节点(循环轮播：第一个节点是最后一张轮播) -->
	        <div class="mui-slider-item mui-slider-item-duplicate">
	          <a href="#">
	            <img src="./images/slider/4.jpg">
	          </a>
	        </div>
	        <!-- 第一张 -->
	        <div class="mui-slider-item">
	          <a href="#">
	            <img src="./images/slider/1.jpg">
	          </a>
	        </div>
	        <!-- 第二张 -->
	        <div class="mui-slider-item">
	          <a href="#">
	            <img src="./images/slider/2.jpg">
	          </a>
	        </div>
	        <!-- 第三张 -->
	        <div class="mui-slider-item">
	          <a href="#">
	            <img src="./images/slider/3.jpg">
	          </a>
	        </div>
	        <!-- 第四张 -->
	        <div class="mui-slider-item">
	          <a href="#">
	            <img src="./images/slider/4.jpg">
	          </a>
	        </div>
	        <!-- 额外增加的一个节点(循环轮播：最后一个节点是第一张轮播) -->
	        <div class="mui-slider-item mui-slider-item-duplicate">
	          <a href="#">
	            <img src="./images/slider/1.jpg">
	          </a>
	        </div>
	      </div>
	      <div class="mui-slider-indicator">
	        <div class="mui-indicator mui-active"></div>
	        <div class="mui-indicator"></div>
	        <div class="mui-indicator"></div>
	        <div class="mui-indicator"></div>
	      </div>
	    </div>
	    <ul class="mui-table-view mui-grid-view">
	        <li class="mui-table-view-cell mui-media mui-col-xs-6">
	            <a href="#">
	                <img src="./images/1.gif">
	                <div class="mui-media-body">家常用餐</div>
	            </a>
	        </li>
	        <li class="mui-table-view-cell mui-media mui-col-xs-6">
	            <a href="#">
	                <img width="56px" src="./images/2.gif">
	                <div class="mui-media-body">私人订制</div>
	            </a>
	        </li>
	    </ul>
	    <!--热门服务-->
	    <ul class="mui-table-view mui-grid-view">
	        <li class="mui-table-view-cell mui-media mui-col-xs-12">
	            <a href="#">
	                <img class="mui-media-object" src="images/2.jpg">
	                <div class="mui-media-body">精选家宴</div>
	            </a>
	        </li>
	        <li class="mui-table-view-cell mui-media mui-col-xs-12">
	            <a href="#">
	                <img class="mui-media-object" src="images/1.jpg">
	                <div class="mui-media-body">企业活动</div>
	            </a>
	        </li>
	        <li class="mui-table-view-cell mui-media mui-col-xs-12">
	            <a href="#">
	                <img class="mui-media-object" src="images/3.jpg">
	                <div class="mui-media-body">单品热卖</div>
	            </a>
	        </li>
	        <li class="mui-table-view-cell mui-media mui-col-xs-12">
	            <a href="#">
	                <img class="mui-media-object" src="images/4.jpg">
	                <div class="mui-media-body">预定大厨</div>
	            </a>
	        </li>
	    </ul>
	    <div class="foot"></div>
	    
	    <!--足部-->
	    <nav class="mui-bar mui-bar-tab">
	        <a class="mui-tab-item mui-active" href="http://192.168.43.154/chef/main.php" id="index" >
	            <span class="mui-icon mui-icon-home"></span>
	            <span class="mui-tab-label">首页</span>
	        </a>
	        <a class="mui-tab-item" href="http://192.168.43.154/chef/selectchef.php" id="index">
	            <span class="mui-icon mui-icon-person"></span>
	            <span class="mui-tab-label">厨师</span>
	        </a>
	        <a class="mui-tab-item" href="http://192.168.43.154/chef/orders.php" id="index">
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
	<script src="js/app.js"></script>
	<script type="text/javascript">
		var gallery = mui("#slider");
		gallery.slider({
			interval:3000//自动轮播
		});
	
		mui('.mui-bar-tab').on('tap','a',function(){document.location.href=this.href;});
		
	</script>
</html>