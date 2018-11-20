<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="renderer" content="webkit">

<title>格美后台管理系统</title>
<link href="/gemei_wj/Public/css/module.css" rel="stylesheet"/>

<link href="/gemei_wj/Public/css/bootstrap.min.css?v=3.4.0" rel="stylesheet">
<link href="/gemei_wj/Public/font-awesome/css/font-awesome.css?v=4.3.0" rel="stylesheet">


<link href="/gemei_wj/Public/css/animate.css" rel="stylesheet">
<link href="/gemei_wj/Public/css/admin-style.css?v=2.2.0" rel="stylesheet">

<!-- Mainly scripts -->
<script type="text/javascript" src="/gemei_wj/Public/js/jquery-3.2.1.min.js"></script>
<!-- <script src="/gemei_wj/Public/js/jquery-2.1.1.min.js"></script>
 -->
 <script src="/gemei_wj/Public/js/bootstrap.min.js?v=3.4.0"></script>



<!--Layer-->
<script src="/gemei_wj/Public/static/layer/layer.js"></script>

<script type="text/javascript" src="/gemei_wj/Public/js/admin.js"></script>

<script src="/gemei_wj/Public/js/jquery.metisMenu.js"></script>
<!-- 编辑器 -->
<link href="/gemei_wj/Public/ueditorPHP/themes/default/css/umeditor.css" type="text/css" rel="stylesheet">
<script type="text/javascript" src="/gemei_wj/Public/ueditorPHP/third-party/jquery.min.js"></script>
<script type="text/javascript" charset="utf-8" src="/gemei_wj/Public/ueditorPHP/umeditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/gemei_wj/Public/ueditorPHP/umeditor.min.js"></script>
<script type="text/javascript" src="/gemei_wj/Public/ueditorPHP/lang/zh-cn/zh-cn.js"></script>
<style>
	.navsecondactive{
		color:red;
		background:skyblue !important;
	}
	.edui-body-container{
		height:200px !important;
	}
	.form-group{
		border: 1px !important;
		border-color:black !important;
	} 
	.form-group.border{
		border:1px,solid,black !important;
		width:100px;
	}
	table{
		width:100%;
	}
	.page div{
		display:inline-block !important;
	}
	.page {
		text-align:center;
	}
	#page-wrapper{
		margin-left:0;
	}
</style>
<script type="text/javascript">

</script>
<script>
</script>

</head>







</head>
<style>
	th,td{margin-right:10% !important;}
</style>

<body>
<div id="wrapper">
	
    <div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="wrapper wrapper-content">
            <div class="row">
                <div class="col-lg-14">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>产品</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="input-button">
                                        <a href="<?php echo U('ElementaryLevel/edit');?>">
                                            <button class="btn btn-primary add" type="button"><i class="fa fa-plus"></i>&nbsp;新增</button>
                                        </a>
                                        <button class="btn btn-warning delete-all" type="button" url="<?php echo U('delAll');?>"><i class="fa fa-minus "></i>&nbsp;删除</button>
                                    </div>
                                </div>
                                <!--搜索开始-->
                                <form method="post" action="/gemei_wj/index.php/Admin/ElementaryLevel/lists.html" >
                                    <div class="col-sm-3">
                                        <div class="input-group">
                                            <input type="text" placeholder="请输入产品名称" class="input-sm form-control" name="keyword" value=<?php echo ($keyword); ?>>
                                            <span class="input-group-btn">
                                                <button type="submit" class="btn btn-sm btn-primary"> 搜索</button>
                                            </span>
                                        </div>
                                    </div>
                                </form>
                                <!--搜索结束-->
                            </div>
                            <!--表格开始    -->
                            <form action="/gemei_wj/index.php/Admin/ElementaryLevel/lists.html" method="post" name="updateSort" id="updateSort" >
                                <input type="hidden" name="page_num" value="<?php echo ($_GET['p']); ?>"/>
                                <div class="table-responsive">
                                    <table class="table  table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th style="width: 35px;">
                                                <input type="checkbox" id="checkAll" class="check-all">
                                                <label for="checkAll"></label>
                                            </th>
                                            <th>ID</th>
                                            <th>名称</th>
                                            <th>所属小分类</th>
                                            <th style="width: 100px">操作</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php if(is_array($datalists)): foreach($datalists as $key=>$vo): ?><tr>
                                                <td>
                                                    <input class="ids regular-checkbox" type="checkbox" value="<?php echo ($vo["id"]); ?>" name="ids[]" id="check_<?php echo ($vo["entity_id"]); ?>">
                                                    <label for="check_<?php echo ($vo["entity_id"]); ?>"></label>
                                                </td>
                                                <td> <?php echo ($vo["id"]); ?></td>
                                                <td> <?php echo ($vo["xinhao_chinese"]); ?></td>
                                                <td> <?php echo ($vo["middle_name_chinese"]); ?> </td>
                                                <td>
                                                    <a href="<?php echo U('edit',array('id'=>$vo['id']));?>">编辑</a>
                                                    <a class="confirm" href="<?php echo U('delete',array('id'=>$vo['id']));?>">删除</a>
                                                </td>
                                            </tr><?php endforeach; endif; ?>
                                        </tbody>
                                    </table>
                                    <!--分页开始-->
                                    <div style="padding-top:15px;" >
                                        <div class="page" style="text-aline:center" ><?php echo ($page); ?></div>
                                    </div>
                                    <!--分页结束-->
                                </div>
                            </form>
                            <!--表格结束-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--尾部-->
        
    </div>

</div>
</body>
</html>