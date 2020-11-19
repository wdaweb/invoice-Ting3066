<?php
include_once "base.php";

$period_str=[
  1=>'1,2月',
  2=>'3,4月',
  3=>'5,6月',
  4=>'7,8月',
  5=>'9,10月',
  6=>'11,12月'
];
echo "你要對的發票是".$_GET['year']."年";
echo $period_str[$_GET['period']]."的發票";

//撈出該期的發票
$sql_invs="select * from invoices where period='{$_GET['period']}' && left(date,4)='{$_GET['year']}' order by date desc";
$invoices=$pdo->query($sql_invs)->fetchALL();
echo count($invoices);




//撈出該期的開獎獎號
$sql_awards="select * from award_numbers";
$awards=$pdo->query($sql_awards)->fetchALL();

foreach($awards as $award){
  if($award['period']==$_GET['period'] && $award['year']==$_GET['year']){
    echo "該期獎號為:".$award['number'];
  }else{
    echo "該期尚未開獎";
  }
}







// echo "<pre>";
// print_r($invoices);
// echo "</pre>";





?>

單期全部對獎