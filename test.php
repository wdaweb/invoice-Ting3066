<?php
include_once "base.php";

find('invoices',"id='9'");

function find($table,$def){
  global $pdo;
  $sql="select * from $table where $def";
  $row=$pdo->query($sql)->fetch();
  return $row;
}

?>