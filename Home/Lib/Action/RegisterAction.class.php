<?php
//注册Action方法
class RegisterAction extends Action{
	 public function index(){
		$years = array();
		$currentYear = date('Y');
		$years[0] = $currentYear+1;
		for ($i=1; $i<9; $i++)
		{
			$years[$i] = $currentYear - $i + 1;
		}
		$academy=M("academy")->select();
		$dormitory=M("dormitory")->select();
		$this->assign("academy",$academy);
		$this->assign("dormitory",$dormitory);
		$this->assign("years",$years);
		$this->display("index");
    }
	public function checkStudentid(){
		$studentid=$_POST["param"];
		$student=M("student")->where("studentid=".$studentid)->find();
		
		if($student){
			echo '{"info":"该学号已注册！","status":"n"}';
		}else{
			echo '{"info":"验证通过！","status":"y"}';
			
		}
		
	
	}
	//执行注册添加操作
	public function insert(){
		$model = D("student");
		
	
		$data['studentid']=$_POST['studentid'];
		$data['pass']=md5($_POST['pass']);
		$data['name']=$_POST['name'];
		$data['sex']=$_POST['sex'];
		$data['idnumber']=$_POST['idnumber'];
		$data['birthday']=$_POST['birthday'];
		$data['nation']=$_POST['nation'];
		$data['political']=$_POST['political'];
		$data['income']=$_POST['income'];
		$data['address']=$_POST['address'];
		$data['orphan']=$_POST['orphan'];
		$data['singleparent']=$_POST['singleparent'];
		$data['divorce']=$_POST['divorce'];
		$data['disability']=$_POST['disability'];
		$data['martyr']=$_POST['martyr'];
		$data['tel']=$_POST['tel'];
		$data['qq']=$_POST['qq'];
		$data['academy']=$_POST['academy'];
		$data['professional']=$_POST['professional'];	
		$data['grade']=$_POST['grade'];
		$data['dormitory']=$_POST['dormitory1']."|".$_POST['dormitory2']."|".$_POST['dormitory3'];
		$data['reward']=$_POST['reward'];
		$data['support']=$_POST['support'];
		$data['freetime']=$_POST['freetime'];
		$data['addtime']=time();
		
		if ($result = $model->add($data)) {
			echo '{"info":"注册成功！","status":"y"}';
		} else {
			echo '{"info":"新增失败！","status":"n"}';
		}
		
	}
}