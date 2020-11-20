<?php
include_once "base.php";


$array=['欄位1'=>'值1','欄位2'=>'值2','id'=>'9'];

//利用暫時的陣列存放語句
foreach($array as $key => $value){
  $tmp[]=sprintf("`%s`='%s'",$key,$value);
  // $tmp[]="`".$key."`='".$value."'";

}
//使用implode將陣列中的語句串成語法
echo implode(" && ",$tmp);
echo "<br>";



function find($table,$id){
  global $pdo;
  //判斷id是否為數字
  if(is_array($id)){

    foreach($id as $key => $value){
      $tmp[]=sprintf("`%s`='%s'",$key,$value);
      // $tmp[]="`".$key."`='".$value."'";
    }

    $sql="select * from $table where ".implode(" && ",$tmp);
  }else{
    $sql="select * from $table where id='$id'";
    
  }

  $row=$pdo->query($sql)->fetch();
  return $row;

}


$row=find('invoices',8);
echo $row['code'].$row['number']."<br>";

$row=find('invoices',['code'=>'KJ','number'=>'33236629']);
echo $row['code'].$row['number']."<br>";

$row=find('invoices',19);
echo $row['code'].$row['number'];

?>