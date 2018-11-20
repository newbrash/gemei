<?php
namespace Home\Controller;
use Think\Controller;

class IndexController extends Controller{
    private static $newsmore=6;
    private static $title_chinese = [
        'homepage'     =>'首页',                  //首页
        'product center'=>'产品中心',              
        'about us'      =>'关于我们',
        'technology'   =>'技术力量',
        'news center'   =>'新闻中心',
        'recruit'      =>'招贤纳士',
        'contact us'      =>'联系我们',
        'copyright owner'    =>'版权所有',
        'gemei youjia graphene technology co LTD' =>'深圳市格美优家科技有限公司',
        'internet Conternt Provider'  =>'备案号',
        'ICP preparation 16035356-1'  =>'粤ICP备18071686号',
        'product classification'      =>'产品分类',
        'telephone'                   =>'电话',
        'fax'                         =>'传真',
        'mailbox'                     =>'邮箱',
        'address'                     =>'地址',
        'enterprise culture'          =>'企业文化',
        'Our principles'              =>'我们的原则',
        'Our purpose'                 =>'我们的宗旨',
        'Our ideas'                   =>'我们的理念',
        'Our spirit'                  =>'我们的精神',
        'contact'                     =>'联系方式',
        'Focus on Gemeyu'             =>'关注格美优家',
        'Company News'                =>'公司新闻',
        'Industry developments'       =>'行业动态',
        'Salaries and benefits'       =>'薪资与福利',
        'Number of recruitments'      =>'招聘人数',
        'Description of duties'       =>'职位描述',
        'Post requirements'           =>'任职要求',
        'How to apply'                =>'应聘方式',
        'Gemeyu home'            => '格美优家',
        'Current location'       =>'当前位置',
        'Gemei youjia technology co LTD' =>'格美优家科技有限公司',
        'Click to load more'     =>'点击加载更多',
        'News details'           =>'新闻详情',
        'Product characteristics' =>'产品特点',
        'Model'                   =>'型号',
        'Size'                    =>'尺寸',
        'Weight'                  =>'重量',
        'Recommended rate of application'=>'建议适用率',
        'Related products'        =>'相关产品',
        "Date"                    =>'日期',
        "Clicks"                  =>'访问次数',  
        "More"                    =>'更多',
        'Contacts'                => '联系人',
        'Product classification'  =>'产品分类',

    ];
    private static $title_english = [

        'homepage'     =>'Home page',              
        'product center'=>'Product center',
        'about us'      =>'About us',
        'technology'   =>'Technology',
        'news center'   =>'News center',
        'recruit'      =>'Recruit',
        'contact us'      =>'Contact us',
        'copyright owner'    =>'Copyright owner',
        'gemei youjia graphene technology co LTD' =>'SHENZHENGEMEITECHOLOGYCO.LTD',
        'internet Conternt Provider'  =>'Internet Conternt Provider',
        'ICP preparation 16035356-1'  =>'粤ICP备18071686号',
        'product classification'      =>'Product classification',
        'telephone'                   =>'Telephone',
        'fax'                         =>'Fax',
        'mailbox'                     =>'Mailbox',
        'address'                     =>'Address',
        'enterprise culture'          =>'Enterprise culture',
        'Our principles'              =>'Our principles',
        'Our purpose'                 =>'Our purpose',
        'Our ideas'                   =>'Our ideas',
        'Our spirit'                  =>'Our spirit',
        'contact'                     =>'Contact',
        'Focus on Gemeyu'             =>'Focus on Gemeyu',
        'Company News'                =>'Company News',
        'Salaries and benefits'       =>'Salaries and benefits',
        'Industry developments'       =>'Industry developments',
        'Number of recruitments'      =>'Number of recruitments',
        'Description of duties'       =>'Description of duties',
        'Post requirements'           =>'Post requirements',
        'How to apply'                =>'How to apply', 
        'Gemeyu home'            =>'Gemeyu home',
        'Current location'       =>'Current location',
        'Gemei youjia technology co LTD' =>'Gemei youjia technology co. LTD',
        'Click to load more'     =>'Click to load more',
        'News details'           =>'News details',
        'Product characteristics' =>'Product characteristics',
        'Model'                   =>'Model',
        'Size'                    =>'Size',
        'Weight'                  =>'Weight',
        'Recommended rate of application'=>'Recommended rate of application',
        'Related products'        =>'Related products',
        "Date"                    =>'Date',
        "Clicks"                  =>'View counts',
        "More"                    =>'More',
        'Contacts'                => 'Contacts',

    ];



