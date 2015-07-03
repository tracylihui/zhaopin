<?php


function showStatus($status) {
	
	switch ($status) {
		case 1 :
			$info = '已提交</span>';
			break;
		case 2 :
			$info = '<span style="color:green">已通过';
			break;
		case 3 :
			$info = '<span style="color:red">未通过';
			break;
		
	}
	
	return $info;
}
function showSex($status) {
	
	switch ($status) {
		case 1 :
			$info = '男';
			break;
		case 0 :
			$info = '女';
			break;
		
	}
	
	return $info;
}
function showYN($status) {
	
	switch ($status) {
		case 1 :
			$info = '是';
			break;
		case 0 :
			$info = '否';
			break;
		
	}
	
	return $info;
}
function striptags($content){
	$info =strip_tags($content);
	return $info;
}

?>