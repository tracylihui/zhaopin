<?php
//Public Action

class PublicAction extends Action{
	
	//加载登录页面
	public function login(){
		$this->display("login");
	}
	
	
	//执行登录验证方法
	public function checkLogin(){
		$data['username']=$_POST['name'];
		$data['userpass']=md5($_POST['pass']);
		$user=M("user");
		$authInfo = $user->where($data)->find();
		if(!empty($authInfo)){
			$_SESSION[C('USER_AUTH_KEY')]=$authInfo;
			echo json_encode("true");
		}else{
			//登陆失败 返回false字串
			echo json_encode("false");
		}
		
	}
	public function password(){
		$this->assign('id', $_SESSION[C('USER_AUTH_KEY')]['id']);
		$this->display();
	}
	public function updatePass(){
		$model = M("user");
		$data['id']=$_POST['id'];
		$data['userpass']=md5($_POST['userpass']);
		if ($result = $model->save($data)) { //保存成功
			
			$this->success(L('修改成功'));
		} else {
			//失败提示
			$this->error(L('修改失败').$model->getLastSql());
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