<?php
    header("Content-Type:text/html;charset=utf-8");
    error_reporting( E_ERROR | E_WARNING );
    date_default_timezone_set("Asia/chongqing");
    include "Uploader.class.php";
    //上传配置
    $config = array(
        "savePath" => "upload/" ,             //存储文件夹
        "maxSize" => 1000 ,                   //允许的文件最大尺寸，单位KB
        "allowFiles" => array( ".gif" , ".png" , ".jpg" , ".jpeg" , ".bmp" )  //允许的文件格式
    );
    //上传文件目录
    $Path = "upload/";

    //背景保存在临时目录中
    $config[ "savePath" ] = $Path;
    $up = new Uploader( "upfile" , $config );
    $type = $_REQUEST['type'];
    $callback=$_GET['callback'];
    $info = $up->getFileInfo();

    /**
     * 返回数据
     */
    if($callback) {
        echo '<script>'.$callback.'('.json_encode($info).')</script>';
    } else {
        echo json_encode($info);
    }
    file_put_contents('sss.txt', 'commmm');
    // 判断有没有上传过图片，有的话初始化，没有初始化为空数组
    if(isset($_COOKIE['ty_imgs'])){
        $imgs = json_decode($_COOKIE['ty_imgs'],true);
    }else{
        $imgs = array();
    }
    // 添加新上传的图片
    $imgs[] = $info['name'];
    // 保存到cookie中
    setcookie('ty_imgs',json_encode($imgs),0,'/');
