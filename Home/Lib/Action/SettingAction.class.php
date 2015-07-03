<?php
//用户Action方法
class SettingAction extends CommonAction {
	//加载个人中心首页模板
    public function index(){
		
		$this->display();
    }
	//浏览要加关注的用户
	public function index1(){
		$id=$_SESSION['userinfo']['id'];
		import('ORG.Util.Page');
		$list1=M("Attention")->field("aid")->where("uid ={$id}")->select();
		foreach($list1 as $v){
			$list2[]=$v['aid'];
		}
		$ulist=implode(",",$list2);
		// 查询总记录数
		$count= M("users")->where("id not in({$ulist}) and id!={$id}")->count();
		// 实例化分页类 传入总记录数和每页显示的记录数
		$Page= new Page($count,9);
		$list=M("users")->where("id not in({$ulist}) and id!={$id}")->limit($Page->firstRow.','.$Page->listRows)->select();
	
		// 分页显示输出
		$show = $Page->show();
		// 赋值分页输出
		$this->assign("showpage",$show);
		$this->assign("list",$list);
		$this->display("index1");
	}
	//执行添加好友操作
	public function inser1(){
		$aid=$_POST['aid'];
		$uid=$_POST['uid'];
		$um=M("Attention");
		if(!$um->create()){
			//获取错误消息并输出
			$this->error($um->getError());
		}
		$um->addtime=time(); 
		if($um->add()){
			echo "true";
			
		}else{
			echo "false";
		}
		$list=M("Attention")->where("uid=".$_SESSION['userinfo']['id'])->select();
		//计算Attention表中好友的个数
		$num=count($list);
		//将好友数量存入到SESSION中
		$_SESSION['num'] = $num;
		$list1=M("Fans")->where("uid=".$_SESSION['userinfo']['id'])->select();
		//计算Attention表中好友的个数
		$num1=count($list1);
		//将好友数量存入到SESSION中
		$_SESSION['num1'] = $num1;
	}
	
	//浏览帖子详情
	public function detail(){
		$vo=M("Article")->find($_GET['id']);
		$this->assign("vo",$vo);
		$this->display("detail");
	}
	//加载修改用户信息模板，并且显示用户信息
	public function edit(){
		
		$this->assign("vo",D("Users")->find($_SESSION['userinfo']['id']));
		
		$this->display("edit");
	}
	//执行信息修改操作
	public function update(){
		
		$m = D("Users");
		//封装表单的信息
		if(!$m->create()){ 
		//获取错误消息并输出
			$this->error($m->getError()); 
		}
		if($m->save()){
			$this->assign("er","修改成功");
			$user=$m->find($_SESSION['userinfo']['id']);
			$this->display("edit");
		}else{
			$this->assign("er","修改失败");
			$this->display("edit");
		}
	}
	public function updatepic(){
		
		$m = D("Users");
		//封装表单的信息
		if(!$m->create()){ 
		//获取错误消息并输出
			$this->error($m->getError()); 
		}
		if($m->save()){
			$this->assign("er","修改成功");
			$user=$m->find($_SESSION['userinfo']['id']);
			$this->redirect("edit");
		}else{
			$this->assign("er","修改失败");
			$this->redirect("edit");
		}
	}
	//修改密码操作
	public function updatepass(){
		$m = D("Users");
		$pass=$_POST["pass"];
		$pass1=$_POST["pass1"];
		$pass2=$_POST["pass2"];
		if($pass==""){
			$this->error("请输入新密码");}
		if(($pass1!=$pass2)||$pass1=""){
			$this->error("两次密码输入不一致或者为空");}
		
		$oldpass=$m->field("pass")->find($_SESSION['userinfo']['id']);
		
		$_POST['pass']=md5($_POST['pass2']);
		//封装表单的信息
		if(!$m->create()){ 
		//获取错误消息并输出
			$this->error($m->getError()); 
		}
		
		if($oldpass["pass"]==md5($pass)){
			if($m->where('id='.$_SESSION['userinfo']['id'])->save()){
				$this->success("修改成功");
			}else{
				$this->error("修改失败");
			}
		}else{
			$this->error("密码错误");
		}
		
	
	}
	//加载修改图片表单
	public function editpic(){
		$this->assign("vo",D("Users")->find($_SESSION['userinfo']['id']));
		$this->display("editpic");
	}
	//执行图片裁剪技术
	public function doCut(){
		//先判断是否有图片上传
		if($_FILES['pic']['error']!=4){
			 //执行图片上传
			$_POST['pic']=$this->doupload();
		}
		$this->cutImage($_POST['picname'],"./Public/Uploads/",$_POST['x'],$_POST['y'],$_POST['w'],$_POST['h']);
		$data['id']=$_SESSION['userinfo']['id'];
		$data['picname']=$_POST['picname'];
		$user=M('Users');
		$m=$user->data($data);
		if($m->save()){
			//若有新图片，要删旧图片
			if($_FILES['pic']['error']!=4){
				@unlink("./Public/uploads/".$_GET['oldpic']);
				@unlink("./Public/uploads/".'m_'.$_GET['oldpic']);
				@unlink("./Public/uploads/".'s_'.$_GET['oldpic']);
				//把图片信息存入到SESSION中
				$_SESSION['userinfo']['picname'] = $data['picname'];	
			}
			
		}else{
			if($_FILES['pic']['error']!=4){
				@unlink("./Public/uploads/".$_POST['picname']);	
			}
		}
		
	}
	
