<div class="contact-page main grid-wrap">
  <header class="grid col-full">
    <hr>
    <p class="fleft">聯絡我們</p>
  </header>

  <aside class="grid col-one-quarter mq2-col-one-third mq3-col-full">
    <p class="mbottom">
      有設計相關問題嗎?<br />
      歡迎聯繫我們。
    </p>

    <h6>
      宙思設計有限公司<br />
      ZEUS DESIGN
    </h6>

    <p class="mbottom">
      235 新北市中和<br >
      區中和路232號5樓之1 <br >
      Zhonghe Rd., Zhonghe Dist., <br >
      New Taipei City 235, <br >
      Taiwan (R.O.C.)<br >
    </p>

    <p class="mbottom">
      TEL 02 8242 3885<br />
      FAX 02 8242 3885
    </p>

    <p class="mbottom">
      <h6>Openning hours: </h6>
      Monday to Friday <br >
      10:00 to 18:00
    </p>
  </aside>

  <section class="grid col-three-quarters mq2-col-two-thirds mq3-col-full">
    <h2>Drop us a message</h2>
<?php if (isset ($message) && $message) { ?>
        <p class="warning"><?php echo $message;?></p>
<?php } else { ?>
        <form id="contact_form" class="contact_form" action="<?php echo base_url (array ('contacts', 'submit'));?>" method="post" name="contact_form">
          <ul>
            <li>
              <label for="name">Your name:</label>
              <input type="text" name="name" id="name" class="required" value="" placeholder='Your name..' pattern=".{1,}" required title="Your name!" />
            </li>
            <li>
              <label for="email">Your Email:</label>
              <input type="text" name="email" id="email" class="required email" value="" placeholder='EX: info@zeusdesign.com.tw' pattern=".{1,}" required title="Your Email!" />
            </li>
            <li>
              <label for="message">Message:</label>
              <textarea name="message" id="message" cols="100" rows="6" class="required" pattern=".{1,}" required title="Your Message!" ></textarea>
            </li>
            <li>
              <button type="submit" id="submit" name="submit" class="button fright">Send it</button>
            </li>
          </ul>
        </form>
<?php }?>

  </section>
</div>
