<?php
	$handle = fopen('ary_str.php', "r");
	$str  = fgets($handle);
	fclose($handle);
	$ymd =(isset($_GET['ymd']))?$_GET['ymd']:date('Ymd');
	
	$filename =$ymd.'.csv';
	header("Content-type: text/x-csv");
	header("Content-Disposition: attachment; filename=$filename");
	for($i=0;$i<=179;$i+=5)
	{
		if($i%5==0)
		{
			if($i==0)
			{
				continue;
			}
			$issue =$ymd.sprintf('%03d', $i);	
			// echo $issue;
			$row = getMyDecode($issue, $str);
			$total = array_sum($row);
			
			$csv_str=  (string)$issue.",".join(",", $row);
			
			if($total>810)
			{
				$bigsmail ="大";
			}elseif($total<810)
			{
				$bigsmail ="小";
			}else{
				$bigsmail ='和';
			}
			
			$tsd = ($total%2==1)?'单':'双' ;
			
			
			$u =0;
			$d =0;
			$cs =0;
			$cd = 0;
			
			foreach($row as $value)
			{
			
				if($value <=40)
				{
					$u+=1;
				}else
				{
					$d+=1;
				}
				
				
				if($value %2 ==1)
				{
					$cs +=1;
				}else{
					$cd +=1;
				}
			}
			
			if($u > $d)
			{
				$ud ="上";
			}elseif($u > $d)
			{
				$ud ="下";
			}else
			{
				$ud ="中";
			}
			
			if($cs > $cd)
			{
				$csd ="奇";
			}elseif($cd > $cs)
			{
				$csd ="偶";
			}else
			{
				$csd ="和";
			}
			
			// echo $ud;
			
			$csv_str.=",".$bigsmail.",".$tsd.",".$ud .",".$csd.",".$total;
			echo $csv_str;
			echo "\r\n";

		}
		

	}

	// $temp = getRandAry();
	// $str = base64_encode(serialize($temp));
	// $file = fopen("ary","w+"); //開啟檔案
	// fwrite($file,$str);
	// fclose($file);
	
	function getRandAry()
	{
		$arr = array();
		for($i=1;$i<=80;$i++)
		{
			$arr[] = sprintf('%02d', $i);
		}
		
		$temp =array();
		
		for($i=0; $i<=30 ;$i++)
		{
			for($j=1;$j<=35;$j++)
			{
				shuffle($arr);
				$temp[$i][$j] =$arr;
			}
		}
		return $temp;
	}

	function getMyDecode($issue="" , $str)
	{
		$str = base64_decode($str);
		$arys = unserialize($str);
		$number = substr($issue, 8, 3);
		$number_str = $number/5;
		
		$date = substr($issue, 0, 8);
		$w =date("w" ,strtotime($date));
		$arr_get = 0;
		for($i=0;$i<8;$i++)
		{
			$arr_get+= substr($issue, $i, 1);
		}
		$arr_get +=$w;
		
		$day = substr($issue, 6, 2);
		$day_str = $day%31;
		
		$ary= $arys[$day_str][$number_str]  ;
		$temp = array();
		for($i=1;$i<=20;$i++)
		{
			$temp[] =$ary[$arr_get];
			unset($ary[$arr_get]);
			$ary = array_values($ary);
		}
		sort($temp);
		return $temp;
	}
?>