<?php
/**
 * 公共Action
 *
 */
class CommonAction extends Action {

	public function _initialize() {
		
		//测试输出当前用户的权限的列表
		//dump($_SESSION[C('USER_AUTH_KEY')]["nodelist"]);
		
		//判断用户是否登录
		
    	if(!($_SESSION[C('USER_AUTH_KEY')]['id']>0)){
			$this->redirect('Public/login');
			return;
		}
		
	}	
	protected function studentInfo(&$list){
		$s=M("student");
		foreach($list as $k=>$v){
			$userinfo=$s->where("id={$v['sid']}")->find();
			//把对应的用户信息一起封装到list中
			$list[$k]['studentid']=$userinfo['studentid'];
			$list[$k]['idnumber']=$userinfo['idnumber'];
			$list[$k]['name']=$userinfo['name'];
			$list[$k]['sex']=$userinfo['sex']==1?"男":"女";
			$list[$k]['nation']=$userinfo['nation'];
			$list[$k]['address']=$userinfo['address'];
			$list[$k]['political']=$userinfo['political'];
			$list[$k]['income']=$userinfo['income'];
			$list[$k]['academy']=$userinfo['academy'];
			$list[$k]['professional']=$userinfo['professional'];
			$list[$k]['grade']=$userinfo['grade'];
			$list[$k]['tel']=$userinfo['tel'];
			$list[$k]['orphan']=$userinfo['orphan']==1?"是":"否";
			$list[$k]['singleparent']=$userinfo['singleparent']==1?"是":"否";
			$list[$k]['divorce']=$userinfo['divorce']==1?"是":"否";
			$list[$k]['disability']=$userinfo['disability']==1?"是":"否";
			$list[$k]['martyr']=$userinfo['martyr']==1?"是":"否";
			$list[$k]['dormitory']=$userinfo['dormitory'];
			$list[$k]['reward']=$userinfo['reward'];
			$list[$k]['support']=$userinfo['support'];
			$list[$k]['freetime']=$userinfo['freetime'];
		}
	}
	protected function studentInfoExport(&$list){
		$s=M("student");
		foreach($list as $k=>$v){
			$userinfo=$s->where("id={$v['sid']}")->find();
			//把对应的用户信息一起封装到list中
			$list[$k]['studentid']=' '.$userinfo['studentid'];
			$list[$k]['idnumber']=' '.$userinfo['idnumber'];
			$list[$k]['name']=$userinfo['name'];
			$list[$k]['sex']=$userinfo['sex']==1?"男":"女";
			$list[$k]['nation']=$userinfo['nation'];
			$list[$k]['address']=$userinfo['address'];
			$list[$k]['political']=$userinfo['political'];
			$list[$k]['income']=$userinfo['income'];
			$list[$k]['academy']=$userinfo['academy'];
			$list[$k]['professional']=$userinfo['professional'];
			$list[$k]['grade']=$userinfo['grade'];
			$list[$k]['tel']=' '.$userinfo['tel'];
			$list[$k]['orphan']=$userinfo['orphan']==1?"是":"否";
			$list[$k]['singleparent']=$userinfo['singleparent']==1?"是":"否";
			$list[$k]['divorce']=$userinfo['divorce']==1?"是":"否";
			$list[$k]['disability']=$userinfo['disability']==1?"是":"否";
			$list[$k]['martyr']=$userinfo['martyr']==1?"是":"否";
			$list[$k]['dormitory']=$userinfo['dormitory'];
			$list[$k]['reward']=$userinfo['reward'];
			$list[$k]['support']=$userinfo['support'];
			$list[$k]['freetime']=$userinfo['freetime'];
		}
	}
	protected function articleInfo(&$list){
		
		$s=M("article");
		foreach($list as $k=>$v){
			$articleinfo=$s->where("id={$v['aid']}")->find();
			//把对应的用户信息一起封装到list中
			$list[$k]['article']=$articleinfo;
			
		}
	}
	public function index() {
		
		//列表过滤器，生成查询Map对象
		$map = $this->_search();
		if(method_exists($this, '_filter')) {
			$this->_filter($map);
		}
		//判断采用自定义的Model类
		if(!empty($_POST["actionName"])){
			$model = D($_POST["actionName"]);
		}else{
			$model = M($this->getActionName());
		}
		
		if (!empty($model)) {
			$this->_list($model, $map);
		}
		$this->display();
		return;
	}
	
	
	public function add() {
		$this->display('add');
	}
	
