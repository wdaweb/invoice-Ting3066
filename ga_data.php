<?php
include_once "base.php";


//rand()

$codeBase=["AB","FF","GD","KJ","FJ","IY"];
echo "資料產生中......";
echo date("Y-m-d H:i:s");
for($i=0;$i<10000;$i++){

  //產生8位數亂數，若不滿八位，在最前方補零
  $code=$codeBase[rand(0,5)];
  $number=sprintf("%08d",rand(0,99999999));
  // echo str_pad($number,8,'0',STR_PAD_LEFT)."<br>";
  // echo $number."<br>";



  //產生消費金額
  $payment=rand(1,20000);

  //產生日期
  $start=strtotime("2020-01-01");
  $end=strtotime("2020-12-31");
  $date=date("Y-m-d",rand($start,$end));
  // echo $date."<br>";
  
  $period=ceil(explode("-",$date)[1]/2);

  $hope=[
    'code'=>$code,
    'number'=>$number,
    'date'=>$date,
    'payment'=>$payment,
    'period'=>$period
  
  ];

  $sql="insert into invoices (`".implode("`,`",array_keys($hope))."`) values('".implode("','",($hope))."')";
  $pdo->exec($sql);
}

echo "<hr>";
echo "資料產生完成......";
echo date("Y-m-d H:i:s");

?>