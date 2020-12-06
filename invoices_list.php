<?php
//發票管理頁面
include_once "base.php";

$sql="select * from invoices";
$invoices=$pdo->query($sql)->fetchALL();

if(!empty($invoices)){
?>
<form action="search_invoices.php" class="container" method="post">
  <div class="d-flex justify-content-center mb-3">
    <?php

      $period_mon=[
        '01~02',
        '03~04',
        '05~06',
        '07~08',
        '09~10',
        '11~12'
      ];
      //查詢欄預設值的設定
      //若是從此表單進行查詢，或從新增發票頁面過來帶有$_GET['pd']，則顯示輸入期別的發票資料
      if(isset($_GET['pd']) && isset($_GET['year'])){
        $year=$_GET['year'];
        $period=$_GET['pd'];
        echo "<div class='input-group input-group-sm col-4'>";
        echo "<input type='number' name='year' min=".(date('Y')-1)." max=".date('Y')." value=".$year." class='form-control'>";  //預設值為輸入獎號的年份，查詢值最小為去年，最大為今年(因不會有未來獎號)
        echo "<div class='input-group-append'>";
        echo "<label class='input-group-text'>年</label>";
        echo "</div>";
        echo "</div>";
        echo "<div class='input-group input-group-sm col-4'>";
        echo "<select  class='custom-select' name='period'>";

        for($i=1;$i<7;$i++){
          if($period==$i){
            //6個期別中，與$_GET['pd']相等的便是輸入的期別，增加 selected='selected' 使他設為預設值
            echo "<option selected='selected' value='$period'>{$period_mon[$period-1]}</option>";
            
          }else{
            //與$_GET['pd']不相等的期別則成為下拉選單中的選項，不是預設值
            echo "<option value='".$i."'>".$period_mon[$i-1]."</option>";
            
          }
        }

        //查詢資料庫，若有設$_GET['pd']與$_GET['year'，則以此做為欄位period與date年份的判斷值
        $sql="select * from invoices where period='$period' && left(date,4)='$year' order by date desc,id desc";
        $invs=$pdo->query($sql)->fetchALL();
        

      //若不是在此表單進行查詢，或從新增發票以外的頁面過來，沒有$_GET['pd']，則顯示最新一期的年份與期別
      }else{  

          //取得最新的年份與期數
          $sql="select * from invoices order by date desc,period desc";
          $invs=$pdo->query($sql)->fetch();
          $year=explode('-',$invs['date'])[0];
          $period=$invs['period'];
          
          echo "<div class='input-group input-group-sm col-4'>";
          echo "<input type='number' name='year' min=".(date('Y')-1)." max=".date('Y')." value=".$year." class='form-control'>";  //預設值為最近年份，不一定在去年或今年(可能中間某幾期沒有對獎)，但查詢值最小為去年，最大為今年
          echo "<div class='input-group-append'>";
          echo "<label class='input-group-text'>年</label>";
          echo "</div>";
          echo "</div>";
          echo "<div class='input-group input-group-sm col-4'>";
          echo "<select  class='custom-select' name='period'>";

          for($j=0;$j<6;$j++){
            if($period==($j+1)){
              //若$period與($j+1)相等 (因$j的起始值為0，所以必須加一)，則增加 selected='selected' 使他設為預設值
              echo "<option selected='selected' value='".$period."'>".$period_mon[$j]."</option>";

            }else{
              //不相等的期別則成為下拉選單中的選項，不是預設值
              echo "<option value='".($j+1)."'>".$period_mon[$j]."</option>";
              
            }
          }
          
          //查詢資料庫，若沒有設$_GET['pd']與$_GET['year'，則以$period (最新期別) 與$year (最近年份) 分別作為period與date年份的判斷值
          $sql="select * from invoices where period='$period' && left(date,4)='$year' order by date desc,id desc";
          $invs=$pdo->query($sql)->fetchALL();

        
      }

    ?>
      </select>
      <div class='input-group-append'>
        <label class='input-group-text'>月</label>
      </div>
      <div class="input-group input-group-sm col-2">
        <button class="btn btn-sm btn-info" type="submit"><i class="fas fa-search"></i></button>
      </div>
    </div>
  </div>
</form>

<table class="table table-borderless table-hover text-center text-muted">
  <tr class="font-weight-bolder bg-secondary text-light">
    <td>發票號碼</td>
    <td>發票金額</td>
    <td>消費日期</td>
    <td>管理</td>
  </tr>

  <?php
  foreach($invs as $inv){
  
  ?>
  <tr>
    <td><?=$inv['code'].$inv['number'];?></td>
    <td><?=$inv['payment'];?></td>
    <td><?=$inv['date'];?></td>
    <td>
      <button class="btn btn-sm btn-primary">
        <a href="?do=edit_invoices.php&id=<?=$inv['id'];?>&period=<?=$period;?>&year=<?=$year;?>" class="text-decoration-none text-light"><i class="fas fa-edit"></i></a>  <!-- 發票編輯功能 -->
      </button>
      <button class="btn btn-sm btn-danger">
        <a href="?do=del_invoices.php&id=<?=$inv['id'];?>&period=<?=$period;?>&year=<?=$year;?>" class="text-decoration-none text-light"><i class="fas fa-trash-alt"></i></a> <!-- 發票刪除功能 -->
      </button>
    </td>
  </tr>
  <?php
  }

  ?>
</table>


<?php 
}else{
  echo "<span class='text-muted font-weight-bolder'>尚未建立任何一期獎號資料</span>";
}
?>


