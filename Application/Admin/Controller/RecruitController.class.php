<?php
namespace Admin\Controller;
use Think\Controller;

class RecruitController extends BaseController{
	public function index(){
		$datalists=M("recruit")->select();
		$datalists[0]['apply_chinese']=htmlspecialchars_decode($datalists[0]['apply_chinese']);
		$datalists[0]['salaris_chinese']=htmlspecialchars_decode($datalists[0]['salaris_chinese']);
		$this->assign('datalists',$datalists);
		$this->display();
	}
	public function edit(){
		$id=I('id');//有id为编辑 id==1为编辑薪资福利 2为岗位
		dump($id);
		if($id){
			if(IS_POST){
				$id=I('id');
				$data=I('post.');
				$res = M("recruit")->where(['id'=>$id])->save($data);//id为1编辑薪资与福利联系方式
				if($res){
					$this->success('修改成功',U('index'));
				}
				else{
					$this->error('修改失败'.'请确是否有修改信息');
				}
			}
			else{
				$data=M("recruit")->where(['id'=>$id])->find();
				if($id==1){
					$data['salaris_chinese'] = htmlspecialchars_decode($data['salaris_chinese']);
					$data['salaris_english'] = htmlspecialchars_decode($data['salaris_english']);
					$data['apply_chinese'] = htmlspecialchars_decode($data['apply_chinese']);
					$data['apply_english'] = htmlspecialchars_decode($data['apply_english']);					
				}
				else{
					$data['description_chinese'] = htmlspecialchars_decode($data['description_chinese']);
					$data['description_english'] = htmlspecialchars_decode($data['description_english']);
					$data['requirement_chinese'] = htmlspecialchars_decode($data['requirement_chinese']);
					$data['requirement_english'] = htmlspecialchars_decode($data['requirement_english']);
				}
				$this->assign('data',$data);
				$this->display();		
			}			
		}
		//添加岗位信息
		else{
			if(IS_POST){
				$data=I('post.');
				$res= M('recruit')->add($data);
				if($res){
					$this->success('添加成功',U('index'));
				}
				else{
					$this->error('添加失败'.'请确保有修改信息');
				}
			}
			else{
				$this->display();
			}
		}

	}
}