	//定义一个处理编辑器的上传内容
	public function doupload(){
		//导入上传文件类
		import('ORG.Net.UploadFile'); 
		// 实例化上传类
		$upload = new UploadFile();
		// 设置附件上传大小
		$upload->maxSize  = 3145728 ;
		// 设置附件上传类型
		$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');
		// 设置附件上传目录
		$upload->savePath =  './Public/uploads/';
		//执行图片缩放
		$upload->thumb = true;
		$upload->thumbMaxWidth = '30,80,240';
		$upload->thumbMaxHeight = '30,80,';
		$upload->thumbPrefix = 's_,m_';
		//执行上传
		if($upload->upload()){ 
			$info =  $upload->getUploadFileInfo();
			$name = $info[0]['savename'];
			echo "<script>window.parent.uploadCallBack('{$name}');</script>";
		}else{
			echo "<script>window.parent.uploadCallBack(false);</script>";
		}
	}
	
	//图片裁剪方法
	private function cutImage($picname,$path,$x,$y,$width,$height){
		//定义获取基本信息  去除后面多余的"/"
		$path = rtrim($path,"/"); 
		 //获取图片文件的属性信息
		$info = getimagesize($path."/".$picname); 
	
		//创建新图片源
		$newim =imagecreateTrueColor($width,$height); 
		//根据原图片类型来创建图片源
		switch($info[2]){
			case 1: //gif格式
				$srcim = imageCreateFromgif($path."/".$picname);
				break;
			case 2: //jpeg格式
				$srcim = imageCreateFromjpeg($path."/".$picname);
				break;
			case 3: //png格式
				$srcim = imageCreateFrompng($path."/".$picname);
				break;
			default:
				exit("无效的图片格式!");
				break;
		}

		//执行缩放处理
		imagecopyresized($newim,$srcim,0,0,$x,$y,$width,$height,$width,$height);
		//根据原图片类型来保存新图片
		switch($info[2]){
			case 1: //gif格式
				imagegif($newim,$path."/".$prix.$picname);
				break;
			case 2: //jpeg格式
				imagejpeg($newim,$path."/".$prix.$picname);
				break;
			case 3: //png格式
				imagepng($newim,$path."/".$prix.$picname);
				break;
		}

		//销毁资源
		imageDestroy($newim);
		imageDestroy($srcim);
	}
}