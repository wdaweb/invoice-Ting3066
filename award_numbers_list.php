<?php
include_once "base.php";

$sql="select * from award_numbers";
$award_numbers=$pdo->query($sql)->fetchALL();

// 若有查詢到獎號，開始執行以下程式判斷要顯示的資料，否則顯示"尚未建立任何一期獎號資料"
if(!empty($award_numbers)){
?>
<form action="search_award_numbers.php" class="container" method="post">
  <table class="table table-sm table-bordered">
    <tbody>
      <tr>
        <th>年月份</th>
        <td>
          <div class="row">
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
              //若是從此表單進行查詢，或從輸入獎號頁面過來帶有$_GET['pd']，則顯示輸入期別的獎號
              if(isset($_GET['pd']) && isset($_GET['year'])){
                echo "<div class='input-group input-group-sm col-4'>";
                echo "<input type='number' name='year' min=".(date('Y')-1)." max=".date('Y')." value=".$_GET['year']." class='form-control'>";  //預設值為輸入獎號的年份，查詢值最小為去年，最大為今年(因不會有未來獎號)
                echo "<div class='input-group-append'>";
                echo "<label class='input-group-text'>年</label>";
                echo "</div>";
                echo "</div>";
                echo "<div class='input-group input-group-sm col-4'>";
                echo "<select  class='custom-select' name='period'>";

                for($i=1;$i<7;$i++){
                  if($_GET['pd']==$i){
                    //6個期別中，與$_GET['pd']相等的便是輸入的期別，增加 selected='selected' 使他設為預設值
                    echo "<option selected='selected' value='".$_GET['pd']."'>".$period_mon[$_GET['pd']-1]."</option>";
                    
                  }else{
                    //與$_GET['pd']不相等的期別則成為下拉選單中的選項，不是預設值
                    echo "<option value='".$i."'>".$period_mon[$i-1]."</option>";
                    
                  }
                }

                //查詢資料庫，若有設$_GET['pd']與$_GET['year'，則以此做為欄位period與year的判斷值
                $sql="select * from award_numbers where period='{$_GET['pd']}' && year='{$_GET['year']}'";
                $awards=$pdo->query($sql)->fetchALL();
                
        
              //若不是在此表單進行查詢，或從輸入獎號以外的頁面過來，沒有$_GET['pd']，則顯示最新一期的年份與期別
              }else{  

                  //取得最新的年份與期數
                  $sql="select * from award_numbers order by year desc,period desc";
                  $awards=$pdo->query($sql)->fetch();
                  $year=$awards['year'];
                  $period=$awards['period'];
                  
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
                  
                  //查詢資料庫，若沒有設$_GET['pd']與$_GET['year'，則以$period (最新期別) 與$year (最近年份) 分別作為period與year的判斷值
                  $sql="select * from award_numbers where period='".$period."' && year='".$year."'";
                  $awards=$pdo->query($sql)->fetchALL();

                
              }

            ?>
              </select>
              <div class='input-group-append'>
                <label class='input-group-text'>月</label>
              </div>
            </div>
            <div class="input-group input-group-sm col-2">
              <button class="btn btn-sm btn-info" type="submit"><i class="fas fa-search"></i></button>  <!--查詢期別按鈕-->
            </div>
          </div>
        </td>
      </tr>
      <?php
          //利用foreach將資料庫查詢結果一一帶出，並將不同獎別的號碼給定特定變數
          foreach($awards as $award){
            switch($award['type']){
              case 1: //特別獎
                $special_prize=$award['number'];
              break;
              case 2: //特獎
                $grand_prize=$award['number'];
              break;
              case 3: //頭獎，有3組號碼，因此設為陣列
                $first_prize[]=$award['number'];
              break;
              case 4: //增開六獎，有1-3組號碼不等，因此設為陣列
                $add_six_prize[]=$award['number'];
              break;
            }
          }

      ?>
      <tr>
        <th rowspan=2>特別獎</th>
        <td class="font-weight-bolder h5">
          <?php
            if(!empty($special_prize)){
          ?>
          <span class="text-danger mr-2"><?=$special_prize;?></span>  
          <a href="index.php?do=edit_award_numbers.php&pd=<?=$award['period'];?>&year=<?=$award['year'];?>&type=1">
            <i class="fas fa-pen text-muted"></i>  <!--編輯按鈕-->
          </a>  
          <?php
            }else{
              echo "<span class='text-danger'>尚未輸入獎號</span>";
            }
          ?>
        </td>
      </tr>
      <tr>
        <td>同期統一發票收執聯8位數號碼與特別獎號碼相同者獎金1,000萬元</td>
      </tr>
      <tr>
        <th rowspan=2>特獎</th>
        <td class="font-weight-bolder h5">
          <?php
              if(!empty($grand_prize)){
          ?>
          <span class="text-danger mr-2"><?=$grand_prize;?></span>
          <a href="index.php?do=edit_award_numbers.php&pd=<?=$award['period'];?>&year=<?=$award['year'];?>&type=2">
            <i class="fas fa-pen text-muted"></i>  <!--編輯按鈕-->
          </a>
          <?php
            }else{
              echo "<span class='text-danger'>尚未輸入獎號</span>";
            }
          ?>
        </td>
      </tr>
      <tr>
        <td>同期統一發票收執聯8位數號碼與特獎號碼相同者獎金200萬元</td>
      </tr>
      <tr>
        <th rowspan=2>頭獎</th>
        <td class="font-weight-bolder h5">
          <?php
              if(!empty($first_prize)){
          ?>
          <div class="d-flex">
            <span class="text-danger mr-2">
            <?php
              //將陣列$first_prize內的獎號一一印出
              foreach($first_prize as $first){
                echo $first."<br>";
              }
            ?>
            </span>
            <a href="index.php?do=edit_award_numbers.php&pd=<?=$award['period'];?>&year=<?=$award['year'];?>&type=3">
              <i class="fas fa-pen text-muted"></i>  <!--編輯按鈕-->
            </a>
            <?php
            }else{
              echo "<span class='text-danger'>尚未輸入獎號</span>";
            }
            ?>
          </div>
        </td>
      </tr>
      <tr>
        <td>同期統一發票收執聯8位數號碼與頭獎號碼相同者獎金20萬元</td>
      </tr>
      <tr>
        <th>增開六獎</th>
        <td class="font-weight-bolder h5">
          <?php
              if(!empty($first_prize)){
          ?>
          <div class="d-flex">
            <span class="text-danger mr-2">
            <?php
              //將陣列$add_six_prize內的獎號一一印出
              foreach($add_six_prize as $six){
                echo $six."<br>";
              }
            ?>
            </span>
            <a href="index.php?do=edit_award_numbers.php&pd=<?=$award['period'];?>&year=<?=$award['year'];?>&type=4">
              <i class="fas fa-pen text-muted"></i>  <!--編輯按鈕-->
            </a>
            <?php
            }else{
              echo "<span class='text-danger'>尚未輸入獎號</span>";
            }
            ?>
          </div>
        </td>
      </tr>
    </tbody>
  </table>
</form>

<?php

  //取一筆資料，為了取得對獎及刪除連結網址上的變數
  $award=$pdo->query($sql)->fetch();
?>
<div>
  <button class="btn btn-info">
    <a href="index.php?do=reward.php&pd=<?=$award['period'];?>&year=<?=$award['year'];?>" class="text-decoration-none text-light">對獎</a>
  </button>
  <button class="btn btn-danger">
    <a href="index.php?do=del_award_numbers.php&pd=<?=$award['period'];?>&year=<?=$award['year'];?>" class="text-decoration-none text-light">刪除</a>
  </button>
</div>

<?php 
}else{
  echo "<span class='text-muted font-weight-bolder'>尚未建立任何一期獎號資料</span>";
}
?>