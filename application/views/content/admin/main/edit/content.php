<section class="grid col-three-quarters mq2-col-full"> 
  <h2>網站管理員 > 修改帳號密碼</h2>

  <div class='error'>
    <?php echo $message;?>
  </div>
  <article id="navplace">
    <form action="<?php echo base_url (array ('admin', 'edit'));?>" method="post" >
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="13%">帳號</td>
          <td width="56%" class="textleft">
            <input type='text' name='account' value="<?php echo identity ()->user ()->account;?>" placeholder='請輸入E-mail電子信箱' pattern="^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$" required title="請輸入正確的 E-mail"/>
            請輸入E-mail電子信箱
          </td>
        </tr>
        <tr>
          <td>密碼</td>
          <td class="textleft">
            <input type="password" name='password' value="" placeholder='請輸入6~8個英數字元' pattern=".{6,8}" required title="請輸入6~8個英數字元" / >
            請輸入6~8個英數字元
          </td>
        </tr>
        <tr>
          <td>再次確認密碼</td>
          <td class="textleft">
            <input type="password" name='re_password' value="" placeholder='再次輸入您的密碼' pattern=".{6,8}" required title="請輸入6~8個英數字元" />
            再次輸入您的密碼
          </td>
        </tr>
      </table>
      <br>
      <p>
        <button type="submit">確定修改</button>
      </p>
    </form>
  </article>
</section>