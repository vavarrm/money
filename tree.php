<?php
	

	$UserRoot = Array(
		 '0'=>Array(
			'0'=>Array('id'=>1, 'parentid'=>'',  'title'=>'1级管理'),
			'1'=>Array('id'=>2, 'parentid'=>0, 'title'=>'风控管理'),
			'2'=>Array('id'=>3, 'parentid'=>1, 'title'=>'风控管理员'),
			'3'=>Array('id'=>4, 'parentid'=>1, 'title'=>'风控操作员'),
			'4'=>Array('id'=>5, 'parentid'=>0, 'title'=>'密码管理'),
		  ),
		 '1'=>Array(
			'0'=>Array('id'=>1, 'parentid'=>0, 'title'=>'密码管理'),
			'1'=>Array('id'=>2, 'parentid'=>1, 'title'=>'1级管理密码修改'),
			'2'=>Array('id'=>3, 'parentid'=>3, 'title'=>'2级栏目修改'),
			'3'=>Array('id'=>4, 'parentid'=>0, 'title'=>'栏目管理'),
		  )  
	);
	UserSub($UserRoot);
	function UserSub($UserRoot, $parentid=0)
	{
		$tree = array();
		foreach($UserRoot as $key=>$val)
		{
			foreach($val as $k=>$v)
			{
				if($v['parentid'] == $parentid)
				{
					$tree[] = $v;
					UserSub($UserRoot, $v['id']);
				}
			}
		}
		return $tree ;
	}
?>