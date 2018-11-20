<?php
namespace Admin\Controller;
use Think\Controller;

class ElementaryLevelController extends BaseController {

    public function lists(){
       $time = time();
        $keyword = I('keyword','','trim');      //过滤开头结尾空格
        if($keyword){
            $map['elementary_name'] = array('like',"%$keyword%");//模糊查询
            $this->assign('keyword',$keyword);  //输出数据
        }
        $elementary_level = M('elementary_level');


        $wherem = ' (';
        $high_info=M('high_level')->field('id')->where('is_display=1')->select();
        foreach($high_info as $key=>$value){
            $wherem.='high_id='.$value['id'].' or ';
        } //允许展示的大分类
        $wherem = trim($wherem,' or ').')'.' AND '.'is_display = 1';
        $middle_info=M('middle_level')->field(['id','middle_name_chinese'])->where($wherem)->select();
        $whered = ' (';
        foreach($middle_info as $key=>$value){
            $whered.='middle_id='.$value['id'].' or ';
        } //允许展示的小分类
        $whered = trim($whered,' or ').')'.' AND xinhao_chinese like "'."%$keyword%".'"';
        $count  = $elementary_level->where($whered)->count();
        $row    = 10;
        $Page   = new \Think\Page($count,$row);
        $show   = $Page->show();         
        $datalists = $elementary_level->where($whered)->order('addtime desc')
        ->limit($Page->firstRow.','.$Page->listRows)
        ->select();
       
        foreach($middle_info as $key1=>$vom){
            foreach($datalists as $key=>$vod){
                if(  $vod['middle_id'] == $vom['id'] ){
                $datalists[$key]['middle_name_chinese']=$vom['middle_name_chinese'];
                }
            }
        }//添加小分类名称
            $this->assign('page',$show);
            $title  = '产品分类管理';
            $this->assign('title',$title);
            $this->assign('datalists',$datalists);
            $this->display();
    }




    /**
     * 编辑 + 新增 if($id)增加 else()编辑
     */
    public function edit(){
        $id= I('id',0,'int');
        // if($id){
            $routin=C('TMPL_PARSE_STRING.PIC_URL');
            if(IS_POST){
                $data = I('post.');
                $data['addtime'] = time();
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
                    $upload = new \Think\Upload($config,'LOCAL');// 实例化上传类
                    $info   =   $upload->upload();
                    if(!$info) {// 上传错误提示错误信息
                        $this->error($upload->getError());
                    }
                    if($info['picurl_chinese']['savepath']){
                        $data['picurl_chinese'] = $routin.$info['picurl_chinese']['savepath'].$info['picurl_chinese']['savename'];
                    }
                    if($info['picurl_english']['savepath']){
                        $data['picurl_english'] = $routin.$info['picurl_english']['savepath'].$info['picurl_english']['savename'];
                    }
                }//uploads
                // else{
                //     $this->error($upload->getError());
                // } 
                if($id){
                    $res  = M('elementary_level')->where(array('id' => $data['id']))->save($data);
                }else{
                    if(!($info['picurl_chinese']['savepath']&&$info['picurl_english']['savepath'])){
                        $this->error("请保证添加了中英文两份图片");
                    }else{
                         $res  = M('elementary_level')->add($data);
                    }
                }//
                if($res !== false){
                    $this->success('操作成功',U('lists'));
                }else{
                    $this->error('添加失败'.'请确保有修改信息');
                }        

            }else{
                $map['id']    = I('id',0,'int');
                $data         = M('elementary_level')->where($map)->find();
                $high_level   = M('high_level')->select();
                //获取高级类别id
                $high_id      = M('middle_level')->where(array('id'=>$data['middle_id']))->getField('high_id');
                //获取中级类别
                $middle_level = M('middle_level')->where(array('high_id'=>$high_id))->select();
                $data['intro_chinese'] = htmlspecialchars_decode($data['intro_chinese']);
                $data['intro_english'] = htmlspecialchars_decode($data['intro_english']);
                $this->assign('data'        ,$data);
                $this->assign('high_level'  ,$high_level);
                $this->assign('high_id'     ,$high_id);
                $this->assign('middle_level',$middle_level);
                $this->display();
            }

        }//eidt

    // }


    /**
     * 单选删除
     */
    public function delete(){
        $map['id']  =  I('id',0,'int');
        $res = M('elementary_level')->where($map)->delete();
        if($res){
            $message="删除成功";
        }
        else{
            $message="删除失败";
        }
        $this->ajaxReturn($message);
    }

    /**
     * 全选删除
     */
    public function delAll(){
        $ids        = I('ids',0);
        $map['id']  = array('in',$ids);
        if(M('elementary_level')->where($map)->delete()){
            $message   = '删除成功';
        }else {
            $message   = '删除失败';
        }
        $this->ajaxReturn($message);
    }

    /**
     * 获取中级分类信息
     */
    public function get_middle_info(){
        $map['high_id'] = I('high_id',0,'int');
        $middle = M('middle_level')->where($map)->field('id,middle_name_chinese')->select();
        $option = '';
        foreach($middle as $vo){
            $option.='<option value='.$vo['id'].'>'.$vo['middle_name_chinese'].'</option>';
        }
        echo $option;
    }




}


