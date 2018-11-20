<?php
namespace Admin\Controller;
use Think\Controller;
class NewsController extends BaseController{
	// private static $routin=C('TMPL_PARSE_STRING.__PUBLIC__');
	public function index(){
        $keyword = I('keyword','','trim');      //过滤开头结尾空格
        if($keyword){
            $map['title_chinese'] = array('like',"%$keyword%");//模糊查询
            $this->assign('keyword',$keyword);  //输出数据
        }
        $news = M('news');
        $count  = $news->where($map)->count();
        $row    = 10;
        $Page   = new \Think\Page($count,$row);
        $show   = $Page->show();
		$this->assign('page',$show);

		$status = I('status'); //0为公司新闻 1为行业动态
		$map['status']=$status;
        $news = M('news');
        $count  = $news->where($map)->count();
        $row    = 10;
        $Page   = new \Think\Page($count,$row);
        $show   = $Page->show();
		$this->assign('page',$show);		
	    $datalists = M('news')->where($map)->limit($Page->firstRow.','.$Page->listRows)->order('addtime desc')->select();
	    $this->assign('status',$status);	
	    $this->assign('datalists',$datalists);	
		$this->display();
	}
	public function add(){
		$routin=C('TMPL_PARSE_STRING.PIC_URL');
		$status=I('status');
		if(IS_POST){
			$data=I('post.');
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
	            	if($info['pic_chinese']['savepath']){
	            		$data['pic_chinese'] = $routin.$info['pic_chinese']['savepath'].$info['pic_chinese']['savename'];
	            	}
	            	if($info['pic_english']['savepath']){
	            		$data['pic_english'] = $routin.$info['pic_english']['savepath'].$info['pic_english']['savename'];
	            	}
	            }
                else{
                    $this->error($uploads->getError());
                } 	            						
	        }
	        $data['addtime']=date('Y-m-d H:m:s');
	        $res=M('news')->add($data);
	        if($res){
	        	$this->success('添加成功',U('index',array('status'=>$status)));
	        }
	        else{
	        	$this->error('添加失败');
	        }			
		}
		else{
			$this->assign('status',$status);
			$this->display();
		}
	}
	public function edit(){
		$routin=C('TMPL_PARSE_STRING.PIC_URL');
		$id=I('id');   //id区分新增或者编辑
		$status=I('status'); //status 区分分类
		if(IS_POST){
		$data=I('post.');
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
	            	if($info['pic_chinese']['savepath']){
	            		$data['pic_chinese'] = $routin.$info['pic_chinese']['savepath'].$info['pic_chinese']['savename'];
	            	}
	            	if($info['pic_english']['savepath']){
	            		$data['pic_english'] = $routin.$info['pic_english']['savepath'].$info['pic_english']['savename'];
	            	}
	            }
	            else{
	            	$this->error($upload->getError());
	            }						
		    }
	        $data['addtime']=date('Y-m-d H:m:s');
	        // $data['addtime']=date($data['addtime']);
	        $res=M('news')->where(['id'=>$id])->save($data);
	        if($res){
	        	$this->success('编辑成功',U('index',array('status'=>$status)));
	        }
	        else{
	        	$this->error('编辑失败'.'请确保有修改信息');
	        }			
		}//IS_POST
		else{
			$data=M('news')->where(['id'=>$id])->find();
			$data['content_chinese']=htmlspecialchars_decode($data['content_chinese']);
			$data['content_english']=htmlspecialchars_decode($data['content_english']);
			$data['intro_chinese']=htmlspecialchars_decode($data['intro_chinese']);
			$data['intro_english']=htmlspecialchars_decode($data['intro_english']);			
			$this->assign('status',$status);
			$this->assign('data',$data);
			$this->display();
		}
	}



	public function delete(){
        $map['id']  = I('id',0,'int');
        $res = M('news')->where($map)->delete();
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
        $ids        = I('ids',0);
        //判断该高级分类下是否有中级分类
        $map['id']  = array('in',$ids);
        if(M('news')->where($map)->delete()){
            $message   = '删除成功';
        }else {
            $message   = '删除失败';
        }
        $this->ajaxReturn($message);
    }
}