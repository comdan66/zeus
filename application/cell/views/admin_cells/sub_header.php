<header class="grid col-full">
  <hr>
<?php
  if (identity ()->user ()) { ?>
    <p class="fleft">宙思設計有限公司</p>
    <strong>
      <a href="<?php echo base_url (array ('admin', 'login'));?>" class="alignright">zeus(<?php echo identity ()->user ()->account;?>)</a>
    </strong>
<?php
  } ?>
</header>