    public function index(){
        $lang=I('lang');
        if(!$lang) {$lang ='chinese';}
        $title = self::$title_chinese;

        if($lang =='english'){
           $title = self::$title_english;
        } //页面固定信息中英文翻译

        $high_where = ['is_display'=>1];
        $high_info  = M('high_level')->where($high_where)->order('sort asc')->select();
        $middle_where = '(';
        foreach($high_info as $key=>$value){
            $middle_where.= '(high_id ='.$value['id'].' AND '.'is_display=1)'.' OR '; 
        }
        $middle_where=trim($middle_where,' OR ').')';
        $middle_info = M('middle_level')->where($middle_where)->order('high_id asc,sort asc')->select();
        foreach($middle_info as $key=>$value){
            $products_where.= 'middle_id ='.$value['id'].' OR '; 
        }
        $products_where=trim($products_where,' OR ');
        $products_info = M('elementary_level')->where($products_where)->order('addtime desc')->select();
        foreach($high_info as $high_key=>$high_val){
            $high_name_chinese=$high_val['high_name_chinese'];
            $high_name_english=$high_val['high_name_english'];
            foreach($middle_info as $middle_key=>$middle_val){
                if($middle_val['high_id']==$high_val['id']){
                   $middle_name_chinese=$middle_val['middle_name_chinese'];
                   $middle_name_english=$middle_val['middle_name_english'];
                   foreach($products_info as $products_key=>$products_val){
                            if($products_val['middle_id']==$middle_val['id']){
                                 $products['chinese'][$high_name_chinese][$middle_name_chinese][$products_key]=$products_val;
                                 $products['english'][$high_name_english][$middle_name_english][$products_key]=$products_val;
                            }
                    }
                }

            }
        }
        foreach($high_info as $keyh=>$voh){
            $high_chinese=$voh['high_name_chinese'];
            foreach($middle_info as $keym=>$vom){
                $middle_chinese=$vom['middle_name_chinese'];
                if($vom['high_id']==$voh['id']){
                    $middle_infokc[$high_chinese]=$middle_chinese;
                    break;
                }
            }
        }
        foreach($high_info as $keyh=>$voh){
            $high_english=$voh['high_name_english'];
            foreach($middle_info as $keym=>$vom){
                $middle_english=$vom['middle_name_english'];
                if($vom['high_id']==$voh['id']){
                    $middle_infoke[$high_english]=$middle_english;
                    break;
                }
            }
        }
        //尾部联系我们
        $data=M('contact')->find();
        $this->assign('data',$data);
        //尾部联系我们
        $aboutus = M('aboutus')->find();
        $aboutus['intro_chinese'] = htmlspecialchars_decode($aboutus['intro_chinese']);
        $aboutus['intro_english'] = htmlspecialchars_decode($aboutus['intro_english']);
        $aboutus['intro_chinese'] = strip_tags($aboutus['intro_chinese']);
        $aboutus['intro_english'] = strip_tags($aboutus['intro_english']);
        $news    = M('news')->order('addtime desc')->limit(0,5)->select();
        foreach($news as $key=>$vo){
            $news[$key]['intro_chinese'] = htmlspecialchars_decode($news[$key]['intro_chinese']);
            $news[$key]['intro_english'] = htmlspecialchars_decode($news[$key]['intro_english']);
            $news[$key]['intro_chinese'] = strip_tags($news[$key]['intro_chinese']);
            $news[$key]['intro_english'] = strip_tags($news[$key]['intro_english']);                 
        }
        
        $this->assign(
            [
                'aboutus'=>$aboutus,
                'news'   =>$news,
            ]
        );
        $lunbo = M('lunbo')->where(['is_display'=>1])->select();
        $logo = M('headpic')->where(['id'=>1])->getfield('picurl_'.$lang);
        $this->assign('logo',$logo);
        $this->assign('lunbo',$lunbo);
        $this->assign('title',$title);
        $this->assign('lang',$lang);
        $this->assign('key_high_chinese',$high_info[0]['high_name_chinese']);
        $this->assign('key_high_english',$high_info[0]['high_name_english']);
        $this->assign('key_middle_chinese',$middle_infokc);
        $this->assign('key_middle_english',$middle_infoke);
        $this->assign('products',$products);
        // dump($products);
    	$this->display();
    }
     public function contact(){
        $lang=I('lang');
        if(!$lang) {$lang ='chinese';}
        $title = self::$title_chinese;

        if($lang =='english'){
           $title = self::$title_english;
        }
        $headpic=M('headpic')->where(['name'=>'联系我们'])->find();
        $this->assign('headpic',$headpic);
        $logo = M('headpic')->where(['id'=>1])->getfield('picurl_'.$lang);
        $this->assign('logo',$logo);        
        $data=M('contact')->find();
        $this->assign('data',$data);
        $this->assign('title',$title);
        $this->assign('lang',$lang);
        $this->display();
    }
     public function about(){
        $lang=I('lang');
        if(!$lang) {$lang ='chinese';}
        $title = self::$title_chinese;

        if($lang =='english'){
           $title = self::$title_english;
        }
        //尾部联系我们
        $data=M('contact')->find();
        $this->assign('data',$data);
        //尾部联系我们
        $logo = M('headpic')->where(['id'=>1])->getfield('picurl_'.$lang);
        $this->assign('logo',$logo);
        //头部lolo        
        $about=M('aboutus')->find();
        $about['intro_chinese']=htmlspecialchars_decode(html_entity_decode($about['intro_chinese']));
        $about['intro_english']=htmlspecialchars_decode(html_entity_decode($about['intro_english'])); 
        $this->assign('about',$about);       
        $headpic=M('headpic')->where(['name'=>'关于我们'])->find();
        $this->assign('title',$title);
        $this->assign('lang',$lang); 
        $this->assign('headpic',$headpic);//头部轮播
        $this->display();
    }


