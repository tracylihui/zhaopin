<?php
class ApplyAction extends CommonAction{
	public function _filter(&$map){
		if(!empty($_POST['keyword'])){
			$map['studentid']=array('like',"%{$_POST['keyword']}%");	
		}
	}
	public function checkArticle(){
		$m=M("apply");
		$id=$_POST['id'];
		$data['status']=$_POST['status'];
		
		
		$res=$m->where("id={$id}")->save($data);
		if($res){
			
			//成功提示
			$this->success(L('更新成功'));
		}else{
			//错误提示
			$this->error(L('更新失败'));
		}
	}
	public function apply(){
		$map = $this->_search();
		if(method_exists($this, '_filter')) {
			$this->_filter($map);
		}
		$aid=$_GET['aid'];
		$r=M("apply");
		$map['aid'] = array('eq',$aid);
		$map['status'] = array('eq',1);
		$this->_list($r,$map);
		$this->assign("aid",$aid);
		$this->display();
	}
	public function applyNo(){
		$map = $this->_search();
		if(method_exists($this, '_filter')) {
			$this->_filter($map);
		}
		$aid=$_GET['aid'];
		$r=M("apply");
		$map['aid'] = array('eq',$aid);
		$map['status'] = array('eq',3);
		$this->_list($r,$map);
		$this->assign("aid",$aid);
		$this->display();
	}
	public function applyOk(){
		$map = $this->_search();
		if(method_exists($this, '_filter')) {
			$this->_filter($map);
		}
		$aid=$_GET['aid'];
		$r=M("apply");
		$map['aid'] = array('eq',$aid);
		$map['status'] = array('eq',2);
		$this->_list($r,$map);
		$this->assign("aid",$aid);
		$this->display();
	}
	protected function _list($model, $map = array(), $sortBy = '', $asc = false) {
		
		//排序字段 默认为主键名
		
		if (!empty($_REQUEST['_order'])) {
			$order = $_REQUEST['_order'];
		} else {
			$order = !empty($sortBy)?$sortBy:$model->getPk();
		}
		
		//排序方式默认按照倒序排列
		//接受 sort参数 0 表示倒序 非0都 表示正序
		if (!empty($_REQUEST['_sort'])) {
			$sort = $_REQUEST['_sort'] == 'asc'?'asc':'desc';
		} else {
			$sort = $asc ? 'asc' : 'desc';
		}
		
		//取得满足条件的记录数
		$count = $model->where($map)->count();
		
		//每页显示的记录数
		if (!empty($_REQUEST['numPerPage'])) {
			$listRows = $_REQUEST['numPerPage'];
		} else {
			$listRows = '20';
		}
		
		
		//设置当前页码
		if(!empty($_REQUEST['pageNum'])) {
			$nowPage=$_REQUEST['pageNum'];
		}else{
			$nowPage=1;
		}
		$_GET['p']=$nowPage;
		
		//创建分页对象
		import("ORG.Util.Page");
		$p = new Page($count, $listRows);
		
		
		//分页查询数据
		//$list = $model->where($map)->order($order . ' ' . $sort)->select();
		$list = $model->where($map)->order($order.' '.$sort)
						->limit($p->firstRow.','.$p->listRows)
						->select();
						
		//回调函数，用于数据加工，如将用户id，替换成用户名称
		if (method_exists($this, '_tigger_list')) {
			$this->_tigger_list($list);
		}
		//分页跳转的时候保证查询条件
		foreach ($map as $key => $val) {
			if (!is_array($val)) {
				$p->parameter .= "$key=" . urlencode($val) . "&";
			}
		}
	
		//分页显示
		$page = $p->show();
		
		//列表排序显示
		$sortImg = $sort;                                 //排序图标
		$sortAlt = $sort == 'desc' ? '升序排列' : '倒序排列';   //排序提示
		$sort = $sort == 'desc' ? 1 : 0;                  //排序方式
		
		//封装用户信息
		$this->studentInfoApply(&$list);
		
		//模板赋值显示
		$this->assign('list', $list);
		$this->assign('sort', $sort);
		$this->assign('order', $order);
		$this->assign('sortImg', $sortImg);
		$this->assign('sortType', $sortAlt);
		$this->assign("page", $page);
		
		$this->assign("search",			$search);			//搜索类型
		$this->assign("values",			$_POST['values']);	//搜索输入框内容
		$this->assign("totalCount",		$count);			//总条数
		$this->assign("numPerPage",		$p->listRows);		//每页显多少条
		$this->assign("currentPage",	$nowPage);			//当前页码
		
		
	}
	protected function studentInfoApply(&$list){
		$s=M("student");
		foreach($list as $k=>$v){
			$userinfo=$s->where("id={$v['sid']}")->find();
			//把对应的用户信息一起封装到list中
			
			$list[$k]['name']=$userinfo['name'];
			$list[$k]['academy']=$userinfo['academy'];
		}
	}
	public function detail(){
		$id=$_GET['id'];
		$status=$_GET['status'];
		$model = M("apply");
		$vo = $model->where("id=".$id)->select();
		$this->studentInfo($vo);
		$vo=$vo[0];
		
		$this->assign('vo', $vo);
		if($status==1){
			$this->display('detailno');
		}else if($status==2){
			$this->display('detailok');
		}else{
			$this->display('detail');
		}
	}
	//导出excel
	function expApply(){
		$aid=$_GET['aid'];
		$status=$_GET['status'];
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
			array('reason','申请理由'),   	array('position','申请岗位'),   	

        );
		$article = M("article")->where("id=".$aid)->find();
		
        
		$map['aid'] = array('eq',$aid);
		$map['status'] = array('eq',$status);
		$apply = M("apply")->where($map)->select();
		$this->studentInfoExport($apply);	
		
		if($status=="2"){
			$filename="审核通过列表".date('_Ymd');
			
			$xlsName  = "审核通过列表";
		}else if($status=="1"){
			$filename="待审核列表".date('_Ymd');
			
			$xlsName  = "待审核列表";
		}
		
		$this->exportExcel($filename,$xlsName,$xlsCell,$apply);
	
    }
}