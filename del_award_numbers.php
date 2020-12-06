<!-- 確認是否刪除獎號資料 -->

<div>確定要刪除此筆資料嗎?
    <button>
      <a href="del.php?period=<?=$_GET['pd'];?>&year=<?=$_GET['year'];?>&del=award_numbers" class="text-decoration-none">確定</a>
      <!-- 若確定刪除，引導至del.php進行刪除動作 -->
    </button>
    <button>
      <a href="index.php?do=award_numbers_list.php" class="text-decoration-none">取消</a>
      <!-- 取消則回到獎號清單 -->

    </button>
  </div>
