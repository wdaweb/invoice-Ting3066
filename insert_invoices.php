<?php
//將輸入的發票資料寫入資料庫

include_once "base.php";

$sql="insert into invoices(`date`,`code`,`period`,`payment`,`number`) values('{$_POST['date']}','{$_POST['code']}','{$_POST['period']}','{$_POST['payment']}','{$_POST['number']}')";
$pdo->exec($sql);

$sql="select * from invoices where `period`='{$_POST['period']}' order by id desc";
$inv=$pdo->query($sql)->fetch();
$year=explode('-',$inv['date'])[0];

header("location:index.php?do=invoices_list.php&pd={$_POST['period']}&year=$year");


?>