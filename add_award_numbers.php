<!-- 新增獎號頁面 -->

<form action="insert_award_numbers.php" method="post" class="container">
  <table class="table table-sm table-bordered">
    <tbody>
      <tr>
        <th>年月份</th>
        <td>
        <div class="row">
          <div class="input-group input-group-sm pr-1 col-3">
            <input type="number" name="year" min="<?=date("Y")-1;?>" max="<?=date("Y")+1;?>" class="form-control" required>
            <div class="input-group-append">
              <span class="input-group-text">年</span>
            </div>
          </div>
          <div class="input-group input-group-sm pl-1 col-3">
            <select class="custom-select" name="period" required>
              <option></option>   <!--為了讓required有作用，此欄視為空值-->
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
        </div>
        </td>
      </tr>
      <tr>
        <th rowspan=2>特別獎</th>
        <td>
          <div class="input-group input-group-sm w-25">
            <input type="number" name="special_prize" min="00000001" max="99999999" class="form-control" required>
          </div>
        </td>
      </tr>
      <tr>
        <td>同期統一發票收執聯8位數號碼與特別獎號碼相同者獎金1,000萬元</td>
      </tr>
      <tr>
        <th rowspan=2>特獎</th>
        <td>
          <div class="input-group input-group-sm w-25">
            <input type="number" name="grand_prize" min="00000001" max="99999999" class="form-control" required>
          </div>
        </td>
      </tr>
      <tr>
        <td>同期統一發票收執聯8位數號碼與特獎號碼相同者獎金200萬元</td>
      </tr>
      <tr>
        <th rowspan=2>頭獎</th>
        <td>
            <!-- 因頭獎有3組號碼，所以將name設為陣列型式，以便將3組獎號存入陣列中 -->
          <div class="row">
            <div class="input-group input-group-sm pr-0 col-3">
              <input type="number" name="first_prize[]" min="00000001" max="99999999" class="form-control" required>
            </div>
            <div class="input-group input-group-sm pr-0 col-3">
              <input type="number" name="first_prize[]" min="00000001" max="99999999" class="form-control" required>
            </div>
            <div class="input-group input-group-sm pr-0 col-3">
              <input type="number" name="first_prize[]" min="00000001" max="99999999" class="form-control" required>
            </div>
          </div>
        </td>
      </tr>
      <tr>
        <td>同期統一發票收執聯8位數號碼與頭獎號碼相同者獎金20萬元</td>
      </tr>
      <tr>
        <th>增開六獎</th>
        <td>
          <!-- 因增開六獎有1-3組號碼不等，所以將name設為陣列型式，以便將獎號存入陣列中 -->
          <div class="row">
            <div class="input-group input-group-sm pr-0 col-2">
              <input type="number" name="add_six_prize[]" min="001" max="999" class="form-control" required>
            </div>
            <div class="input-group input-group-sm pr-0 col-2">
              <input type="number" name="add_six_prize[]" min="001" max="999" class="form-control" required>
            </div>
            <div class="input-group input-group-sm pr-0 col-2">
              <input type="number" name="add_six_prize[]" min="001" max="999" class="form-control" required>
            </div>
          </div>
        </td>
      </tr>
      
    </tbody>
  </table>
  <div class="text-center">
    <button type="submit" class="btn btn-info">儲存</button>
    <button type="reset" class="btn btn-warning">清空</button>
  </div>

</form>