     public function products(){
        $lang=I('lang');
        if(!$lang) {$lang ='chinese';}
        $title = self::$title_chinese;

        if($lang =='english'){
           $title = self::$title_english;
        } //页面固定信息中英文翻译

        $high_where = ['is_display'=>1];
        $high_info  = M('high_level')->where($high_where)->limit(6)->order('sort asc')->select();
        $middle_where = '(';
        foreach($high_info as $key=>$value){
            $middle_where.= '(high_id ='.$value['id'].' AND '.'is_display=1)'.' OR '; 
        }
        $middle_where=trim($middle_where,' OR ').')';
        $middle_info = M('middle_level')->where($middle_where)->order('high_id asc,sort asc')->select();
        foreach($middle_info as $key=>$value){
            $products_where.= 'middle_id ='.$value['id'].' OR '; 
        }
        $products_where=trim($products_where,' OR ');
        $products_info = M('elementary_level')->where($products_where)->order('addtime desc')->select();
        foreach($high_info as $high_key=>$high_val){
            $high_name_chinese=$high_val['high_name_chinese'];
            $high_name_english=$high_val['high_name_english'];
            foreach($middle_info as $middle_key=>$middle_val){
                if($middle_val['high_id']==$high_val['id']){
                   $middle_name_chinese=$middle_val['middle_name_chinese'];
                   $middle_name_english=$middle_val['middle_name_english'];
                   foreach($products_info as $products_key=>$products_val){
                            if($products_val['middle_id']==$middle_val['id']){
                                 $products['chinese'][$high_name_chinese][$middle_name_chinese][$products_key]=$products_val;
                                 $products['english'][$high_name_english][$middle_name_english][$products_key]=$products_val;
                            }
                         }
                }

            }
        }
        foreach($high_info as $keyh=>$voh){
            $high_chinese=$voh['high_name_chinese'];
            foreach($middle_info as $keym=>$vom){
                $middle_chinese=$vom['middle_name_chinese'];
                if($vom['high_id']==$voh['id']){
                    $middle_infokc[$high_chinese]=$middle_chinese;
                    break;
                }
            }
        }
        foreach($high_info as $keyh=>$voh){
            $high_english=$voh['high_name_english'];
            foreach($middle_info as $keym=>$vom){
                $middle_english=$vom['middle_name_english'];
                if($vom['high_id']==$voh['id']){
                    $middle_infoke[$high_english]=$middle_english;
                    break;
                }
            }
        }
        $headpic=M('headpic')->where(['name'=>'产品中心'])->find();
        $this->assign('headpic',$headpic);
        $this->assign('title',$title);
        $this->assign('lang',$lang);
        $this->assign('key_high_chinese',$high_info[0]['high_name_chinese']);
        $this->assign('key_high_english',$high_info[0]['high_name_english']);
        $this->assign('key_middle_chinese',$middle_infokc);
        $this->assign('key_middle_english',$middle_infoke);
        //尾部联系我们
        $logo = M('headpic')->where(['id'=>1])->getfield('picurl_'.$lang);
        $this->assign('logo',$logo);
        //头部lolo           
        $data=M('contact')->find();
        $this->assign('data',$data);
        //尾部联系我们
        $this->assign('products',$products);
        // dump($products);die;
        $this->display();
    }
    // 产品业加分类
     public function productPer(){
        $where['id']=I('id');
        $lang=I('lang');
        if(!$lang) {$lang ='chinese';}
        $title = self::$title_chinese;

        if($lang =='english'){
           $title = self::$title_english;
        }
        $productPer=M('elementary_level')->where($where)->find();
        $middle = M('middle_level')->where(['id'=>$productPer['middle_id']])->find();
        $middle_id=$productPer['middle_id'];
        //查找推荐产品
        $tuijian = M('elementary_level')->where(['middle_id'=>$middle_id])->select();
        $productPer['intro_chinese']=htmlspecialchars_decode(html_entity_decode($productPer['intro_chinese']));
        $productPer['intro_english']=htmlspecialchars_decode(html_entity_decode($productPer['intro_english']));
        $headpic=M('headpic')->where(['name'=>'产品中心'])->find();
        //尾部联系我们
        $data=M('contact')->find();
        $this->assign('data',$data);
        //尾部联系我们  
        $logo = M('headpic')->where(['id'=>1])->getfield('picurl_'.$lang);
        $this->assign('logo',$logo);
        //头部lolo                
        $this->assign('headpic',$headpic);        
        $this->assign('productPer',$productPer);
        $this->assign('title',$title);
        $this->assign('middle',$middle);
        $this->assign('tuijian',$tuijian);
        $this->assign('lang',$lang);
        $this->display();
    }


