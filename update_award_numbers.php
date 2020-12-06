<?php
//更新編輯過的獎號資料
print_r($_POST);
include_once "base.php";

//先設一段字串，內容是不會變動的sql語句，以便下面的程式做運算
$sql="update award_numbers set `year`='{$_POST['year']}',`period`='{$_POST['period']}',";


//將傳來的POST資料進行獎號type的判斷
foreach($_POST as $prize => $number){
  switch($prize){  //input欄位的name

    //特別獎，type=1
    case "special_prize":
      $sql1=$sql."`number`='$number' where `type`='1' && `period`='{$_POST['period']}'";
      $pdo->exec($sql1);
    break;

    //特獎，typw=2
    case "grand_prize":
      $sql2=$sql."`number`='$number' where `type`='2' && `period`='{$_POST['period']}'";
      $pdo->exec($sql2);
    break;

    //頭獎，type=3
    case "first_prize":
      foreach($_POST['pre_first'] as $pre_first){
        $pre_first_prize[]=$pre_first;
      }
      foreach($_POST['first_prize'] as $first){
        $first_prize[]=$first;
      }
      for($i=0;$i<count($first_prize);$i++){
        $sql3=$sql."`number`='$first_prize[$i]' where `number`='$pre_first_prize[$i]' && `type`='3' && `period`='{$_POST['period']}'";
        $pdo->exec($sql3);
      }
    break;

    //增開六獎，type=4
    case "add_six_prize":
      foreach($_POST['pre_six'] as $pre_six){
        $pre_add_six_prize[]=$pre_six;
      }
      foreach($_POST['add_six_prize'] as $six){
        $add_six_prize[]=$six;
      }
      for($j=0;$j<count($add_six_prize);$j++){
        $sql4=$sql."`number`='$add_six_prize[$j]' where `number`='$pre_add_six_prize[$j]' && `type`='4' && `period`='{$_POST['period']}'";
        $pdo->exec($sql4);
        echo $sql4;
      }
    break;
    
  }
}

header("location:index.php?do=award_numbers_list.php&pd={$_POST['period']}&year={$_POST['year']}");
?>