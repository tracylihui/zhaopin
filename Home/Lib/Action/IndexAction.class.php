<?php
class IndexAction extends CommonAction {
    public function index(){	
		$m=M("article");
		$student = $_SESSION[C('USER_AUTH_KEY')];
		$count=$m->count();
		$Page=$this->loadpage($count);//调用common类中的loadpage方法生成分页类对象
		//进行分页数据查询
		$map['grade'] = array(array('eq',0),array('eq',$student['grade']), 'or');
		$map['sex'] = array(array('eq',2),array('eq',$student['sex']), 'or');
		$list=$m->limit($Page->firstRow.','.$Page->listRows)->where($map)->order('addtime desc')->select();
		
		$select_id=1;
		$this->assign("select_id",$select_id);
		$this->assign("list",$list);
		
		//加载显示模板
		$this->display("index");
	}
	public function myarticle(){
		$sid = $_SESSION[C('USER_AUTH_KEY')]['id'];	
		$m=M("apply");
		$count=$m->where("sid=".$sid)->count();
		$Page=$this->loadpage($count);//调用common类中的loadpage方法生成分页类对象
		//进行分页数据查询
		$list=$m->where("sid=".$sid)->limit($Page->firstRow.','.$Page->listRows)->order('addtime desc')->select();
		$this->articleInfo($list);
		
		$select_id=2;
		$this->assign("list",$list);
		$this->assign("select_id",$select_id);
		$this->display("myarticle");
	}
	
	

	
}