<?php

class FeedbackAction extends CommonAction {
	public function _filter(&$map){
		if(!empty($_POST['keyword'])){
			$map['content']=array('like',"%{$_POST['keyword']}%");	
			
		}
	}
	public function detail(){		
		$id=$_GET['id'];
		$model = M("feedback");
		$vo = $model->where("id=".$id)->find();
		$this->assign('vo', $vo);
		$this->display();
	}
}