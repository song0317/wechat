<!DOCTYPE HTML>
<html>
<head>
<title>微信公众号管理</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
    <!-- Navigation -->
        <nav class="top1 navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php?r=simple/show">WeChat</a>
            </div>
            <!-- /.navbar-header -->
            <ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
                    <!-- admin登录 -->
                    <a href="#" ><i><?php echo $name; ?></i><span class="badge"></span></a>
                </li>
			    <li class="dropdown">
	        		<a href="#" class="dropdown-toggle avatar" data-toggle="dropdown"><img src="images/arrow-right.png"><span class="badge"></span></a>
	        		<ul class="dropdown-menu">
						<li class="m_2"><a href="index.php?r=site/logout"><i class="fa fa-lock"></i>退出</a></li>
	        		</ul>
	      		</li>
			</ul>
			<form class="navbar-form navbar-right">
              <input type="text" class="form-control" value="Search..." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search...';}">
            </form>
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="index.html"><i class="fa fa-dashboard fa-fw nav_icon"></i>全局参数设定</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-laptop nav_icon"></i>公众号管理<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="index.php?r=simple/add">添加公众号</a>
                                    <a href="index.php?r=simple/list">公众号信息</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-envelope nav_icon"></i>自定义菜单<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="inbox.html">基本菜单</a>
                                </li>
                            </ul>
<!--                             /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-envelope nav_icon"></i>自动回复<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="inbox.html">文字回复</a>
                                </li>
                                <li>
                                    <a href="inbox.html">添加回复规则</a>
                                </li>
                                <li>
                                    <a href="compose.html">机器人回复规则</a>
                                </li>
                            </ul>
<!--                             /.nav-second-level -->
                        </li>
<!--                        <li>-->
<!--                            <a href="widgets.html"><i class="fa fa-flask nav_icon"></i>Widgets</a>-->
<!--                        </li>-->
                         <li>
                            <a href="#"><i class="fa fa-check-square-o nav_icon"></i>统计图表<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
<!--                                <li>-->
<!--                                    <a href="forms.html">Basic Forms</a>-->
<!--                                </li>-->
<!--                                <li>-->
<!--                                    <a href="validation.html">Validation</a>-->
<!--                                </li>-->
                            </ul>
<!--                            <!-- /.nav-second-level -->
                        </li>
<!--                        <li>-->
<!--                            <a href="#"><i class="fa fa-table nav_icon"></i>Tables<span class="fa arrow"></span></a>-->
<!--                            <ul class="nav nav-second-level">-->
<!--                                <li>-->
<!--                                    <a href="basic_tables.html">Basic Tables</a>-->
<!--                                </li>-->
<!--                            </ul>-->
<!--                            <!-- /.nav-second-level -->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <a href="#"><i class="fa fa-sitemap fa-fw nav_icon"></i>Css<span class="fa arrow"></span></a>-->
<!--                            <ul class="nav nav-second-level">-->
<!--                                <li>-->
<!--                                    <a href="media.html">Media</a>-->
<!--                                </li>-->
<!--                                <li>-->
<!--                                    <a href="login.html">Login</a>-->
<!--                                </li>-->
<!--                            </ul>-->
<!--                            <!-- /.nav-second-level -->
<!--                        </li>-->
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
</body>
</html>