     public function recruit(){

        $lang=I('lang');
        if(!$lang) {$lang ='chinese';}
        $title = self::$title_chinese;

        if($lang =='english'){
           $title = self::$title_english;
        }
        //尾部联系我们
        $data=M('contact')->find();

        $this->assign('data',$data);
        //尾部联系我们
        $logo = M('headpic')->where(['id'=>1])->getfield('picurl_'.$lang);
        $this->assign('logo',$logo);
        //头部lolo           
        $headpic=M('headpic')->where(['name'=>'招贤纳士'])->find();
        $this->assign('headpic',$headpic);
        $recruit=M('recruit')->select();
        $recruit[0]['salaris_chinese'] = htmlspecialchars_decode($recruit[0]['salaris_chinese']);
        $recruit[0]['salaris_english'] = htmlspecialchars_decode($recruit[0]['salaris_english']);
        $recruit[0]['apply_chinese'] = htmlspecialchars_decode($recruit[0]['apply_chinese']);
        $recruit[0]['apply_english'] = htmlspecialchars_decode($recruit[0]['apply_english']);
        //薪资福利与联系方式固定
        foreach($recruit as $key=>$val){
            $recruit[$key]['description_chinese'] = htmlspecialchars_decode($recruit[$key]['description_chinese']);
            $recruit[$key]['description_english'] = htmlspecialchars_decode($recruit[$key]['description_english']);
            $recruit[$key]['requirement_chinese'] = htmlspecialchars_decode($recruit[$key]['requirement_chinese']);
            $recruit[$key]['requirement_english'] = htmlspecialchars_decode($recruit[$key]['requirement_english']);
        }                
        $this->assign('recruit',$recruit);
        $this->assign('title',$title);
        $this->assign('lang',$lang);
    	$this->display();
    }


