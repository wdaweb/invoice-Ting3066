<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="style.css">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@300&display=swap" rel="stylesheet">  
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://kit.fontawesome.com/bc80d402a1.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>


</head>

<body>
  <!-- navbar，在解析度992px以下才會出現 -->
  <div class="d-lg-none">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <button class="navbar-toggler" data-toggle="collapse" data-target="#Menu">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="Menu">
        <ul class="navbar-nav">
          <li class="mt-2 nav-item">
            <a class="nav-link" href="?do=add_invoices.php">新增發票</a>
          </li>
          <li class="mt-2 nav-item">
            <a class="nav-link" href="?do=invoices_list.php">發票管理</a>
          </li>
          <li class="mt-2 nav-item">
            <a class="nav-link" href="?do=add_award_numbers.php">新增獎號</a>
          </li>
          <li class="mt-2 nav-item">
            <a class="nav-link" href="?do=award_numbers_list.php">獎號清單</a>
          </li>
        </ul>
      </div>
    </nav>
  </div>


  <div class="d-flex justify-content-center mx-3 py-4 row">
    <div class="col-lg-2"></div>
    <h2 class="col-lg-7 col-12 text-center"><a href="index.php" class="title text-muted font-weight-bolder">統一發票對獎系統</a></h2>
  </div>

  <!-- 選單區，在解析度992px以上才會出現 -->
  <div class="mx-3 row d-flex justify-content-center">
    <div class="col-12 d-flex justify-content-center">
      <div class="col-2 d-none d-lg-block">
        <a href="?do=add_invoices.php"><button type="button" class="btn btn-lg btn-block btn-outline-secondary my-1"><i class="fas fa-plus-square mx-2"></i>新增發票</button></a>
        <a href="?do=invoices_list.php"><button type="button" class="btn btn-lg btn-block btn-outline-secondary my-1"><i class="fas fa-clipboard mx-2"></i>發票管理</button></a>
        <a href="?do=add_award_numbers.php"><button type="button" class="btn btn-lg btn-block btn-outline-secondary my-1"><i class="fas fa-plus-square mx-2"></i>新增獎號</button></a>
        <a href="?do=award_numbers_list.php"><button type="button" class="btn btn-lg btn-block btn-outline-secondary my-1"><i class="fas fa-list-alt mx-2"></i>獎號清單</button></a>
      </div>
      <div class="col-7 border rounded py-5 d-flex align-items-center flex-column">
      <?php

      //在需要顯示在此區的網頁網址加上 ?do=....
      //判斷 isset($_GET['do'])
      //若成立則是用include帶入，並顯示在這個區域
      //若不成立則顯示新增發票的內容
      if(isset($_GET['do'])){
        include_once $_GET['do'];
      }else{
        include_once "add_invoices.php";
      }
      ?>
      </div>
    </div>
    
  </div>





</body>

</html>




