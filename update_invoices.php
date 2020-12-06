<?php
//更新編輯過的發票資料

include_once "base.php";

$sql="update invoices set `code`='{$_POST['code']}',`number`='{$_POST['number']}',`payment`='{$_POST['payment']}',`date`='{$_POST['date']}' where `id`='{$_POST['id']}'";
$pdo->exec($sql);
header("location:index.php?do=invoices_list.php&pd={$_POST['period']}&year={$_POST['year']}");
?>