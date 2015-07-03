<?php
//网站用户信息Action类

class UserAction extends CommonAction{
	
	//扩展：搜索条件封装方法
	public function _filter(&$map){
		if(!empty($_POST['keyword'])){
			$map['name']=array('like',"%{$_POST['keyword']}%");	
		}
		if($_GET['isadmin'] == 1){
			$map['isadmin']=array('eq',1);
		}
		if($_GET['isadmin'] == 0){
			$map['isadmin']=array('eq',0);
		}
		
	}
	public function index(){
		if($_GET['isadmin'] == 1){
			$this->assign("isadmin",1);
		}
		if($_GET['isadmin'] == 0){
			$this->assign("isadmin",0);
		}
		parent::index();
	}
	public function articlelist(){
		$uid = $_GET["uid"];
		$list = M("article_user")->where("uid=".$uid)->select();
		$this->articleInfo($list);
			
		$this->assign("list",$list);
		$this->display();
	}
	
	//插入
	public function insert(){
		$_POST['regdate']=time();
		parent::insert();
	}
	//删除
	public function delete() {
		//删除指定记录
		$model = M("User");
		if (!empty($model)) {
			$pk = $model->getPk();
			$id = $_REQUEST[$pk];
			if (isset($id)) {
				if(($_SESSION[C('USER_AUTH_KEY')]['id'])==$id){
					$this->error('不能删除正在登陆用户');
				}else{
					
					$condition = array($pk => array('in', explode(',', $id)));
					if (false !== $model->where($condition)->delete()) {
						$this->success(L('删除成功'));
					} else {
						$this->error(L('删除失败'));
					}	
				}
			} else {
				$this->error('非法操作');
			}
		}
	}
	
	
	
	
}