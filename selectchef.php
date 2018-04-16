<!doctype html>
<html>

	<head>
		<meta charset="UTF-8">
		<title></title>
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<link href="css/mui.min.css" rel="stylesheet" />
		<style type="text/css">
			#openSheet{
				color:black;
			}
			#select{
				text-align:left;
				color:black;
				font-size:12px;
			}
			.mui-table-view-cell img{
				width:140px;
				height:140px;
			}
			#foot{
    			width:200px;
    			height:50px;
    		}
			.mui-bar-tab .mui-tab-item.mui-active{
    			color:#f56d02;
    		}
    		#riqi,#shijian{
    			display:inline-block;
    		}
		</style>
	</head>
	<?php
		include('./MysqlModel.class.php');
		include('./public/dbconfig.php');
		$chef = new MysqlModel('chef');
		$result = $chef->select();
		//var_dump($result);
		if($result){
			
	?>
	<body>
		<header class="mui-bar mui-bar-nav">
		    <h1 class="mui-title">厨师</h1>
		</header>
<div class="mui-content">
    <!--<div style="padding:10px;" id="riqi">
        <button id='pickDateBtn' type="button" class="mui-btn">选择日期</button>
    </div>
    <div style="padding:10px;" id="shijian">
        <button id='pickTimeBtn' type="button" class="mui-btn">选择时间</button>
    </div>
</div>
		    <ul class="mui-table-view mui-grid-view">
		    <li class="mui-table-view-cell mui-media mui-col-xs-12">
		        <a href="map.html">
		            <div class="mui-media-body">百度地图定位</div>
		        </a>
		    </li>
			</ul>
			<div class="mui-content-padded">
				<p>
					<a href="#picture" class="mui-btn mui-btn-primary mui-btn-block mui-btn-outlined" style="padding: 5px 20px;">用餐时间</a>
				</p>
			</div>
		</div>-->
		
		
			
		<ul class="mui-table-view mui-grid-view">
			<?php
				foreach($result as $k=>$v){
			?>
		    <li class="mui-table-view-cell mui-media mui-col-xs-6">
		        <a href="http://192.168.43.154/chef/chefinfo.php?id=<?php echo $v['cid']?>">
		            <img src=<?php echo $v['pic']?>>
		            <div class="mui-media-body"><?php echo $v['cname']?></div>
		            <div class="mui-media-body"><?php echo $v['description']?></div>
		        </a>
		    </li>
		    <?php
		    }}
		    ?>
		</ul>
		<div id="foot"></div>
		<nav class="mui-bar mui-bar-tab">
	        <a class="mui-tab-item " href="http://192.168.43.154/chef/main.php" id="index" >
	            <span class="mui-icon mui-icon-home"></span>
	            <span class="mui-tab-label">首页</span>
	        </a>
	        <a class="mui-tab-item mui-active" href="http://192.168.43.154/chef/selectchef.php" id="index">
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
	<script type="text/javascript">
		mui.init()
		mui('.mui-bar-tab').on('tap','a',function(){document.location.href=this.href;});
		document.getElementById("pickDateBtn").addEventListener('tap', function() {
    var dDate = new Date();
    //设置当前日期（不设置默认当前日期）
    dDate.setFullYear(2016, 7, 16);
    var minDate = new Date();
    //最小时间
    minDate.setFullYear(2010, 0, 1);
    var maxDate = new Date();
    //最大时间
    maxDate.setFullYear(2016, 11, 31);
    plus.nativeUI.pickDate(function(e) {
        var d = e.date;
        //mui.toast('您选择的日期是:' + d.getFullYear() + "-" + (d.getMonth() + 1) + "-" + d.getDate());
        var riqi = d.getFullYear() + "-" + (d.getMonth() + 1) + "-" + d.getDate();
        document.getElementById("riqi").innerHTML = riqi;
        $_SESSION['riqi'] = riqi;
        
    }, function(e) {
        mui.toast("您没有选择日期");
    }, {
        title: '请选择日期',
        date: dDate,
        minDate: minDate,
        maxDate: maxDate
    });
});
document.getElementById("pickTimeBtn").addEventListener('tap', function() {
    var dTime = new Date();
    //设置默认时间
    dTime.setHours(6, 0);
    plus.nativeUI.pickTime(function(e) {
        var d = e.date;
        var shijian =  d.getHours() + ":" + d.getMinutes();
        //mui.toast("您选择的时间是：" + d.getHours() + ":" + d.getMinutes());
        document.getElementById("shijian").innerHTML = shijian;
    }, function(e) {
        mui.toast("您没有选择时间");
    }, {
        title: "请选择时间",
        is24Hour: true,
        time: dTime
    });
});
	</script>
</html>