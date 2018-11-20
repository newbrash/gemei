<?php
namespace Admin\Controller;
use Think\Controller;
class AboutusController extends BaseController {

	public function index(){
        $datalists=M('aboutus')->select();
        $datalists[0]['intro_chinese']=htmlspecialchars_decode(html_entity_decode($datalists[0]['intro_chinese']));
        $datalists[0]['intro_english']=htmlspecialchars_decode(html_entity_decode($datalists[0]['intro_english'])); 
        $this->assign('datalists',$datalists);
		$this->display();
	}

    public function edit(){
        if(IS_POST){
			$img=new \Think\Image();        	
            $id=I('id','intval');
            $data=I();
            $data['uploads']=I('uploads','intval');
            if($data['uploads']==1){    //图片被修改了执行上传函数，否则不执行
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
	            	$routin=C('TMPL_PARSE_STRING.PIC_URL');
	            	if($info['culture_pic_chinese']['savepath']){
	            		$data['culture_pic_chinese'] = $routin.$info['culture_pic_chinese']['savepath'].$info['culture_pic_chinese']['savename'];
	            	}
	            	if($info['culture_pic_english']['savepath']){
	            		$data['culture_pic_english'] = $routin.$info['culture_pic_english']['savepath'].$info['culture_pic_english']['savename'];
	            	}
	            	if($info['principles_pic_chinese']['savepath']){
	            		$data['principles_pic_chinese'] = $routin.$info['principles_pic_chinese']['savepath'].$info['principles_pic_chinese']['savename'];
	            	}
	            	if($info['principles_pic_english']['savepath']){
	            		$data['principles_pic_english'] = $routin.$info['principles_pic_english']['savepath'].$info['principles_pic_english']['savename'];
	            	}
	            	if($info['purpose_pic_chinese']['savepath']){
	            		$data['purpose_pic_chinese'] = $routin.$info['purpose_pic_chinese']['savepath'].$info['purpose_pic_chinese']['savename'];
	            	}
	            	if($info['purpose_pic_english']['savepath']){
	            		$data['purpose_pic_english'] = $routin.$info['purpose_pic_english']['savepath'].$info['purpose_pic_english']['savename'];
	            	}
	            	if($info['ideas_pic_chinese']['savepath']){
	            		$data['ideas_pic_chinese'] = $routin.$info['ideas_pic_chinese']['savepath'].$info['ideas_pic_chinese']['savename'];
	            	}
	            	if($info['ideas_pic_english']['savepath']){
	            		$data['ideas_pic_english'] = $routin.$info['ideas_pic_english']['savepath'].$info['ideas_pic_english']['savename'];
	            	}
	            	if($info['spirits_pic_chinese']['savepath']){
	            		$data['spirits_pic_chinese'] = $routin.$info['spirits_pic_chinese']['savepath'].$info['spirits_pic_chinese']['savename'];
	            	}
	            	if($info['spirits_pic_english']['savepath']){
	            		$data['spirits_pic_english'] = $routin.$info['spirits_pic_english']['savepath'].$info['spirits_pic_english']['savename'];                                                            
	            	}
	            }
	            else{
	            	$this->error($uploads->getError());
	            } 
	        }//(uploads)
		        $res = M('aboutus')->where(['id'=>$id])->save($data);
	            if($res){
	            $this->success('操作成功',U('index'));
	            }
	            else{
	                $this->error('添加失败'.'请确保有修改信息');
	            }       
	        }//(IS_POST)
	        else{
	        	$id = I('id');
		        $this->assign('id',$id);
		        $data = M('aboutus')->find();
		        $data['intro_english'] = htmlspecialchars_decode($data['intro_english']);
		        $data['intro_chinese'] = htmlspecialchars_decode($data['intro_chinese']);
		        $this->assign('data',$data);
		        $this->display();	
	        }

    }
}