     public function technology(){
        $lang=I('lang');
        if(!$lang) {$lang ='chinese';}
        $title = self::$title_chinese;

        if($lang =='english'){
           $title = self::$title_english;
        }
        //尾部联系我们
        $data=M('contact')->find();
        $this->assign('data',$data);
        //尾部联系我们
        $logo = M('headpic')->where(['id'=>1])->getfield('picurl_'.$lang);
        $this->assign('logo',$logo);
        //头部lolo           
        $headpic=M('headpic')->where(['name'=>'技术力量'])->find();
        $technology = M('technology')->find();
        $technology['intro_chinese'] = htmlspecialchars_decode(html_entity_decode($technology['intro_chinese']));
        $technology['intro_english'] = htmlspecialchars_decode($technology['intro_english']);           
        $technology['content1_chinese'] = htmlspecialchars_decode(html_entity_decode($technology['content1_chinese']));
        $technology['content1_english'] = htmlspecialchars_decode($technology['content1_english']);
        $technology['content2_chinese'] = htmlspecialchars_decode($technology['content2_chinese']);
        $technology['content2_english'] = htmlspecialchars_decode($technology['content2_english']);
        $technology['content3_chinese'] = htmlspecialchars_decode($technology['content3_chinese']);
        $technology['content3_english'] = htmlspecialchars_decode($technology['content3_english']);
        $technology['content4_chinese'] = htmlspecialchars_decode($technology['content4_chinese']);
        $technology['content4_english'] = htmlspecialchars_decode($technology['content4_english']);

        $technology['content1_chinese'] = strip_tags(html_entity_decode($technology['content1_chinese']));
        $technology['content1_english'] = strip_tags($technology['content1_english']);
        $technology['content2_chinese'] = strip_tags($technology['content2_chinese']);
        $technology['content2_english'] = strip_tags($technology['content2_english']);
        $technology['content3_chinese'] = strip_tags($technology['content3_chinese']);
        $technology['content3_english'] = strip_tags($technology['content3_english']);
        $technology['content4_chinese'] = strip_tags($technology['content4_chinese']);
        $technology['content4_english'] = strip_tags($technology['content4_english']);
        $this->assign('technology',$technology);        
        $this->assign('headpic',$headpic);
        $this->assign('title',$title);
        $this->assign('lang',$lang);
    	$this->display();
    }
     public function news(){
        $firstRow = 0;
        $listRows = 6;
        $havepage=I('nowpage');
        //每次ajax从新的一页开始查询
         if($havepage){
            $firstRow = $havepage*$listRows;
         }
        $status = I('status'); //0 公司新闻 1 行业动态， 默认行业动态
        if(!$status){
          $status=0;
        }

        $lang=I('lang');
        if(!$lang) {$lang ='chinese';}
        $title = self::$title_chinese;

        if($lang =='english'){
           $title = self::$title_english;
        }
        //尾部联系我们
        $data=M('contact')->find();
        $this->assign('data',$data);
        //尾部联系我们
        $logo = M('headpic')->where(['id'=>1])->getfield('picurl_'.$lang);
        $this->assign('logo',$logo);
        //头部lolo           
        $headpic=M('headpic')->where(['name'=>'新闻中心'])->find();
        $this->assign('headpic',$headpic);
        //$fistRow = $havepage*$listRow $listRow=6每次ajax6条
        $news = M('news')->where(['status'=>$status])->order('addtime desc')->limit($firstRow,$listRows)->select();
        foreach($news as $key=>$val){
            $news[$key]['intro_english']=htmlspecialchars_decode($news[$key]['intro_english']);
            $news[$key]['intro_chinese']=htmlspecialchars_decode($news[$key]['intro_chinese']);
            $news[$key]['intro_english']=strip_tags($news[$key]['intro_english']);
            $news[$key]['intro_chinese']=strip_tags($news[$key]['intro_chinese']);            
        }
        if($havepage){
         $this->ajaxreturn(json_encode($news));
        }
        $count = M('news')->where(['status'=>$status])->count();
        $pagelists = $count/$listRows;
        $this->assign('pagelists',$pagelists); 
        $this->assign('status',$status);       
        $this->assign('news',$news);
        $this->assign('title',$title);
        $this->assign('lang',$lang);
    	$this->display();
    }

     public function newsper(){
        $id=I('id');
        $lang=I('lang');
        if(!$lang) {$lang ='chinese';}
        $title = self::$title_chinese;

        if($lang =='english'){
           $title = self::$title_english;
        }
        //点击数+1
        $clicks = M('news')->field('clicks')->where(['id'=>$id])->find();
        $clicks['clicks']++;
        M('news')->where(['id'=>$id])->save($clicks);
        //尾部联系我们
        $data=M('contact')->find();
        $this->assign('data',$data);
        //尾部联系我们        $headpic=M('headpic')->where(['name'=>'新闻中心'])->find();
        $logo = M('headpic')->where(['id'=>1])->getfield('picurl_'.$lang);
        $this->assign('logo',$logo);
        //头部lolo           
        $headpic=M('headpic')->where(['name'=>'新闻中心'])->find();
        $this->assign('headpic',$headpic);
        $news = M('news')->where(['id'=>$id])->find();
        $news['content_english']=htmlspecialchars_decode($news['content_english']);
        $news['content_chinese']=htmlspecialchars_decode($news['content_chinese']);
        $this->assign('news',$news);        
        $this->assign('title',$title);
        $this->assign('lang',$lang);
    	$this->display();
    }
     public function map(){
        $lang=I('lang');
        if(!$lang) {$lang ='chinese';}
        $title = self::$title_chinese;

        if($lang =='english'){
           $title = self::$title_english;
        }
        $this->assign('title',$title);
        $this->assign('lang',$lang);
    	$this->display();
    }
}