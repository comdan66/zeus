<section  class="grid col-three-quarters mq2-col-two-thirds mq3-col-full">
  <form action="/admin" method="post">
    <ul>
      <li>
        <label for="username">帳號</label>
        <input type="text" id='account' name='account' calue=''placeholder='請輸入 E-mail 帳號' pattern="^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$" required title="請輸入正確的 E-mail 帳號"/>
      </li>
      <li>
        <label for="password">密碼</label>
        <input type="password" id='password' name='password' placeholder='請輸入密碼' pattern="[A-Z0-9]{6,8}" required title="請輸入密碼(6~8個英數字元)" / >
      </li>
      <li>
        <div id='error'><?php echo $message;?></div>
      </li>
      <li>
        <button type="submit" id="submit" name="submit" class="button fleft">登入</button>
      </li>
    </ul>
  </form>
</section>