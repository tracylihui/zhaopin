<?php
//网站用户信息Action类

class StudentAction extends CommonAction{
	
	//扩展：搜索条件封装方法
	public function _filter(&$map){
		if(!empty($_POST['keyword'])){
			$map['studentid']=array('like',"%{$_POST['keyword']}%");	
		}
	}
	public function detail(){
		$id=$_GET['id'];
		
		$model = M("student");
		$vo = $model->where("id=".$id)->find();
		$vo['sex']=$vo['sex']==1?"男":"女";
		$vo['orphan']=$vo['orphan']==1?"是":"否";
		$vo['singleparent']=$vo['singleparent']==1?"是":"否";
		$vo['divorce']=$vo['divorce']==1?"是":"否";
		$vo['disability']=$vo['disability']==1?"是":"否";
		$vo['martyr']=$vo['martyr']==1?"是":"否";
		$this->assign('vo', $vo);
		
		$this->display();
		
	}
	public function editpass(){
		//创建Users表信息操作对象
		$_POST['pass']=md5($_POST['pass']);
		
		$mod = D("Student");
		//执行数据封装，并检测
		if(!$mod->create()){
			$this->error($mod->getError());
		}
		//执行修改
		if($mod->save()){
			$this->success("修改成功！");
		}else{
			$this->error("修改失败！");
		}
	}
	function expStudent(){
		
		$xlsCell  = array(
            array('id','编号'),
			
			array('studentid','学号'),
			array('name','姓名'),
			array('idnumber','身份证号'),
			array('sex','性别'),
			array('nation','民族'),
			array('address','家庭地址'),
			array('political','政治面貌'),
			array('income','家庭人均年收入'),
			array('academy','学院'),
			array('professional','专业'),
			array('grade','年级'),
			array('tel','在校联系电话'),
			array('orphan','是否孤儿'),
			array('singleparent','是否单亲'),
			array('divorce','是否离异'),
			array('disability','是否残疾'),
			array('martyr','是否烈士子女'),
			array('dormitory','寝室'),
			array('reward','所获得奖励'),
			array('support','所获得资助'),
			array('freetime','本学期空余情况'), 
			  	
        );
		$students = M("student")->select();
		
		foreach($students as $k=>$v){
			$list[$k]['id']=$v['id'];
			$list[$k]['studentid']=' '.$v['studentid'];
			$list[$k]['idnumber']=' '.$v['idnumber'];
			$list[$k]['name']=$v['name'];
			$list[$k]['sex']=$v['sex']==1?"男":"女";
			$list[$k]['nation']=$v['nation'];
			$list[$k]['address']=$v['address'];
			$list[$k]['political']=$v['political'];
			$list[$k]['income']=$v['income'];
			$list[$k]['academy']=$v['academy'];
			$list[$k]['professional']=$v['professional'];
			$list[$k]['grade']=$v['grade'];
			$list[$k]['tel']=' '.$v['tel'];
			$list[$k]['orphan']=$v['orphan']==1?"是":"否";
			$list[$k]['singleparent']=$v['singleparent']==1?"是":"否";
			$list[$k]['divorce']=$v['divorce']==1?"是":"否";
			$list[$k]['disability']=$v['disability']==1?"是":"否";
			$list[$k]['martyr']=$v['martyr']==1?"是":"否";
			$list[$k]['dormitory']=$v['dormitory'];
			$list[$k]['reward']=$v['reward'];
			$list[$k]['support']=$v['support'];
			$list[$k]['freetime']=$v['freetime'];
			
		}
		
		$filename="学生信息".date('_Ymd');
		$xlsName  = "学生信息";
		
		
		$this->exportExcel($filename,$xlsName,$xlsCell,$list);
	
    }
	
}