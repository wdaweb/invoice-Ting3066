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
echo $period_str[$_GET['period']]."的發票<br>";

//撈出該期的發票
$sql_invs="select * from invoices where period='{$_GET['period']}' && left(date,4)='{$_GET['year']}' order by date desc";
$invoices=$pdo->query($sql_invs)->fetchALL();
// echo count($invoices);




//撈出該期的開獎獎號
$sql_awards="select * from award_numbers";
$awards=$pdo->query($sql_awards)->fetchALL();

//開始對獎
$all_res=-1;
foreach($invoices as $invoice){
  foreach($awards as $award){
    if($award['period']==$_GET['period'] && $award['year']==$_GET['year']){
      switch($award['type']){
        case 1:
          //特別獎號=我的發票號碼
          if($award['number']==$invoice['number']){
            echo "<br>號碼=".$invoice['number']."<br>";
            echo "中了特別獎<br>";
            $all_res=1;
          }
  
        break;
        case 2:
          //特獎
          if($award['number']==$invoice['number']){
            echo "<br>號碼=".$invoice['number']."<br>";
            echo "中了特獎<br>";
            $all_res=1;
          }
  
        break;
        case 3:
          //頭獎
          $res=-1;
          for($i=5;$i>=0;$i--){
            $target=mb_substr($award['number'],$i,(8-$i),'utf8');
            $mynumber=mb_substr($invoice['number'],$i,(8-$i),'utf8');

            if($target==$mynumber){
                
                $res=$i;
            }else{
                break;
            }
          }
          //判斷最後中的獎項
          if($res!=-1){
            echo "<br>號碼=".$invoice['number']."<br>";
            echo "中了{$awardStr[$res]}獎<br>";
            $all_res=1;
          }
          
        break;
        case 4:
          if($award['number']==mb_substr($invoice['number'],5,3,'utf8')){
            echo "<bre>號碼=".$invoice['number']."<br>";
            echo "中了增開六獎";
            $all_res=1;
  
          }
  
        break;
  
      }
    }
  }
}

if(!($award['period']==$_GET['period'] && $award['year']==$_GET['year'])){
  echo "該期尚未開獎";
}else if($all_res==-1){
  echo "很可惜，都沒有中";
}


// echo "<pre>";
// print_r($invoices);
// echo "</pre>";

?>
