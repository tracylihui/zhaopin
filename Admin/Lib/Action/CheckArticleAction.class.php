<?php
class CheckArticleAction extends CommonAction{
	public function index() {
		$aid=$_GET['aid'];
		$r=M("apply");
		$map['aid'] = array('eq',$aid);
		$map['status'] = array('eq',1);
		
		$this->_list($r,$map);
		$this->assign("aid",$aid);
		$this->display();
	}
	
}