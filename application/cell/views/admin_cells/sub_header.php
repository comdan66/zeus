<header class="grid col-full">
  <hr>
<?php
  if (identity ()->user ()) { ?>
    <p class="fleft">綠迷國際有限公司</p>
    <strong>
      <a href="<?php echo base_url (array ('admin', 'login'));?>" class="alignright">lumiere(<?php echo identity ()->user ()->account;?>)</a>
    </strong>
<?php
  } ?>
</header>