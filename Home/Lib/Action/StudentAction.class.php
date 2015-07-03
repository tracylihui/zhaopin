<?php

class StudentAction extends CommonAction{
	public function index(){
		$student = M("student")->find($_SESSION[C('USER_AUTH_KEY')]['id']);
		if(($arr=explode("|",$student['dormitory']))!=false){
			
			$student['dormitory1']=$arr[0];
			$student['dormitory2']=$arr[1];
			$student['dormitory3']=$arr[2];
		}
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
		$this->assign("student",$student);
		$this->display();
	}
	public function updateperson(){
		
		$data['id']=$_SESSION[C('USER_AUTH_KEY')]['id'];
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
		
		$m = M("student");
		if(false !== $m->save($data)){
			$student = $m->find($_SESSION[C('USER_AUTH_KEY')]['id']);
			
			if($student!=NULL){
				$_SESSION[C('USER_AUTH_KEY')]=$student;
			}	
			
			echo '{"info":"修改注册！","status":"y"}';
			
		}else{
			echo '{"info":"修改失败！","status":"n"}';	
		}
		
	}
	public function updateschool(){
		
		$data['id']=$_SESSION[C('USER_AUTH_KEY')]['id'];
		$data['tel']=$_POST['tel'];
		$data['qq']=$_POST['qq'];
		$data['academy']=$_POST['academy'];
		$data['professional']=$_POST['professional'];
		$data['grade']=$_POST['grade'];
		$data['dormitory']=$_POST['dormitory1']."|".$_POST['dormitory2']."|".$_POST['dormitory3'];
		
		$m = M("student");
		if(false !== $m->save($data)){
			$student = $m->find($_SESSION[C('USER_AUTH_KEY')]['id']);
			
			if($student!=NULL){
				$_SESSION[C('USER_AUTH_KEY')]=$student;
			}	
			
			echo '{"info":"修改注册！","status":"y"}';
			
		}else{
			echo '{"info":"修改失败！","status":"n"}';	
		}
		
	
	}
	public function updateother(){
		
		$data['id']=$_SESSION[C('USER_AUTH_KEY')]['id'];
		$data['reward']=$_POST['reward'];
		$data['support']=$_POST['support'];
		$data['freetime']=$_POST['freetime'];
		
		
		$m = M("student");
		if(false !== $m->save($data)){
			$student = $m->find($_SESSION[C('USER_AUTH_KEY')]['id']);
			
			if($student!=NULL){
				$_SESSION[C('USER_AUTH_KEY')]=$student;
			}	
			
			echo '{"info":"修改注册！","status":"y"}';
			
		}else{
			echo '{"info":"修改失败！","status":"n"}';	
		}
		
	
	}
	public function updatepass(){
		$m=M("student");
		$student = $m->field('pass')->find($_SESSION[C('USER_AUTH_KEY')]['id']);
		if(md5($_POST['oldpass'])==$student['pass']){
			$data['id']=$_SESSION[C('USER_AUTH_KEY')]['id'];
			$data['pass']=md5($_POST['pass']);
			if(false !== $m->save($data)){
				$student = $m->find($_SESSION[C('USER_AUTH_KEY')]['id']);
				if($student!=NULL){
					$_SESSION[C('USER_AUTH_KEY')]=$student;
				}	
				echo '{"info":"修改注册！","status":"y"}';
			}else{
				echo '{"info":"修改失败！","status":"n"}';	
			}	
		}else{
			echo '{"info":"原密码错误！","status":"n"}';
		}
		
		
	
	}
	public function feedback(){
		$f=M("feedback");	
		$data['sid']=$_SESSION[C('USER_AUTH_KEY')]['id'];
		$data['addtime']=time();
		$data['connect']=$_POST['connect'];
		$data['content']=$_POST['content'];
		if ($result = $f->add($data)) {
			echo '{"info":"提交成功！","status":"y"}';
		} else {
			echo '{"info":"提交失败！","status":"n"}';
		}
		
	}
}