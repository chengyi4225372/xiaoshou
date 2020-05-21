<?php
//造连接对象：造一个mysql对象
function file_get_contents_by_curl($url){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_HEADER,0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);//禁止调用时就输出获取到的数据
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,false);
	$result = curl_exec($ch);
	curl_close($ch);return $result;

}
function DeleteHtml($str) 
{ 
	$str = strip_tags($str);  
    $str = trim($str); //清除字符串两边的空格
    $str = strip_tags($str,""); //利用php自带的函数清除html格式
    $str = preg_replace("/\t/","",$str); //使用正则表达式替换内容，如：空格，换行，并将替换为空。
    $str = preg_replace("/\r\n/","",$str); 
    $str = preg_replace("/\r/","",$str); 
    $str = preg_replace("/\n/","",$str); 
    $str = preg_replace("/ /","",$str);
    $str = preg_replace("/  /","",$str);  //匹配html中的空格
    return trim($str); //返回字符串
}
header('Content-Type: text/html; charset=utf-8');
error_reporting(0);
$link = mysql_connect('localhost', 'www9nwcc', 'www9nwcc');
if(!$link){
	die('数据库链接失败：'.mysql_error());
}
mysql_query('set names utf8');
    mysql_select_db('www9nwcc');
//准备一条SQL语句

$sql = "select * from dd_anime ";

//执行sql语句，如果是查询语句，成功返回结果集对象；如果不是，成功执行为true，执行失败为false

$reslut =mysql_query($sql);

//判断返回是否执行成功


 while($row=mysql_fetch_array($reslut)) {
	 $data[]=$row;
 }


$dir ="/www/wwwroot/9niu.wang/Public/upload/book22/"; 	  
$filesnames = scandir($dir); //得到所有的文件		
//var_dump($filesnames );exit;
/*
foreach ($filesnames as $name) {
	if($name != "." && $name != ".."){
		//$newname=time().mt_rand();
		$newname = date('Ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
		rename($dir.$name,$dir.$newname.'.jpg');
	}
}
exit;
foreach($data as $v){
	$epdata="";
	//echo basename($v['coverpic']);exit;
	//$coverpic="./Public/upload/book/".basename($v['coverpic']);
	//$areas=rand(1,4);
	$sql = "select count(*) as num  from dd_anime_chapter  where anid=".$v['id'];
	$reslut =mysql_query($sql);
	 while($row=mysql_fetch_array($reslut)) {
		$epdata[]=$row;
	}
	//var_dump($epdata);
	//$sq1sd='UPDATE `dd_anime` set `coverpic`="'.$coverpic.'",`infopic`="'.$coverpic.'",`selectpic`="'.$coverpic.'" where id= '.$v['id'];
	$sq1sd='UPDATE `dd_anime` set `allchapter`='.$epdata[0]['num'].' where id= '.$v['id'];
		//	echo $sq1sd;exit;
			if (!mysql_query($sq1sd,$link)){
				die('Error: ' . mysql_error());
			}
	

}
	*/	
?>