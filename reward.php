<?php
//對獎頁面

//一次對所有發票

include_once "base.php";



  //取出所有該期發票號碼
  $sql_invoices="select * from invoices where period='{$_GET['pd']}' && left(date,4)='{$_GET['year']}'";
  $invoices=$pdo->query($sql_invoices)->fetchALL();
  
  //取出該期獎號
  $sql_awards="select * from award_numbers where period='{$_GET['pd']}' && year='{$_GET['year']}'";
  $awards=$pdo->query($sql_awards)->fetchALL();

  
  $all_res=-1;
  $sum=0;
  if(!empty($invoices) && !empty($awards)){
    echo "<table class='w-75 table table-striped text-center text-muted'>";
    echo "<tr class='bg-secondary text-light'>";
    echo "<th>";
    echo "中獎發票";
    echo "</th>";
    echo "<th>";
    echo "獎項";
    echo "</th>";
    echo "<th>";
    echo "中獎金額";
    echo "</th>";
    echo "</tr>";
    
    foreach($invoices as $inv){
      foreach($awards as $award){
        switch($award['type']){
          case 1: //特別獎，號碼全中
            if($award['number']==$inv['number']){
              echo "<tr>";
              echo "<td>";
              echo $inv['code']." <span class='text-danger'>".$inv['number']."</span>";
              echo "</td>";
              echo "<td>";
              echo "特別獎";
              echo "</td>";
              echo "<td>";
              echo "10,000,000";
              echo "</td>";
              echo "</tr>";
              $all_res=1;
              $sum=$sum+10000000;  //中獎時累計金額
            }
          break;
          case 2: //特獎，號碼全中
            if($award['number']==$inv['number']){
              echo "<tr>";
              echo "<td>";
              echo $inv['code']." <span class='text-danger'>".$inv['number']."</span>";
              echo "</td>";
              echo "<td>";
              echo "特獎";
              echo "</td>";
              echo "<td>";
              echo "2,000,000";
              echo "</td>";
              echo "</tr>";
              $all_res=1;
              $sum=$sum+2000000;  //中獎時累計金額
            }
          break;
          case 3: //頭獎，依中獎號碼數決定獎項
            $res=-1;
            for($i=5;$i>=0;$i--){
              $target=mb_substr($award['number'],$i,(8-$i),'utf8');
              $mynumber=mb_substr($inv['number'],$i,(8-$i),'utf8');
              if($target==$mynumber){
                  switch($i){    //根據不同獎項有不同的中獎金額
                    case 5: //六獎
                      $money=200;
                    break;
                    case 4: //五獎
                      $money=1000;
                    break;
                    case 3: //四獎
                      $money=4000;
                    break;
                    case 2: //三獎
                      $money=10000;
                    break;
                    case 1: //二獎
                      $money=40000;
                    break;
                    case 0: //頭獎
                      $money=200000;
                    break;
                  }
                $res=$i;
              }else{
                break;
              }
            }
  
            //判斷最後中的獎項
            $awardStr=['頭','二','三','四','五','六'];
            if($res!=-1){
              echo "<tr>";
              echo "<td>";
              echo $inv['code']." ".mb_substr($inv['number'],0,$res,'utf8')."<span class='text-danger'>".mb_substr($inv['number'],$res,(8-$res),'utf8')."</span>";  //呈現紅色的數字代表對中的數字
              echo "</td>";
              echo "<td>";
              echo $awardStr[$res]."獎";
              echo "</td>";
              echo "<td>";
              echo number_format($money);
              echo "</td>";
              echo "</tr>";
              $all_res=1;
              $sum=$sum+$money;  //中獎時累計金額
            }
          break;
          case 4:
            if($award['number']==mb_substr($inv['number'],5,3,'utf8')){
              echo "<tr style='border-bottom:2px solid'>";
              echo "<td>";
              echo $inv['code']." ".mb_substr($inv['number'],0,5,'utf8')."<span class='text-danger'>".mb_substr($inv['number'],5,3,'utf8')."<span>";  //呈現紅色的數字代表對中的數字
              echo "</td>";
              echo "<td>";
              echo "增開六獎";
              echo "</td>";
              echo "<td>";
              echo "200";
              echo "</td>";
              echo "</tr>";
              $all_res=1;
              $sum=$sum+200;  //中獎時累計金額
            }
  
  
        }
      }
      
    }
    if($all_res==-1){
      echo "</table>";
      echo "很可惜，都沒有中獎";
    }else{
      echo "<tr style='background:#fbfbfb'>";
      echo "<th colspan=2>總計</th>";
      echo "<th>".number_format($sum)."</th>";
      echo "</tr>";
    }
    echo "</table>";
  
  }else{
    if(empty($invoices)){
      echo "<span class='text-muted font-weight-bolder'>沒有需要對獎的發票號碼<span>";
    }else if(empty($awards)){
      echo "<span class='text-muted font-weight-bolder'>尚未開獎，或者還沒輸入獎號!<span>";
    }
  }
  







?>