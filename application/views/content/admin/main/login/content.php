<section class="grid col-three-quarters mq2-col-full">
  <h2>宙思設計有限公司 <?php echo identity ()->user ()->account;?> 您好：</h2>
  <hr>
  <article id="navplace">
    <h3>您上次最後一次登入的時間日期為：<?php echo identity ()->user ()->logined_at->format ('Y年m月d日');?></h3>
    <h3>登入總次數為：<?php echo identity ()->user ()->login_count;?>次 </h3>
    <h4>若您資料有誤,請告知貴公司的總管理者 <br>
    </h4>
  </article>
</section>