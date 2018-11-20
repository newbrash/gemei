<?php
namespace Admin\Controller;
use Think\Controller;

class HomeeController extends Controller {
    public function upload() {
        $this->display();
        $upload = new \Think\UploadFile();// 实例化上传类
        $upload->maxSize = 3000000 ;// 设置附件上传大小  C('UPLOAD_SIZE');
        $upload->savePath = './Uploads/' . 'thumb/'; // 设置附件上传目录
        $upload->allowExts = array('jpg', 'gif', 'png', 'jpeg'); // 设置附件上传类型
        $upload->saveRule = 'uniqid';
        $upload->uploadReplace = true; //是否存在同名文件是否覆盖
        

        $upload->thumb = true; //是否对上传文件进行缩略图处理
        $upload->thumbMaxWidth = '300,600'; //缩略图处理宽度
        $upload->thumbMaxHeight = '200,400'; //缩略图处理高度
        $upload->thumbPrefix = 'm_,s_';  //生产2张缩略图
        $upload->thumbPath = './Uploads/' . 'thumb/' . date('Ymd', time()) . '/'; //缩略图保存路径

        $upload->thumbRemoveOrigin = true; //上传图片后删除原图片
        $upload->autoSub = true; //是否使用子目录保存图片
        $upload->subType = 'date'; //子目录保存规则
        $upload->dateFormat = 'Ymd'; //子目录保存规则为date时时间格式
        
        if (!$upload->upload()) {// 上传错误提示错误信息
            $this->error($upload->getError());
        } else {

　　　　 // 上传成功 获取上传文件信息
            $info=$upload->getUploadFile();

            foreach($info1 as $file ) {

　　　　　  // 保存当前数据对象
                $model = M ( 'web_img' );
                $picname = $file['savename'];
                $picname = explode('/', $picname);
                $url1 = $picname[0] . '/' . 'm_' . $picname[1];
                $url2 = $picname[0] . '/' . 's_' . $picname[1];
                $temp["face"] = $file['savepath'].$url2;    //大缩略图
                $temp["thumb"] = $file['savepath'].$url1;   //小缩略图
                $temp["Addtime"] = date("Y/m/d H:i:s");
                $save=$model->add ( $temp );
            }
            if($save){
                $this->success('上传成功！');
            }
        }

    }
}