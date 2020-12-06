<!-- 新增發票頁面 -->

  <form action="insert_invoices.php" method="post">
    <table class="table table-borderless">
      <tr>
        <td class="p-3">日期:</td>
        <td>
          <div class="input-group input-group-sm">
            <input type="date" name="date" class="form-control" required>
          </div>
        </td>
      </tr>
      <tr>
        <td class="p-3">期別:</td>
        <td>
          <div class="input-group input-group-sm mb-3">
            <select class="custom-select" name="period" required>
              <option><option> <!--為了讓required有作用，此欄視為空值-->
              <option value="1">01~02</option>
              <option value="2">03~04</option>
              <option value="3">05~06</option>
              <option value="4">07~08</option>
              <option value="5">09~10</option>
              <option value="6">11~12</option>
            </select>
            <div class="input-group-append">
              <label class="input-group-text">月</label>
            </div>
          </div>
        </td>
      </tr>
      <tr>
        <td class="p-3">發票號碼:</td>
        <td>
          <div class="row">
            <div class="input-group input-group-sm col-3 pr-1">
              <input type="text" name="code" class="form-control" required>
            </div>
            <div class="input-group input-group-sm col-9 pl-1">
              <input type="number" name="number" class="form-control" style="width:120px" required>
            </div>
          </div>
        </td>
      </tr>
      <tr>
        <td class="p-3">發票金額:</td>
        <td>
          <div class="input-group input-group-sm">
            <input type="number" min="0" name="payment" class="form-control" required>
          </div>
        </td>
      </tr>
      
    </table>
    <div class="m-3 p-3 text-center">
      <button class="btn btn-sm btn-info" type="submit">送出</button>
      <button class="btn btn-sm btn-warning" type="reset">清除</button>
    </div>
  </form>
