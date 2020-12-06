<?php
//發票編輯功能
include_once "base.php";

//取得所有符合年份與期別的發票資料，並按照日期由新至舊排序
$sql="select * from invoices where `period`='{$_GET['period']}' && left(date,4)='{$_GET['year']}' order by date desc,id desc";
$invs=$pdo->query($sql)->fetchALL();

?>
<div class="container">
  <div class="d-flex justify-content-center mb-3">
    <div class='input-group input-group-sm col-4'>
      <input type='number' value="<?=$_GET['year'];?>" class='form-control' disabled>
      <div class='input-group-append'>
      <label class='input-group-text'>年</label>
      </div>
    </div>
    <div class='input-group input-group-sm col-4'>
      <select  class='custom-select' name='period' disabled>
      <?php

      //以期別為索引值取得月份
      $period_mon=[
      '01~02',
      '03~04',
      '05~06',
      '07~08',
      '09~10',
      '11~12'
      ];

      for($i=1;$i<7;$i++){
        if($_GET['period']==$i){
          //6個期別中，與$_GET['pd']相等的便是輸入的期別，增加 selected='selected' 使他設為預設值
          echo "<option selected='selected' value='{$_GET['period']}'>{$period_mon[$_GET['period']-1]}</option>";
          
        }else{
          //與$_GET['pd']不相等的期別則成為下拉選單中的選項，不是預設值
          echo "<option value='".$i."'>".$period_mon[$i-1]."</option>";
          
        }
      }
      ?>
      </select>
    </div>
  </div>
</div>



<form action="update_invoices.php" method="post">
<input type="hidden" name="period" value="<?=$_GET['period'];?>">
<input type="hidden" name="year" value="<?=$_GET['year'];?>">
  <table class="table table-borderless text-center text-muted">
    <tr class="font-weight-bolder bg-secondary text-light">
      <td>發票號碼</td>
      <td>發票金額</td>
      <td>消費日期</td>
      <td>管理</td>
    </tr>

    <?php
    foreach($invs as $inv){
      if($inv['id']==$_GET['id']){  //判斷若為要編輯的發票資料，則顯示input欄位供修改

    ?>
    <div>
      <input type="hidden" name="id" value="<?=$inv['id'];?>">  <!--隱藏id欄位，僅供傳值-->
    </div>
    </tr>
    <tr class="alert-secondary">
      <td class="d-flex">
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="code" value="<?=$inv['code'];?>">
          <input type="number" class="form-control" name="number" value="<?=$inv['number'];?>" style="width:80px">
        </div>
        
      </td>
      <td>
        <div class="input-group mb-3">
          <input type="number" class="form-control" name="payment" value="<?=$inv['payment'];?>">
        </div>
      </td>
      <td>
        <div class="input-group mb-3">
          <input type="date" class="form-control" name="date" value="<?=$inv['date'];?>">
        </div>
      </td>
      <td>
        <div class="d-flex">
          <button class="btn btn-sm btn-success mx-2">
            <i class="fas fa-check"></i>  <!--確認編輯，提交表單-->
          </button>
          <div type="button" class="btn btn-sm btn-danger" value="">
            <a href="index.php?do=invoices_list.php&pd=<?=$_GET['period'];?>&year=<?=$_GET['year'];?>" class="text-decoration-none text-light">
            <i class="fas fa-times"></i>  <!--取消編輯-->
            </a>
          </div>
        </div>
      </td>
    </tr>
    <?php
      }else{  //若不要編輯中的發票資料，則顯示較不明顯
    ?>
    <tr style="opacity:0.5">
      <td><?=$inv['code'].$inv['number'];?></td>
      <td><?=$inv['payment'];?></td>
      <td><?=$inv['date'];?></td>
      <td>
        <div class="d-flex">
          <button class="btn btn-sm btn-primary mx-2" disabled><i class="fas fa-edit"></i></button>
          <button class="btn btn-sm btn-danger" disabled><i class="fas fa-trash-alt"></i></button>
        </div>
      </td>
    </tr>
    <?php
      }
    }

    ?>
  </table>

</form>
