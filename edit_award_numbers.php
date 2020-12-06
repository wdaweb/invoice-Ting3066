<?php
include_once "base.php";
$period=$_GET['pd'];
$year=$_GET['year'];

//取得所有符合年份與期別的獎號資料
$sql="select * from award_numbers where `period`='$period' && `year`='$year'";
$awards=$pdo->query($sql)->fetchAll();

//對不同獎項的獎號指定變數
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

//以期別為索引值得到月份
$period_mon=[
  '01~02',
  '03~04',
  '05~06',
  '07~08',
  '09~10',
  '11~12'
];

?>

<form action="update_award_numbers.php" method="post" class="container">

  <!--因為頭獎與增開六獎各有三個欄位，為了在update_award_numbers中得到還沒修改前的獎號資料而設置的隱藏欄位，藉此得知修改的是哪一欄位-->
  <input type="hidden" name="pre_first[]" value="<?= $first_prize[0]?>">
  <input type="hidden" name="pre_first[]" value="<?= $first_prize[1]?>">
  <input type="hidden" name="pre_first[]" value="<?= $first_prize[2]?>">
  <input type="hidden" name="pre_six[]" value="<?= $add_six_prize[0]?>">
  <input type="hidden" name="pre_six[]" value="<?= $add_six_prize[1]?>">
  <input type="hidden" name="pre_six[]" value="<?= $add_six_prize[2]?>">
  
  <table class="table table-sm table-bordered">
    <tbody>
      <tr>
        <th>年月份</th>
        <td>
        <div class="row">
          <div class="input-group input-group-sm col-4">
            <input type="number" value="<?=$_GET['year'];?>" name="year" min="<?=date("Y")-1;?>" max="<?=date("Y")+1;?>" class="form-control" disabled> <!--在編輯獎號時，無法編輯已經選定的年份-->
            <input type="hidden" value="<?=$_GET['year'];?>" name="year" min="<?=date("Y")-1;?>" max="<?=date("Y")+1;?>" class="form-control">  <!--因為disabled屬性會造成欄位無法傳值，因此再製造一個隱藏的欄位用以傳值-->
            <div class="input-group-append">
              <span class="input-group-text">年</span>
            </div>
          </div>
          <div class='input-group input-group-sm col-4'>
          
          <!--在編輯獎號時，無法編輯已經選定的期別-->
          <select class='custom-select' name='period' disabled>
          <?php
            for($i=1;$i<7;$i++){
              if($_GET['pd']==$i){
                //6個期別中，與$_GET['pd']相等的便是傳來的期別，增加 selected='selected' 使他設為預設值
                echo "<option selected='selected' value='".$_GET['pd']."'>".$period_mon[$_GET['pd']-1]."</option>";
                
              }else{
                //與$_GET['pd']不相等的期別則成為下拉選單中的選項，不是預設值
                echo "<option value='".$i."'>".$period_mon[$i-1]."</option>";
                
              }
            }
          ?>
          </select>

          <!--因為disabled屬性會造成欄位無法傳值，因此再製造一個隱藏的欄位用以傳值，select選單無法使用hidden屬性，替代方案為display:none-->
          <select style="display:none" class='custom-select' name='period'>
          <?php
            for($i=1;$i<7;$i++){
              if($_GET['pd']==$i){
                //6個期別中，與$_GET['pd']相等的便是傳來的期別，增加 selected='selected' 使他設為預設值
                echo "<option selected='selected' value='".$_GET['pd']."'>".$period_mon[$_GET['pd']-1]."</option>";
                
              }else{
                //與$_GET['pd']不相等的期別則成為下拉選單中的選項，不是預設值
                echo "<option value='".$i."'>".$period_mon[$i-1]."</option>";
                
              }
            }
          ?>
          </select>


            <div class='input-group-append'>
            <label class='input-group-text'>月</label>
            </div>
          </div>
        </div>
        </td>
      </tr>
      <tr>
        <th rowspan=2>特別獎</th>
            <?php
              if($_GET['type']=='1'){
            ?>
            <td>
            <div class="input-group input-group-sm w-25">
            <input type="number" name="special_prize" value="<?=$special_prize;?>" min="00000001" max="99999999" class="form-control" required>
            </div>
            <?php    
              }else{
            ?>
            <td class="text-danger font-weight-bolder h5"><?=$special_prize;?>
            <?php
              }
            ?>
              
        </td>
      </tr>
      <tr>
        <td>同期統一發票收執聯8位數號碼與特別獎號碼相同者獎金1,000萬元</td>
      </tr>
      <tr>
        <th rowspan=2>特獎</th>
        <?php
              if($_GET['type']=='2'){
        ?>
        <td>
        <div class="input-group input-group-sm w-25">
        <input type="number" name="grand_prize" value="<?=$grand_prize;?>" min="00000001" max="99999999" class="form-control" required>
        </div>
        <?php    
          }else{
        ?>
        <td class="text-danger font-weight-bolder h5"><?=$grand_prize;?>
        <?php
          }
        ?>
              
      </tr>
      <tr>
        <td>同期統一發票收執聯8位數號碼與特獎號碼相同者獎金200萬元</td>
      </tr>
      <tr>
        <th rowspan=2>頭獎</th>
        <?php
        if($_GET['type']=='3'){
        ?>
        <td>
        <div class="row">
            <?php
          //將陣列$first_prize內的獎號一一印出
          foreach($first_prize as $first){
            echo "<div class='input-group input-group-sm pr-0 col-3'>";
            echo "<input type='number' name='first_prize[]' value='$first' min='00000001' max='99999999' class='form-control' required>";
            echo "</div>";
          }
          echo "</td>";
        }else{
          echo "<td class='text-danger font-weight-bolder h5'>";
          foreach($first_prize as $first){
            echo $first;
            echo "<br>";
          }
          echo "</td>";
        }
        ?>
      </tr>
      <tr>
        <td>同期統一發票收執聯8位數號碼與頭獎號碼相同者獎金20萬元</td>
      </tr>
      <tr>
        <th>增開六獎</th>
        <?php
        if($_GET['type']=='4'){
        ?>
        <td>
        <div class="row">
            <?php
          //將陣列$first_prize內的獎號一一印出
          foreach($add_six_prize as $six){
            echo "<div class='input-group input-group-sm pr-0 col-3'>";
            echo "<input type='number' name='add_six_prize[]' value='$six' min='00000001' max='99999999' class='form-control' required>";
            echo "</div>";
          }
          echo "</td>";
        }else{
          echo "<td class='text-danger font-weight-bolder h5'>";
          foreach($add_six_prize as $six){
            echo $six;
            echo "<br>";
          }
          echo "</td>";
        }
        ?>
      </tr>
      
    </tbody>
  </table>
  <div class="text-center">
    <button type="submit" class="btn btn-info">修改</button>
    <button type="reset" class="btn btn-warning">重置</button>
  </div>

</form>