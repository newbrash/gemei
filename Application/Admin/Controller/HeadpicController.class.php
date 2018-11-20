<?php
namespace Admin\Controller;
use Think\Controller;
class HeadpicController extends BaseController {
	public function index(){
        $datalists=M('headpic')->select();
        $this->assign('datalists',$datalists);
        $this->display();
    }
    public function edit(){
        if(IS_POST){
            $routin=C('TMPL_PARSE_STRING.PIC_URL');            
            $id=I('id',0,'int');
            $uploads=I('uploads');
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
                    if($info['picurl_chinese']['savepath']){
                        $data['picurl_chinese'] = $routin.$info['picurl_chinese']['savepath'].$info['picurl_chinese']['savename'];
                    }
                    if($info['picurl_english']['savepath']){
                       $data['picurl_english'] = $routin.$info['picurl_english']['savepath'].$info['picurl_english']['savename'];
                        // $img->open($data['culture_pic_english']);
                        // $pic=$img->thumb(400,400)->save($data['culture_pic_english']);
                        // dump($pic);
                   }
               }
               else{
                $this->error($uploads->getError());
                }
                $res = M('headpic')->where(['id'=>$id])->save($data);
                if($res){
                    $this->success('保存成功');
                    // $data=M('headpic')->where(['id'=>$id])->find();
                    //     $img->open('./1.png');
                    //     $pic=$img->thumb(400,400)->save('./2.png');
                    //     dump($pic); 
                           

                }
                else{
                    $this->error('添加失败'.'请确保有修改信息');
                } 
            }
            else{
                $this->error("您没有改变图片");
            }

        }
        else{
            $id = I('id');
            $data=M('headpic')->where(['id'=>$id])->find();
            $this->assign('id',$id);
            $this->assign('data',$data);
            $this->display(); 
        }

    }
}
