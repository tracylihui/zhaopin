<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends CommonAction {
    public function index(){
		//取得今天的时间戳
		
		
		
		$time=time();
		$year=date("Y",$time);
		$month=date("m",$time);
		$day=date("d",$time);
		
		$startday=mktime(0,0,0,$month,$day,$year);		
		//取得一天的结束时间戳
		$stopday=mktime(23,59,59,$month,$day,$year);
		
		
		
	
		$info['date']="{$year}年{$month}月{$day}日";//当前日期
		$info['server_info']=PHP_OS;//系统平台
		$info['php_version']=PHP_VERSION;//系统平台
				
	
		
		$this->assign("info",$info);
		$this->display("index");
    }
	
	//测试方法
	public function demo(){
		$this->display("demo");
	}
		
	
}