<?php
//Public Action

class PublicAction extends Action{
	
	//加载登录页面
	public function login(){
		$this->display("login");
	}
	
	
	//执行登录验证方法
	public function checkLogin(){
		$data['studentid']=$_POST['name'];
		$data['pass']=md5($_POST['pass']);
		$student=M("student");
		$authInfo = $student->where($data)->find();
		if(!empty($authInfo)){
			if($authInfo['status']==1){
				$_SESSION[C('USER_AUTH_KEY')]=$authInfo;
				echo '{"info":"登录成功！","status":"y"}';	
			}else{
				echo '{"info":"用户已禁用！","status":"n"}';		
			}
			
		}else{
			//登陆失败 返回false字串
			echo '{"info":"用户名或密码错误！","status":"n"}';
		}
		
	}
	
	//执行退出操作方法
	public function logout(){
		unset($_SESSION[C('USER_AUTH_KEY')]);
		$this->display("login");
	}
	
	//加载验证码
	public function verify(){
		import('ORG.Util.Image');
		Image::buildImageVerify();
	}

}