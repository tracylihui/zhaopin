<?php
class ArticleAction extends CommonAction{
	
	public function add() {
		$years = array();
		$currentYear = date('Y');
		$years[0] = $currentYear+1;
		for ($i=1; $i<9; $i++)
		{
			$years[$i] = $currentYear - $i + 1;
		}
		
		$this->assign("years",$years);
		$this->display('add');
	}
	public function edit() {
		$model = M($this->getActionName());
		$id = $_REQUEST[$model->getPk()];
		$vo = $model->find($id);
		$years = array();
		$currentYear = date('Y');
		$years[0] = $currentYear+1;
		for ($i=1; $i<9; $i++)
		{
			$years[$i] = $currentYear - $i + 1;
		}
		
		$this->assign("years",$years);
		$this->assign('vo', $vo);
		$this->display('edit');
	}
	public function insert(){
		
		if($_POST['number']==NULL){
			$_POST['number']="若干";
		}
		$_POST['addtime']=time();
		$_POST['uid']=$_SESSION[C('USER_AUTH_KEY')]['id'];
		
		parent::insert();
	}
	public function update(){
		if($_POST['number']==NULL){
			$_POST['number']="若干";
		}
		$_POST['addtime']=time();
		parent::update();
	}
	
	//扩展：搜索条件封装方法
	public function _filter(&$map){
		if(!empty($_POST['keyword'])){
			$map['title']=array('like',"%{$_POST['keyword']}%");	
		}
		$isadmin=$_SESSION[C('USER_AUTH_KEY')]['isadmin'];	
		if($isadmin == 0){
			$uid=$_SESSION[C('USER_AUTH_KEY')]['id'];	
			$list = M("article_user")->where("uid=".$uid)->select();
			
			$myaid=array();
			if($list && is_array($list)){
				foreach($list as $v){
					$myaid[]=$v['aid'];
				}
			}
			
			$map['id']=array('in',$myaid);	
		}
	}
	public function delete() {
		//删除指定记录
		$id = $_GET['id'];
		$article = M("article");
		$apply=M("apply");
		$au=M("article_user");
		if (!empty($article)&&!empty($apply)&&!empty($au)) {
			if (isset($id)) {	
				if (false !== $apply->where('aid='.$id)->delete()) {
					if(false !== $au->where('aid='.$id)->delete()){
						if(false !== $article->where('id='.$id)->delete()){
						
							$this->success(L('删除成功'));
						}else{
							$this->error(L('删除失败'));
						}
					}else{
						$this->error(L('删除失败'));
					}
					
				} else {
					$this->error(L('删除失败'));
				}
			} else {
				$this->error('非法操作');
			}
		}
	}
	
	public function userlist(){
		//获取当前角色的id号
		$aid = $_GET['aid'];
		
		//根据角色id号获取当前角色信息（并放置到模板中）
		$article = D("article")->find($aid);
		
		$this->assign("article",$article);
		
		//获取所有node操作节点信息（并放置到模板中）
		$userlist = D("user")->where("isadmin='0'")->select();
		
		
		
		//获取当前角色以拥有的操作节点id信息（并放置到模板中）
		$list = M("article_user")->where("aid=".$aid)->select();
		//处理当前获取的节点id号
		$myuid=array();
		if($list && is_array($list)){
			foreach($list as $v){
				$myuid[]=$v['uid'];
			}
		}
		
		
		
		$this->assign("userlist",$userlist);
		$this->assign("myuid",$myuid);
		
		//输出到模板。
		$this->display("userlist");
	}
	public function savenode(){
		//获取当前角色的id号
		$aid = $_POST['aid'];
		
		$mod = M("article_user");
		//先清除当前角色权限节点
		$mod->where("aid=".$aid)->delete();
		
		//执行添加
		$data['aid']=$aid;
		foreach($_POST["uids"] as $uid){
			$data['uid']=$uid;
			$mod->add($data);
		}
		
		$this->success("保存成功！");
		
	}
	public function test(){
		    $data['status'] = 1;
    $data['info'] = 'info';
    $data['size'] = 9;
    $data['url'] = $url;
    $this->ajaxReturn($data,'JSON');
	}
     
	
    
	
}