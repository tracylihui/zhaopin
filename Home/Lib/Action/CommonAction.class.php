<?php

class CommonAction extends Action{
	public function _initialize() {
		if(!($_SESSION[C('USER_AUTH_KEY')]['id']>0)){
			$this->redirect('Public/login');
			return;
		}
		$this->footer();
		
	}
	
	protected function articleInfo(&$list){
		
		$s=M("article");
		foreach($list as $k=>$v){
			$articleinfo=$s->where("id={$v['aid']}")->find();
			//把对应的用户信息一起封装到list中
			$list[$k]['article']=$articleinfo;
			
		}
	}
	protected function applyInfo(&$list){
		
		$s=M("apply");
		foreach($list as $k=>$v){
			$articleinfo=$s->where("id={$v['aid']}")->find();
			//把对应的用户信息一起封装到list中
			$list[$k]['article']=$articleinfo;
			
		}
	}
	
	//加载显示页脚
	public function footer(){	
		
	}
	//导入分页类
	public function loadpage($count,$pagesize=10){
		import("ORG.Util.Page");
		$Page=new Page($count,$pagesize);// 实例化分页类 传入总记录数和每页显示的记录数
		//分页样式设置
		$Page->setConfig("theme","%upPage%%first%%prePage%%linkPage%%nextPage%%downPage%");
		$show=$Page->show();// 分页显示输出
		//dump($show);
		$this->assign("page",$show);//放置到调用方法中设置的模板中
		return $Page;//返回分页类对象
	}
	
}