<?php


function loadpage($count,$pagesize=10){
		import("ORG.Util.Page");
		$Page=new Page($count,$pagesize);// 实例化分页类 传入总记录数和每页显示的记录数
		//分页样式设置
		$Page->setConfig("theme","%upPage%%first%%prePage%%linkPage%%nextPage%%downPage%");
		$show=$Page->show();// 分页显示输出
		//dump($show);
		$this->assign("page",$show);//放置到调用方法中设置的模板中
		return $Page;//返回分页类对象
	}



// zhanghuihua@msn.com
function showStatus($status,$id, $navTabId="") {
	
	switch ($status) {
		case 0 :
			$info = '<a href="__URL__/resume/id/' . $id . '/navTabId/' . $navTabId . '" target="ajaxTodo" style="color:green">恢复</a>';
			break;
		case 2 :
			$info = '<a href="__URL__/pass/id/' . $id . '/navTabId/__MODULE__" style="color:red;" target="ajaxTodo" callback="'.$callback.'">批准</a>';
			break;
		case 1 :
			$info = '<a href="__URL__/forbid/id/' . $id . '/navTabId/' . $navTabId . '" target="ajaxTodo" style="color:red">禁用</a>';
			break;
		case - 1 :
			$info = '<a href="__URL__/recycle/id/' . $id . '/navTabId/__MODULE__" style="color:red;" target="ajaxTodo" callback="'.$callback.'">还原</a>';
			break;
	}
	
	return $info;
}
function striptags($content){
	$info =strip_tags($content);
	return $info;
}

?>