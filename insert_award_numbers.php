<?php
//將輸入的獎號資料謝入資料表中

include_once "base.php";

//特別獎
$sql="insert into 
        award_numbers(`year`,`period`,`number`,`type`) 
      values
        ('{$_POST['year']}','{$_POST['period']}','{$_POST['special_prize']}','1')";
$pdo->exec($sql);


//特獎
$sql="insert into 
        award_numbers(`year`,`period`,`number`,`type`) 
      values
        ('{$_POST['year']}','{$_POST['period']}','{$_POST['grand_prize']}','2')";
$pdo->exec($sql);


//頭獎
foreach($_POST['first_prize'] as $first){
  if(!empty($first)){
    $sql="insert into
            award_numbers(`year`,`period`,`number`,`type`)
          values
          ('{$_POST['year']}','{$_POST['period']}','$first','3')";
    $pdo->exec($sql);
  }
}


//增開六獎
foreach($_POST['add_six_prize'] as $six){
  if(!empty($six)){
    $sql="insert into
            award_numbers(`year`,`period`,`number`,`type`)
          values
          ('{$_POST['year']}','{$_POST['period']}','$six','4')";
    $pdo->exec($sql);
  }
}


header("location:index.php?do=award_numbers_list.php&pd=".$_POST['period']."&year=".$_POST['year']);
?>