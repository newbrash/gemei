<?php
namespace Admin\Controller;
use Think\Controller;
class TechnologyController extends BaseController{
	// private static $routin=C('TMPL_PARSE_STRING.__PUBLIC__');
	public function index(){
		$data = M('technology')->find();
		$this->assign('data',$data);
		$this->display();
	}
	public function edit(){
		$routin=C('TMPL_PARSE_STRING.PIC_URL');
		if(IS_POST){
			$id=I('id','intval');
			$data=I('post.');
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
	            	if($info['leftpic_chinese']['savepath']){
	            		$data['leftpic_chinese'] = $routin.$info['leftpic_chinese']['savepath'].$info['leftpic_chinese']['savename'];
	            	}
	            	if($info['leftpic_english']['savepath']){
	            		$data['leftpic_english'] = $routin.$info['leftpic_english']['savepath'].$info['leftpic_english']['savename'];
	            	}
	            	if($info['rightpic_chinese']['savepath']){
	            		$data['rightpic_chinese'] = $routin.$info['rightpic_chinese']['savepath'].$info['rightpic_chinese']['savename'];
	            	}
	            	if($info['rightpic_english']['savepath']){
	            		$data['rightpic_english'] = $routin.$info['rightpic_english']['savepath'].$info['rightpic_english']['savename'];
	            	}
	            } 
	            else{
                $this->error($uploads->getError());
            	}
	        }//(uploads)
             	        
		        $res = M('technology')->where(['id'=>$id])->save($data);
	            if($res){
	            $this->success('操作成功',U('index'));
	            }
	            else{
	            	$this->error('添加失败');
	            }       
	        }//(IS_POST)
	        else{
		        $data = M('technology')->find();
		        $data['intro_chinese'] = htmlspecialchars_decode(html_entity_decode($data['intro_chinese']));
		        $data['intro_english'] = htmlspecialchars_decode($data['intro_english']);	        
		        $data['content1_chinese'] = htmlspecialchars_decode(html_entity_decode($data['content1_chinese']));
		        $data['content1_english'] = htmlspecialchars_decode($data['content1_english']);
		        $data['content2_chinese'] = htmlspecialchars_decode($data['content2_chinese']);
		        $data['content2_english'] = htmlspecialchars_decode($data['content2_english']);
		        $data['content3_chinese'] = htmlspecialchars_decode($data['content3_chinese']);
		        $data['content3_english'] = htmlspecialchars_decode($data['content3_english']);
		        $data['content4_chinese'] = htmlspecialchars_decode($data['content4_chinese']);
		        $data['content4_english'] = htmlspecialchars_decode($data['content4_english']);
		        $this->assign('data',$data);		
		        $this->display();			
	        }

	    }
}
