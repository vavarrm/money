<?php
	

	$UserRoot = Array(
		 '0'=>Array(
			'0'=>Array('id'=>1, 'parentid'=>'',  'title'=>'1������'),
			'1'=>Array('id'=>2, 'parentid'=>0, 'title'=>'��ع���'),
			'2'=>Array('id'=>3, 'parentid'=>1, 'title'=>'��ع���Ա'),
			'3'=>Array('id'=>4, 'parentid'=>1, 'title'=>'��ز���Ա'),
			'4'=>Array('id'=>5, 'parentid'=>0, 'title'=>'�������'),
		  ),
		 '1'=>Array(
			'0'=>Array('id'=>1, 'parentid'=>0, 'title'=>'�������'),
			'1'=>Array('id'=>2, 'parentid'=>1, 'title'=>'1�����������޸�'),
			'2'=>Array('id'=>3, 'parentid'=>3, 'title'=>'2����Ŀ�޸�'),
			'3'=>Array('id'=>4, 'parentid'=>0, 'title'=>'��Ŀ����'),
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