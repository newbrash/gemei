<?php
namespace Admin\Controller;
use Think\Controller;
// use Admin\Controller;
// require_once('ImageTool1111.class.php');
class LunboController extends BaseController {
     
    public function index(){
    	$datalists = M('lunbo')->select();
    	$this->assign('datalists',$datalists);
    	$this->display();
    }
    public function add(){
        $routin=C('TMPL_PARSE_STRING.PIC_URL');
    	if(IS_POST){
            //处理缩略图 
    		$data['is_display']=I('is_display','intval');
            $config = array(
                'maxSize'    =>    3145728,
                'rootPath'   =>    './Uploads/',
                'savePath'   =>    '',
                'saveName'   =>    array('uniqid',''),
                'exts'       =>    array('jpg', 'gif', 'png', 'jpeg'),
                'autoSub'    =>    true,
                'subName'    =>    array('date','Ymd'),
            );
            $upload = new \Think\Upload($config);// 实例化上传类  
            $info = $upload->upload();
            if($info){
               $data['picurl_chinese'] = $routin.$info['picurl_chinese']['savepath'].$info['picurl_chinese']['savename'];
               $data['picurl_english'] = $routin.$info['picurl_english']['savepath'].$info['picurl_english']['savename'];
            // $imageTool = new \Admin\Controller\ImageTool1111($data['picurl_chinese'], '/out/');//图片路径、输出文件夹  
            // $imageTool->compressImage(350, 250, true);//压缩宽度、压缩高度、是否保存
            // $imageTool->showImage();
            // $imageTool->addTextmark('一拳超人', 50, 'res/micro.ttf', true);//内容、尺寸、字体、是否保存
            // $imageTool->showImage();
            // $imageTool->addTextmark('快捷输出', 50, 'res/micro.ttf')->showImage(); 
             }
            else{
                $this->error($upload->getError());
            } 
            $res = M('lunbo')->add($data);
            if($res){
            	$this->success('操作成功',U('index'));
            }
            else{
               $this->error('添加失败'.'请确保有修改信息');
            }
    	}
        else{
        $this->display();
    }
    }

        public function edit(){
        $routin=C('TMPL_PARSE_STRING.PIC_URL');
        if(IS_POST){
            $id=I('id',0,'int');
            $uploads=I('uploads');
            $data = I();
            if($uploads){
                $config = array(
                    'maxSize'    =>    3145728,
                    'rootPath'   =>    './Uploads/',
                    'savePath'   =>    '',
                    'saveName'   =>    array('uniqid',''),
                    'exts'       =>    array('jpg', 'gif', 'png', 'jpeg'),
                    'autoSub'    =>    true,
                    'subName'    =>    array('date','Ymd'),
                );
                $upload = new \Think\Upload($config);// 实例化上传类  
                $info = $upload->upload();
                if($info){
                    if( $info['picurl_chinese']['savepath']){
                        $data['picurl_chinese'] = $routin.$info['picurl_chinese']['savepath'].$info['picurl_chinese']['savename'];
                    }
                    if($info['picurl_english']['savepath']){
                       $data['picurl_english'] = $routin.$info['picurl_english']['savepath'].$info['picurl_english']['savename'];
                    }
                }
                else{
                    $this->error($upload->getError());
                }
            }
                $res = M('lunbo')->where(['id'=>$id])->save($data);
                if($res){
                    $this->success('操作成功',U('index'));
                }
                else{
                   $this->error('编辑失败');
                }              

        }
        else{
            $id = I('id');
            $data=M('lunbo')->where(['id'=>$id])->find();
            $this->assign('id',$id);
            $this->assign('data',$data);
            $this->display(); 
        }
    }
    /**
     * 单选删除
     */
    public function delete(){
        $map['id']  = I('id',0,'int');
	    $res = M('lunbo')->where($map)->delete();
        if($res){
            $message = '删除成功';
        }else{
            $message = '删除失败';
        }
        $this->ajaxReturn($message);
    }

    /**
     * 全选删除
     */
    public function delAll(){
        $ids = I('ids',0);
        $map['id']  = array('in',$ids);
        if(M('lunbo')->where($map)->delete()){
            $message = '删除成功';
        }else {
            $message = '删除失败';
        }
        $this->ajaxReturn($message);
    }
}
