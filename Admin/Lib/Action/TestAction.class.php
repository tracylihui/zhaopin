<?php
// 本类由系统自动生成，仅供测试用途
class TestAction extends CommonAction {
	
	public function feedback(){
		$model = M("feedback");
		
		for($i=1;$i<1000;$i++){
		$data['sid']=$i;
		$data['connect']="13543345433";
		$data['content']="反馈".$i;
		
		$data['addtime']=time();
		$model->add($data);
		}
    }
	public function apply(){
		$model = M("apply");
		
		for($i=1;$i<1000;$i++){
		$data['sid']=$i;
		$data['studentid']="222".$i;
		$data['aid']=1;
		$data['reason']="理由".$i;
		$data['status']=1;
		
		$data['addtime']=time();
		$model->add($data);
		}
    }
    public function article(){
		$model = M("article");
		
		for($i=1;$i<1000;$i++){
		$data['title']="项目".$i;
		$data['content']="项目的内容".$i;
		$data['number']="若干";
		$data['uid']=1;
		$data['time']="暑假";
		$data['grade']=0;
		$data['sex']=2;
		$data['company']="图书管";
		$data['place']="中心图书馆";
		$data['addtime']=time();
		$model->add($data);
		}
    }
	public function student(){
		$model = M("student");
		
		for($i=1;$i<1000;$i++){
		$data['studentid']="222".$i;
		$data['pass']=md5("admin");
		$data['name']="学生".$i;
		$data['sex']=1;
		$data['idnumber']="371102343222233452";
		$data['birthday']="1993-03-32";
		$data['nation']="汉族";
		$data['political']="共青团员";
		$data['income']=20000;
		$data['address']="地址".$i;
		$data['orphan']=1;
		$data['singleparent']=1;
		$data['divorce']=1;
		$data['disability']=1;
		$data['martyr']=1;
		$data['tel']="13455433456";
		$data['qq']="5343553453";
		$data['academy']="计算机与信息科学学院软件学院";
		$data['professional']="软件工程";	
		$data['grade']="2011";
		$data['dormitory']="李园|2舍|222";
		$data['reward']="奖励".$i;
		$data['support']="资助".$i;
		$data['freetime']="空闲时间".$i;
		$data['addtime']=time();
		$model->add($data);
		}
		
		
	}
	
}