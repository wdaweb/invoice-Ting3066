<?php
include_once "base.php";



function find($table,$id){
  global $pdo;

  if(is_numeric($id)){
    $sql="select * from $table where id='$id'";
    
    
  }else{
    $sql="select * from $table where $id";
    
  }

  $row=$pdo->query($sql)->fetch();
  return $row;

}
// function find2($table,$def){
//   global $pdo;
//   $sql="select * from $table where $def";
//   $row=$pdo->query($sql)->fetch();
//   return $row;
// }

$row=find('invoices',8);
echo $row['code'].$row['number']."<br>";

$row=find('invoices',"code='KJ' && number='33236629'");
echo $row['code'].$row['number']."<br>";

$row=find('invoices',19);
echo $row['code'].$row['number'];

?>