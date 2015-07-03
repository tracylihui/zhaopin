<?php
//网站用户信息Action类

class AcademyAction extends CommonAction{
	
	//扩展：搜索条件封装方法
	public function _filter(&$map){
		if(!empty($_POST['keyword'])){
			$map['studentid']=array('like',"%{$_POST['keyword']}%");	
		}
	}
	
	
}