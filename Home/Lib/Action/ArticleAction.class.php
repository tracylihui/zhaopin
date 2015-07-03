<?php

class ArticleAction extends CommonAction{
	
	//某个帖子的详情
	public function detail(){
		
		$id=$_GET['aid'];
		if($id){
			$list=M("article")->where("id={$id}")->find();
			$condition['sid'] = $_SESSION[C('USER_AUTH_KEY')]['id'];
			$condition['aid'] = $list['id'];
			$condition['_logic'] = 'AND';

			$apply=M("apply")->where($condition)->find();
			if($apply == NULL){
				$list['status']=0;	
			}else{
				$list['status']=$apply['status'];
			}
			$list['position'] = explode("|",$list['position']);
			
			$this->assign("list",$list);
			$this->display("index");
		}
		
	}
	public function edit(){
		
		$id=$_GET['aid'];
		if($id){
			$data['sid']=$_SESSION[C('USER_AUTH_KEY')]['id'];
			$list=M("article")->where("id={$id}")->find();
			
			$condition['sid'] = $_SESSION[C('USER_AUTH_KEY')]['id'];
			$condition['aid'] = $list['id'];
			$condition['_logic'] = 'AND';

			$apply=M("apply")->where($condition)->find();
			if($apply == NULL){
				$list['status']=0;	
			}else{
				$list['status']=$apply['status'];
			}
			$apply['position'] = explode("|",$apply['position']);
			$list['position'] = explode("|",$list['position']);
			
			$this->assign("apply",$apply);
			$this->assign("list",$list);
			$this->display("edit");
		}
		
	}
	public function apply(){
		
		$data['sid']=$_SESSION[C('USER_AUTH_KEY')]['id'];
		$data['studentid']=$_SESSION[C('USER_AUTH_KEY')]['studentid'];
		$data['addtime']=time();
		$data['reason']=$_POST['reason'];
		$data['aid']=$_POST['aid'];
		$data['status']=1;
		if($_POST['position']!=NULL){
			$data['position']=implode("|",$_POST['position']);
		}
		
		if($result=M("apply")->add($data)){
			$this->redirect("success");
		}else {
			//失败提示
			$this->error('申请失败');
		}
	
	}
	public function update(){
		
		
		$data['reason']=$_POST['reason'];
		$data['aid']=$_POST['aid'];
		$data['id']=$_POST['id'];
		if($_POST['position']!=NULL){
			$data['position']=implode("|",$_POST['position']);
		}
		if(false !==M("apply")->save($data)){
			$this->redirect("success");
		}else {
			//失败提示
			$this->error('申请失败');
		}
	
	}
	public function success(){
		
		
			$this->display("success");
		
	
	}

}