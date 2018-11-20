<?php
namespace Admin\Controller;
use Think\Controller;
class ContactController extends BaseController {
	public function index(){
        $datalists=M('contact')->where(['status'=>2])->select();//招聘岗位
        $data=M('contact')->where(['status'=>1])->find();//薪资福利 联系方式 只有一个
        $this->assign('data',$data);
        $this->assign('datalists',$datalists);
		$this->display();
	}
    public function edit(){
        if(IS_POST){
            $routin=C('TMPL_PARSE_STRING.PIC_URL');
            $id=I('id','intval');
            $data=I('post.');
            $data['uploads']=I('uploads','intval');
            if($data['uploads']==1){
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
                   $data['ewm'] = $routin.$info['ewm']['savepath'].$info['ewm']['savename'];
                }
                else{
                    $this->error($uploads->getError());
                }                  
            }
                $res = M('contact')->where(['id'=>$id])->save($data);
                if($res){
                $this->success('操作成功',U('index'));
                }
                else{
                    $this->error('添加失败'.'请确保有修改信息');
                }                   
        }
        else{
            $id = I('id');
            $data=M('contact')->where(['id'=>$id])->find();
            $this->assign('id',$id);
            $this->assign('data',$data);
            $this->display();   
        }

    }
}