	public function insert(){
		$model = D($this->getActionName());
		unset ( $_POST [$model->getPk()] );
		$_POST['userpass']=md5($_POST['userpass']);
		$_POST['ruserpass']=md5($_POST['ruserpass']);
		if (false === $model->create()) {
			$this->error($model->getError());
		}
		
		//保存当前数据对象
		if ($result = $model->add()) { //保存成功
			// 回调接口
			
			if (method_exists($this, '_tigger_insert')) {
				$model->id = $result;
				$this->_tigger_insert($model);
			}
			
			//成功提示
			$this->success(L('新增成功'));
		} else {
			//失败提示
			$this->error(L('新增失败').$model->getLastSql());
		}
		
	
	}
	
	public function edit() {
		$model = M($this->getActionName());
		$id = $_REQUEST[$model->getPk()];
		$vo = $model->find($id);
		$this->assign('vo', $vo);
		$this->display('edit');
	}
	
	public function update() {
		$model = D($this->getActionName());
		$_POST['userpass']=md5($_POST['userpass']);
		$_POST['ruserpass']=md5($_POST['ruserpass']);
		/*
		//用于事件处理
		if(in_array($this->getActionName(),$this->eventlist)){
			//保留一下原始数据
			$_POST["jsoninfo"]=$model->where("id=".$_POST['id'])->find();
			$_POST["jsoninfo"]["actionname"]=$this->getActionName();
		}
		*/
		
		if(false === $model->create()) {
			$this->error($model->getError());
		}
		// 更新数据
		if(false !== $model->save()) {
			// 回调接口
			if (method_exists($this, '_tigger_update')) {
				$this->_tigger_update($model);
			}
			//成功提示
			$this->success(L('更新成功'));
		} else {
			//错误提示
			$this->error(L('更新失败'));
		}
	}
	
	public function delete() {
		//删除指定记录
		$model = M($this->getActionName());
		if (!empty($model)) {
			$pk = $model->getPk();
			$id = $_REQUEST[$pk];
			if (isset($id)) {
				
				//用于事件处理
				//if(in_array($this->getActionName(),$this->eventlist)){
					//保留一下原始数据
				//	$_POST["jsoninfo"]=$model->where("id=".$id)->find();
				//	$_POST["jsoninfo"]["actionname"]=$this->getActionName();
				//}
				
				$condition = array($pk => array('in', explode(',', $id)));
				if (false !== $model->where($condition)->delete()) {
					$this->success(L('删除成功'));
				} else {
					$this->error(L('删除失败'));
				}
			} else {
				$this->error('非法操作');
			}
		}
	}
	
	//删除状态
	public function delete_tag(){
		//删除指定记录
		$model = M($this->getActionName());
		if (!empty($model)) {
			$pk = $model->getPk();
			$id = $_REQUEST[$pk];
			if (isset($id)) {
				
				//用于事件处理
				//if(in_array($this->getActionName(),$this->eventlist)){
					//保留一下原始数据
				//	$_POST["jsoninfo"]=$model->where("id=".$id)->find();
				//	$_POST["jsoninfo"]["actionname"]=$this->getActionName();
				//}
				
				$condition = array($pk => array('in', explode(',', $id)));
				if (false !== $model->where($condition)->setField('is_delete',1)) {
					$this->success(L('删除成功'));
				} else {
					$this->error(L('删除失败'));
				}
			} else {
				$this->error('非法操作');
			}
		}
	}
	
