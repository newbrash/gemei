<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>格美后台管理系统</title>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />

    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="/gemei_wj/Public/xadmin/css/font.css">
    <link rel="stylesheet" href="/gemei_wj/Public/xadmin/css/xadmin.css">
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script src="/gemei_wj/Public/xadmin/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="/gemei_wj/Public/xadmin/js/xadmin.js"></script>

</head>
<body>
    <!-- 顶部开始 -->
    <div class="container">
        <div class="logo"><a href="<?php echo U('Index/index');?>">格美后台首页</a></div>
        <div class="left_open">
            <i title="展开左侧栏" class="iconfont">&#xe699;</i>
        </div>
        <ul class="layui-nav right" lay-filter="">
          <li class="layui-nav-item">
            <a href="#">管理员信息</a>
            <dl class="layui-nav-child"> <!-- 二级菜单 -->
              <dd><a href="<?php echo U('Public/logout');?>">退出</a></dd>
              <dd><a href="<?php echo U('Index/changePassword');?>" target="x-iframe" target="x-admin">修改密码</a></dd>
            </dl>
          </li>
          <li class="layui-nav-item to-index"><a href="<?php echo U('Home/Index/index');?>" target="_new">前台首页</a></li>
        </ul>
        
    </div>
    <!-- 顶部结束 -->
    <!-- 中部开始 -->
     <!-- 左侧菜单开始 -->
    <div class="left-nav">
      <div id="side-nav">
        <ul id="nav">
            <li>
                <a href="javascript:;">
                    <i class="iconfont">&#xe6b8;</i>
                    <cite>产品分类</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="<?php echo U('HighLevel/lists');?>">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>大分类</cite>
                            
                        </a>
                    </li>
                    <li>
                       <a _href="<?php echo U('MiddleLevel/lists');?>">
                            <i class="iconfont ">&#xe6a7;</i>
                            <cite>小分类</cite>
                            
                        </a>
                    </li>
                    <li>
                       <a _href="<?php echo U('ElementaryLevel/lists');?>">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>产品</cite>
                        </a>
                    </li>
                </ul>
            </li>
                    <li>
                        <a href="javascript:;">
                            <i class="iconfont">&#xe70b;</i>
                            <cite>新闻中心</cite>
                            <i class="iconfont nav_right">&#xe697;</i>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a _href="<?php echo U('News/index',['status'=>0]);?>">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>公司新闻</cite>
                                </a>
                            </li>
                            <li>
                                <a _href="<?php echo U('News/index',['status'=>1]);?>">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>行业动态</cite>
                                </a>
                            </li>
                        </ul>
                    </li>
            <li>
                <a href="javascript:;">
                    <i class="iconfont">&#xe723;</i>
                    <cite>图片管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="<?php echo U('Lunbo/index');?>">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>首页轮播图</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="<?php echo U('Headpic/index');?>">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>其他页面头部</cite>
                        </a>
                    </li >
                </ul>
            </li>
            <li>
                <a _href="<?php echo U('Aboutus/index');?>">
                    <i class="iconfont">&#xe6b8;</i>
                    <cite>关于我们</cite>
                </a>
            </li>
            <li>
                <a _href="<?php echo U('Contact/index');?>">
                <i class="iconfont">&#xe6b8;</i>
                  <cite>联系我们</cite>
              </a>  
            </li>
            <li>
                <a _href="<?php echo U('Recruit/index');?>">
                <i class="iconfont">&#xe6b8;</i>
                  <cite>招贤纳士</cite>
              </a>  
            </li>
             <li>
                <a _href="<?php echo U('Technology/index');?>">
                  <i class="iconfont">&#xe6b8;</i>
                  <cite>技术力量</cite>
              </a>
            </li>  
        </ul>
      </div>
    </div>
    <!-- <div class="x-slide_left"></div> -->
    <!-- 左侧菜单结束 -->
    <!-- 右侧主体开始 -->
    <div class="page-content">
        <div class="layui-tab tab" lay-filter="xbs_tab" lay-allowclose="false">
          <ul class="layui-tab-title">
            <li class="home"></li>
        </ul>
        <div class="layui-tab-content">
            <div class="layui-tab-item layui-show">
                <iframe src="<?php echo U('ElementaryLevel/lists');?>" frameborder="0" scrolling="yes" class="x-iframe" name='x-iframe'></iframe>
            </div>
          </div>
        </div>
    </div>
    <div class="page-content-bg"></div>
    <!-- 右侧主体结束 -->
    <!-- 中部结束 -->
    <!-- 底部开始 -->
    <div class="footer">
        <div class="copyright">格 美 后 台 管 理  系 统</div>  
    </div>
    <!-- 底部结束 -->
    <script>
    //百度统计可去掉
    var _hmt = _hmt || [];
    (function() {
      var hm = document.createElement("script");
      hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
      var s = document.getElementsByTagName("script")[0]; 
      s.parentNode.insertBefore(hm, s);
    })();
    </script>
</body>
</html>