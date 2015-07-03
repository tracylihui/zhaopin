<?php
class IndexAction extends Action {
    public function index(){	
		for($i=1;$i<5000;$i++){
		$m=M("student");
		$data['studentid']="22201132106".$i;
		$data['pass']=md5("admin");
		$data['name']="学生".$i;
		$data['sex']=1;
		$data['idnumber']="123456789";
		$data['birthday']="1993-03-21";
		$data['nation']="汉族";
		$data['political']="共青团员";
		$data['income']=3000;
		$data['address']="山东省日照市";
		$data['orphan']=1;
		$data['singleparent	']=1;
		$data['divorce']=1;
		$data['disability']=1;
		$data['martyr']=1;
		$data['tel']="14543333333";
		$data['qq']="123456";
		$data['academy']="法学院";
		$data['professional']="法学";	
		$data['grade']=2011;
		$data['dormitory']="橘园|8舍|222";
		$data['reward']="222222";
		$data['support']="222222";
		$data['freetime']="222222";
		$data['addtime']=time();
		$m->add($data);
		}
		dump(1);
		exit;
	}
	
	

	
}