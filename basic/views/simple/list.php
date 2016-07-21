<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
?>
<!DOCTYPE HTML>
<html>
<head>
<title>微信公众号管理</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Modern Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
 <!-- Bootstrap Core CSS -->
<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- jQuery -->
<script src="js/jquery.min.js"></script>
<!----webfonts--->
<link href='http://fonts.useso.com/css?family=Roboto:400,200,300,300,700,900' rel='stylesheet' type='text/css'>
<!---//webfonts--->  
<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
</head>
<body>
<div id="wrapper">
     <!-- Navigation -->
    <?php include("public/main.php");?>
     <!-- Navigation -->

        <div id="page-wrapper">
        <div class="graphs">
	     <div class="xs">
  	       <h3>Show list</h3>
  	         <div class="col-md-4 email-list1">

         <div class="content-box  mrg15B">

        </div>
        </div>
        <!-- <div class="col-md-8 inbox_right"> -->
        	 <div class="mailbox-content">

                        <table class="table">
                            <tbody>
							<tr>
							  <td>ID</td>
							  <td>app名称</td>
							  <td>对接路径</td>
							  <td>token</td>
							  <td>操作</td>
							</tr>
                            <?php foreach ($list as $v): ?>
                            <tr class="unread checked">
                              
                                <td class="hidden-xs">
                                    <?= $v['aid'] ?>
                                </td>
                                <td class="hidden-xs">
                                    <?= $v['appname'] ?>
                                </td>
                                <td class="hidden-xs">
                                    <?= $v['appurl'] ?>
                                </td>
                                <td class="hidden-xs">
                                    <?= $v['apptoken'] ?>
                                </td>
                                <td>                         
                                    <a href="index.php?r=simple/update&id=<?= $v['aid'] ?>" class="btn btn-warning btn-warng1" class="glyphicon glyphicon-envelope tag_02">修改</a>
									<a href="index.php?r=simple/delete&id=<?= $v['aid'] ?>" class="btn btn-success btn-warng1" class="glyphicon glyphicon-tags tag_01">删除</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
         <!-- </div> -->
         <div class="clearfix"> </div>
   </div>
    <!-- foot -->
            <?php include("public/foot.php");?>
    <!-- foot -->
   </div>
      </div>
      <!-- /#page-wrapper -->
   </div>
    <!-- /#wrapper -->
<!-- Nav CSS -->
<link href="css/custom.css" rel="stylesheet">
<!-- Metis Menu Plugin JavaScript -->
<script src="js/metisMenu.min.js"></script>
<script src="js/custom.js"></script>
</body>
</html>