	/**
	 * 根据表单生成查询条件
	 * 进行列表过滤
	 * @param string $name 数据对象名称
	 * @return HashMap
	 */
	protected function _search($name='') {
		//生成查询条件
		if (empty($name)) {
			$name = $this->getActionName();
		}
		$model = M($name);
		$map = array();
		foreach ($model->getDbFields() as $key => $val) {
			if (substr($key, 0, 1) == '_')
				continue;
			if (isset($_REQUEST[$val]) && $_REQUEST[$val] != '') {
				$map[$val] = $_REQUEST[$val];
			}
		}
		return $map;
	}
	
	/**
	 * 根据表单生成查询条件
	 * 进行列表过滤
	 * @param Model $model 数据对象
	 * @param HashMap $map 过滤条件
	 * @param string $sortBy 排序
	 * @param boolean $asc 是否正序
	 */
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
	//添加事件信息方法；参数：1：事件类型（参考事件action类属性），2：实际内容
	protected function addEvent($type,$content,$jsoninfo=""){
		//获取当前登录者信息
		$data['cat_id']=$type; //事件类型（参考事件action类属性）
		$data["content"]=$content;
		$data["jsoninfo"]=$jsoninfo;
		$data["source"]=$_SESSION['user']['id'];
		$data["is_look"]=0;
		$data["add_time"]=time();
		//执行添加
		M("Event")->add($data);
	}
	public function forbid() {
		
		$name=$this->getActionName();
		$model = D ($name);
		$pk = $model->getPk ();
		$id = $_REQUEST [$pk];
		$condition = array ($pk => array ('in', $id ) );
		
		$list=$model->forbid ( $condition );
		
		if ($list!==false) {
			
			
			$this->success(L('状态禁用<!-- -->成功'));
		} else {
			$this->error  (  '状态禁用失败！' );
		}
	}
	function resume() {
		//恢复指定记录
		$name=$this->getActionName();
		$model = D ($name);
		$pk = $model->getPk ();
		$id = $_GET [$pk];
		$condition = array ($pk => array ('in', $id ) );
		if (false !== $model->resume ( $condition )) {
			
			$this->success(L('状态恢复成功'));
		} else {
			$this->error ( '状态恢复失败！' );
		}
	}
	/**
     +----------------------------------------------------------
     * Export Excel | 2013.08.23
     * Author:HongPing <hongping626@qq.com>
     +----------------------------------------------------------
     * @param $expTitle     string File name
     +----------------------------------------------------------
     * @param $expCellName  array  Column name
     +----------------------------------------------------------
     * @param $expTableData array  Table data
     +----------------------------------------------------------
     */
    public function exportExcel($fileName,$expTitle,$expCellName,$expTableData){
        $xlsTitle = iconv('utf-8', 'gb2312', $expTitle);//文件名称
       
        $cellNum = count($expCellName);
        $dataNum = count($expTableData);
        vendor("PHPExcel.PHPExcel");
		$cacheMethod = PHPExcel_CachedObjectStorageFactory::cache_to_phpTemp;
		$cacheSettings = array('memoryCacheSize'=>'16MB');
		PHPExcel_Settings::setCacheStorageMethod($cacheMethod, $cacheSettings);
        $objPHPExcel = new PHPExcel();
        $cellName = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ');
        
        $objPHPExcel->getActiveSheet(0)->mergeCells('A1:'.$cellName[$cellNum-1].'1');//合并单元格
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', $expTitle.'  Export time:'.date('Y-m-d H:i:s'));  
        for($i=0;$i<$cellNum;$i++){
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellName[$i].'2', $expCellName[$i][1]); 
        } 
          // Miscellaneous glyphs, UTF-8   
        for($i=0;$i<$dataNum;$i++){
          for($j=0;$j<$cellNum;$j++){
            $objPHPExcel->getActiveSheet(0)->setCellValue($cellName[$j].($i+3), $expTableData[$i][$expCellName[$j][0]]);
          }             
        }  
        
        header('pragma:public');
        header('Content-type:application/vnd.ms-excel;charset=utf-8;name="'.$xlsTitle.'.xls"');
        header("Content-Disposition:attachment;filename=$fileName.xls");//attachment新窗口打印inline本窗口打印
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  
        $objWriter->save('php://output');
		exit;
    }
     
   
	
}
?>